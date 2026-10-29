<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Seed the placeholder activities shown on the website.
     */
    public function run(): void
    {
        $activities = [
            ['name' => 'WOD', 'slug' => 'wod', 'summary' => 'La clase del día en grupo: calentamiento, técnica y entrenamiento funcional adaptado a tu nivel.', 'level' => 'Todos los niveles', 'duration_minutes' => 60],
            ['name' => 'Open Box', 'slug' => 'open-box', 'summary' => 'Franjas para entrenar a tu aire, repasar técnica o seguir tu propia programación.', 'level' => 'Con experiencia', 'duration_minutes' => 90],
            ['name' => 'Halterofilia', 'slug' => 'halterofilia', 'summary' => 'Arrancada, cargada y envión: técnica olímpica paso a paso y con seguridad.', 'level' => 'Todos los niveles', 'duration_minutes' => 60],
            ['name' => 'Gimnásticos', 'slug' => 'gimnasticos', 'summary' => 'Dominadas, fondos, handstands y muscle-ups con progresiones para cada nivel.', 'level' => 'Todos los niveles', 'duration_minutes' => 60],
            ['name' => 'Movilidad', 'slug' => 'movilidad', 'summary' => 'Gana rango de movimiento, mejora tu postura y prevén lesiones.', 'level' => 'Todos los niveles', 'duration_minutes' => 45],
            ['name' => 'Entrenamiento personal', 'slug' => 'entrenamiento-personal', 'summary' => 'Sesiones individuales o en pareja con un plan hecho a tu medida.', 'level' => 'A tu medida', 'duration_minutes' => 60],
        ];

        foreach ($activities as $sortOrder => $activity) {
            Activity::updateOrCreate(['slug' => $activity['slug']], [
                ...$activity,
                'description' => "Texto de ejemplo sobre {$activity['name']} en Gimnasio ACME: en qué consiste, qué beneficios aporta, a quién va dirigida y qué necesitas traer. Sustituir por el contenido definitivo.",
                'sort_order' => $sortOrder,
            ]);
        }
    }
}
