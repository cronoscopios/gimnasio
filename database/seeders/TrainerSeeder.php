<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Seed the placeholder coaches shown on the website.
     */
    public function run(): void
    {
        $trainers = [
            ['name' => 'Coach 1', 'specialty' => 'Head coach · Entrenamiento funcional', 'qualifications' => 'Grado en Ciencias de la Actividad Física y del Deporte'],
            ['name' => 'Coach 2', 'specialty' => 'Halterofilia', 'qualifications' => 'Técnico en halterofilia'],
            ['name' => 'Coach 3', 'specialty' => 'Gimnásticos y movilidad', 'qualifications' => 'Técnico Superior en Acondicionamiento Físico'],
        ];

        foreach ($trainers as $sortOrder => $trainer) {
            Trainer::updateOrCreate(['name' => $trainer['name']], [
                ...$trainer,
                'bio' => 'Texto de ejemplo con la presentación del coach: experiencia, forma de trabajar y en qué puede ayudarte. Sustituir por el contenido definitivo.',
                'sort_order' => $sortOrder,
            ]);
        }
    }
}
