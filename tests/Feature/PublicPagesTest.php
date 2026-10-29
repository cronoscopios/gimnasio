<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Faq;
use App\Models\MembershipPlan;
use App\Models\ScheduledClass;
use App\Models\Trainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{string, string}>
     */
    public static function staticPagesProvider(): array
    {
        return [
            'instalaciones' => ['/instalaciones', 'Instalaciones'],
            'sobre nosotros' => ['/sobre-nosotros', 'Sobre nosotros'],
            'contacto' => ['/contacto', 'Contacto y cómo llegar'],
        ];
    }

    #[DataProvider('staticPagesProvider')]
    public function test_static_pages_render(string $uri, string $heading): void
    {
        $this->get($uri)
            ->assertOk()
            ->assertSee($heading)
            ->assertSee(config('gym.address.street'));
    }

    public function test_home_page_shows_activities_trainers_and_starting_price(): void
    {
        Activity::factory()->create(['name' => 'Pilates']);
        Trainer::factory()->create(['name' => 'Laura Gómez']);
        MembershipPlan::factory()->create(['monthly_price_cents' => 2990]);
        MembershipPlan::factory()->create(['monthly_price_cents' => 4990]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Pilates')
            ->assertSee('Laura Gómez')
            ->assertSee('Desde 29,90');
    }

    public function test_pricing_page_shows_plans_with_enrollment_and_commitment(): void
    {
        MembershipPlan::factory()->create([
            'name' => 'Premium',
            'monthly_price_cents' => 5490,
            'enrollment_fee_cents' => 0,
            'commitment_months' => 12,
        ]);

        $this->get('/tarifas')
            ->assertOk()
            ->assertSee('Premium')
            ->assertSee('54,90')
            ->assertSee('Gratis')
            ->assertSee('12 meses');
    }

    public function test_activities_page_links_to_each_activity(): void
    {
        $activity = Activity::factory()->create(['name' => 'Yoga', 'slug' => 'yoga']);

        $this->get('/actividades')
            ->assertOk()
            ->assertSee('Yoga')
            ->assertSee(route('activities.show', $activity));
    }

    public function test_activity_page_is_resolved_by_slug_and_shows_its_classes(): void
    {
        $activity = Activity::factory()->create(['name' => 'Spinning', 'slug' => 'spinning']);
        ScheduledClass::factory()->for($activity)->create([
            'day_of_week' => 2,
            'starts_at' => '19:30',
            'ends_at' => '20:15',
        ]);

        $this->get('/actividades/spinning')
            ->assertOk()
            ->assertSee('Spinning')
            ->assertSee('Martes')
            ->assertSee('19:30');
    }

    public function test_unknown_activity_returns_not_found(): void
    {
        $this->get('/actividades/no-existe')->assertNotFound();
    }

    public function test_timetable_groups_classes_by_day(): void
    {
        $activity = Activity::factory()->create(['name' => 'Zumba']);
        ScheduledClass::factory()->for($activity)->create([
            'day_of_week' => 6,
            'starts_at' => '11:00',
            'ends_at' => '11:45',
        ]);

        $this->get('/horarios')
            ->assertOk()
            ->assertSeeInOrder(['Sábado', '11:00', 'Zumba', 'Domingo', 'Sin clases dirigidas']);
    }

    public function test_team_page_shows_trainers_with_qualifications(): void
    {
        Trainer::factory()->create([
            'name' => 'Laura Gómez',
            'qualifications' => 'Grado en Ciencias de la Actividad Física y del Deporte',
        ]);

        $this->get('/equipo')
            ->assertOk()
            ->assertSee('Laura Gómez')
            ->assertSee('Grado en Ciencias de la Actividad Física y del Deporte');
    }

    public function test_faq_page_lists_questions_in_order(): void
    {
        Faq::factory()->create(['question' => '¿Segunda pregunta?', 'sort_order' => 2]);
        Faq::factory()->create(['question' => '¿Primera pregunta?', 'sort_order' => 1]);

        $this->get('/preguntas-frecuentes')
            ->assertOk()
            ->assertSeeInOrder(['¿Primera pregunta?', '¿Segunda pregunta?']);
    }
}
