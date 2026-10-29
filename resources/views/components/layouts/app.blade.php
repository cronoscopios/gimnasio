@props([
    'title' => null,
    'description' => null,
])

@php
    $gym = config('gym');
    $navigationLinks = [
        'activities.index' => 'Actividades',
        'scheduled-classes.index' => 'Horarios',
        'membership-plans.index' => 'Tarifas',
        'facilities' => 'Instalaciones',
        'trainers.index' => 'Equipo',
        'contact' => 'Contacto',
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ? $title.' | '.$gym['name'] : $gym['name'] }}</title>

        @if ($description)
            <meta name="description" content="{{ $description }}">
        @endif

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="site-header">
            <div class="container site-header__bar">
                <a href="{{ route('home') }}" class="site-header__brand">Gimnasio <span>ACME</span></a>

                <nav aria-label="Principal" class="site-nav">
                    @foreach ($navigationLinks as $routeName => $label)
                        <a href="{{ route($routeName) }}" @if (request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}</a>
                    @endforeach
                </nav>

                <div class="site-header__actions">
                    <a href="{{ $gym['member_area_url'] }}" class="site-header__member-link">Área de socio</a>
                    <a href="{{ route('contact') }}" class="button button--primary button--small">Prueba gratis</a>
                </div>
            </div>

            <details class="site-nav-mobile">
                <summary>Menú</summary>
                <nav aria-label="Principal (móvil)">
                    @foreach ($navigationLinks as $routeName => $label)
                        <a href="{{ route($routeName) }}" @if (request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}</a>
                    @endforeach
                    <a href="{{ $gym['member_area_url'] }}">Área de socio</a>
                </nav>
            </details>
        </header>

        <main>
            {{ $slot }}
        </main>

        <footer class="site-footer">
            <div class="container site-footer__grid">
                <div>
                    <p class="site-footer__title">{{ $gym['name'] }}</p>
                    <address>
                        {{ $gym['address']['street'] }}<br>
                        {{ $gym['address']['postal_code'] }} {{ $gym['address']['city'] }} ({{ $gym['address']['region'] }})
                    </address>
                    <p><a href="{{ $gym['map_url'] }}">Cómo llegar</a></p>
                </div>

                <div>
                    <p class="site-footer__title">Horario</p>
                    <dl>
                        @foreach ($gym['opening_hours'] as $days => $hours)
                            <div>
                                <dt>{{ $days }}:</dt>
                                <dd>{{ $hours }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div>
                    <p class="site-footer__title">Contacto</p>
                    <ul>
                        <li><a href="tel:{{ str_replace(' ', '', $gym['phone']) }}">{{ $gym['phone'] }}</a></li>
                        <li><a href="https://wa.me/{{ $gym['whatsapp'] }}">WhatsApp</a></li>
                        <li><a href="mailto:{{ $gym['email'] }}">{{ $gym['email'] }}</a></li>
                    </ul>
                </div>

                <div>
                    <p class="site-footer__title">El box</p>
                    <ul>
                        <li><a href="{{ route('about') }}">Sobre nosotros</a></li>
                        <li><a href="{{ route('trainers.index') }}">Equipo</a></li>
                        <li><a href="{{ route('faqs.index') }}">Preguntas frecuentes</a></li>
                    </ul>
                </div>
            </div>

            <div class="site-footer__bottom">
                <p class="container">
                    &copy; {{ now()->year }} {{ $gym['name'] }}
                    {{-- TODO: enlaces a Aviso legal, Política de privacidad y Política de cookies (páginas 25-27). --}}
                </p>
            </div>
        </footer>
    </body>
</html>
