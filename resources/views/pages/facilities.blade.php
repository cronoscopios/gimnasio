@php
    $areas = [
        'Zona de WOD' => 'Texto de ejemplo sobre el espacio diáfano para las clases: suelo técnico, rig, remos, bicis de aire y material de cardio.',
        'Zona de halterofilia' => 'Texto de ejemplo sobre las plataformas, barras olímpicas y discos de competición.',
        'Gimnásticos' => 'Texto de ejemplo sobre anillas, barras de dominadas, paralelas y cuerdas.',
        'Vestuarios' => 'Texto de ejemplo sobre vestuarios, duchas y taquillas.',
    ];
@endphp

<x-layouts.app title="Instalaciones" description="Conoce el box de Gimnasio ACME: zona de WOD, halterofilia, gimnásticos y vestuarios.">
    <x-page-header title="Instalaciones" color="primary" intro="Texto de ejemplo con los metros del box y lo más destacado del espacio. Sustituir por el contenido definitivo." />

    <section class="section">
        <div class="container">
            <ul class="grid grid--2">
                @foreach ($areas as $areaName => $areaDescription)
                    <li class="stack">
                        <div class="media-placeholder">Foto real de {{ Str::lower($areaName) }}</div>
                        <h2>{{ $areaName }}</h2>
                        <p class="text-muted">{{ $areaDescription }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section section--sun">
        <div class="container text-center stack">
            <h2>Ven a verlo en persona</h2>
            <p><a href="{{ route('contact') }}" class="button button--primary">Prueba una clase gratis</a></p>
        </div>
    </section>
</x-layouts.app>
