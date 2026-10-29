<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Seed the placeholder flat-rate membership shown on the website.
     */
    public function run(): void
    {
        MembershipPlan::updateOrCreate(['name' => 'Cuota ilimitada'], [
            'description' => 'Entrena todos los días que quieras, sin límite de clases.',
            'monthly_price_cents' => 7900,
            'enrollment_fee_cents' => 0,
            'commitment_months' => null,
            'features' => [
                'Clases WOD ilimitadas',
                'Halterofilia, gimnásticos y movilidad',
                'Acceso a open box',
                'Reserva de plaza desde el área de socio',
                'Sin permanencia',
            ],
            'is_featured' => true,
            'sort_order' => 0,
        ]);
    }
}
