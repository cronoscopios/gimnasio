<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gym Contact Details
    |--------------------------------------------------------------------------
    |
    | Single source of truth for the gym's name, address, phone and opening
    | hours. The header, footer and contact page read these values, so they
    | must match the Google Business Profile listing exactly.
    |
    */

    'name' => env('GYM_NAME', 'Gimnasio ACME'),

    'address' => [
        'street' => env('GYM_ADDRESS_STREET', 'Calle Ejemplo, 1'),
        'postal_code' => env('GYM_ADDRESS_POSTAL_CODE', '00000'),
        'city' => env('GYM_ADDRESS_CITY', 'Ciudad'),
        'region' => env('GYM_ADDRESS_REGION', 'Provincia'),
    ],

    'phone' => env('GYM_PHONE', '+34 900 000 000'),

    'whatsapp' => env('GYM_WHATSAPP', '34600000000'),

    'email' => env('GYM_EMAIL', 'hola@gimnasioacme.com'),

    'map_url' => env('GYM_MAP_URL', 'https://maps.google.com'),

    'member_area_url' => env('GYM_MEMBER_AREA_URL', '#'),

    'opening_hours' => [
        'Lunes a viernes' => '07:00 – 23:00',
        'Sábados' => '09:00 – 21:00',
        'Domingos y festivos' => '09:00 – 15:00',
    ],

];
