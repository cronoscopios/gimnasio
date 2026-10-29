@php
    $gym = config('gym');
@endphp

<x-layouts.app title="Contacto y cómo llegar" description="Dirección, horario, teléfono y WhatsApp de Gimnasio ACME.">
    <x-page-header title="Contacto y cómo llegar" color="berry" intro="Ven a vernos, llámanos o escríbenos por WhatsApp. Te contestamos rápido." />

    <section class="section">
        <div class="container split split--even">
            <div class="stack stack--lg">
                <div class="stack">
                    <h2>Dirección</h2>
                    <address>
                        {{ $gym['name'] }}<br>
                        {{ $gym['address']['street'] }}<br>
                        {{ $gym['address']['postal_code'] }} {{ $gym['address']['city'] }} ({{ $gym['address']['region'] }})
                    </address>
                    <p><a href="{{ $gym['map_url'] }}" class="link-arrow">Abrir en Google Maps</a></p>
                </div>

                <div class="stack">
                    <h2>Horario de apertura</h2>
                    <dl class="plan__terms">
                        @foreach ($gym['opening_hours'] as $days => $hours)
                            <div>
                                <dt>{{ $days }}:</dt>
                                <dd>{{ $hours }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="stack">
                    <h2>Teléfono y correo</h2>
                    <ul>
                        <li>Teléfono: <a href="tel:{{ str_replace(' ', '', $gym['phone']) }}">{{ $gym['phone'] }}</a></li>
                        <li>WhatsApp: <a href="https://wa.me/{{ $gym['whatsapp'] }}">Escríbenos</a></li>
                        <li>Correo: <a href="mailto:{{ $gym['email'] }}">{{ $gym['email'] }}</a></li>
                    </ul>
                </div>

                <div class="stack">
                    <h2>Transporte y aparcamiento</h2>
                    <p class="text-muted">Texto de ejemplo con las líneas de transporte público cercanas y las opciones de aparcamiento.</p>
                </div>
            </div>

            <div class="stack stack--lg">
                {{-- TODO: mapa estático (imagen + enlace) para no usar cookies de terceros. --}}
                <div class="media-placeholder">Mapa</div>

                {{-- TODO: formulario de clase de prueba con información RGPD (T7). --}}
                <div class="media-placeholder media-placeholder--auto">Formulario de clase de prueba (pendiente)</div>
            </div>
        </div>
    </section>
</x-layouts.app>
