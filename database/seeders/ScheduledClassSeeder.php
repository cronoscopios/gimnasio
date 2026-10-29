<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ScheduledClass;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class ScheduledClassSeeder extends Seeder
{
    /**
     * Seed a placeholder weekly class timetable.
     */
    public function run(): void
    {
        $activities = Activity::ordered()->get()->keyBy('slug');
        $trainers = Trainer::ordered()->get()->values();

        $weekdays = [1, 2, 3, 4, 5];

        $timetable = [
            ['wod', $weekdays, '07:00', '08:00', 'Zona WOD'],
            ['wod', $weekdays, '09:30', '10:30', 'Zona WOD'],
            ['wod', $weekdays, '14:00', '15:00', 'Zona WOD'],
            ['wod', $weekdays, '18:00', '19:00', 'Zona WOD'],
            ['wod', $weekdays, '19:00', '20:00', 'Zona WOD'],
            ['wod', $weekdays, '20:00', '21:00', 'Zona WOD'],
            ['wod', [6], '10:00', '11:00', 'Zona WOD'],
            ['open-box', $weekdays, '11:00', '12:30', 'Todo el box'],
            ['open-box', [6], '11:00', '13:00', 'Todo el box'],
            ['halterofilia', [2, 4], '21:00', '22:00', 'Plataformas'],
            ['gimnasticos', [1, 3], '21:00', '22:00', 'Zona WOD'],
            ['movilidad', [5], '21:00', '21:45', 'Zona WOD'],
        ];

        ScheduledClass::query()->delete();

        foreach ($timetable as $index => [$slug, $daysOfWeek, $startsAt, $endsAt, $room]) {
            foreach ($daysOfWeek as $dayOfWeek) {
                ScheduledClass::create([
                    'activity_id' => $activities[$slug]->id,
                    'trainer_id' => $trainers[$index % $trainers->count()]->id,
                    'day_of_week' => $dayOfWeek,
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                    'room' => $room,
                ]);
            }
        }
    }
}
