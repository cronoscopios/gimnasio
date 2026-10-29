<x-layouts.app title="Equipo" description="Conoce a los coaches titulados de Gimnasio ACME.">
    <x-page-header title="Nuestro equipo" color="berry" intro="Coaches titulados que te enseñan la técnica, te empujan cuando hace falta y celebran cada progreso contigo." />

    <section class="section">
        <div class="container">
            <ul class="grid grid--3">
                @foreach ($trainers as $trainer)
                    <li>
                        <article class="card">
                            @if ($trainer->photo_path)
                                <img src="{{ asset($trainer->photo_path) }}" alt="{{ $trainer->name }}" class="media-photo">
                            @else
                                <div class="media-placeholder media-placeholder--square">Foto</div>
                            @endif

                            <h2 class="card__title">{{ $trainer->name }}</h2>
                            <p class="card__meta">{{ $trainer->specialty }}</p>

                            @if ($trainer->qualifications)
                                <p class="text-small text-muted">{{ $trainer->qualifications }}</p>
                            @endif

                            <p class="card__text">{{ $trainer->bio }}</p>
                        </article>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</x-layouts.app>
