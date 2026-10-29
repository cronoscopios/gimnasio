<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Seed the placeholder frequently asked questions shown on the website.
     */
    public function run(): void
    {
        $faqs = [
            '¿Necesito experiencia previa?' => 'No. Cada ejercicio tiene una versión adaptada y el coach te enseña la técnica desde el primer día.',
            '¿Cómo funciona la clase de prueba?' => 'Rellenas el formulario, te proponemos día y hora y vienes a entrenar con el grupo. Es gratis y sin compromiso.',
            '¿Hay que reservar las clases?' => 'Sí. Las plazas por clase son limitadas, así que se reservan desde el área de socio. Si está llena, puedes apuntarte a la lista de espera.',
            '¿Qué incluye la cuota?' => 'Clases ilimitadas de WOD, halterofilia, gimnásticos y movilidad, y acceso al open box. El entrenamiento personal se contrata aparte.',
            '¿Tengo permanencia?' => 'No. Puedes darte de baja cuando quieras desde el área de socio o en el box.',
            '¿Hay clases para adolescentes?' => 'Texto de ejemplo sobre los grupos para jóvenes. La inscripción de menores se hace en el box con la autorización de su madre, padre o tutor.',
            '¿Qué tengo que traer el primer día?' => 'Ropa cómoda, zapatillas de deporte, una toalla y agua.',
        ];

        $sortOrder = 0;

        foreach ($faqs as $question => $answer) {
            Faq::updateOrCreate(['question' => $question], [
                'answer' => $answer,
                'sort_order' => $sortOrder++,
            ]);
        }
    }
}
