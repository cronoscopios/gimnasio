<x-layouts.app title="Actividades" description="Actividades de Gimnasio ACME: WOD en grupo, open box, halterofilia, gimnásticos, movilidad y entrenamiento personal.">
    <x-page-header title="Actividades" color="sky" intro="Todo lo que puedes entrenar en el box, siempre con un coach a tu lado y adaptado a tu nivel." />

    <section class="section">
        <div class="container">
            <ul class="grid grid--3">
                @foreach ($activities as $activity)
                    <li>
                        <article class="card">
                            <h2 class="card__title">{{ $activity->name }}</h2>
                            <p class="card__text">{{ $activity->summary }}</p>
                            <p class="card__meta">
                                {{ $activity->level }}
                                @if ($activity->duration_minutes)
                                    · {{ $activity->duration_minutes }} min
                                @endif
                            </p>
                            <p class="card__footer"><a href="{{ route('activities.show', $activity) }}" class="link-arrow">Más información</a></p>
                        </article>
                    </li>
                @endforeach
            </ul>

            <p style="margin-top: var(--space-12)">
                <a href="{{ route('scheduled-classes.index') }}" class="button">Consulta el horario de clases</a>
            </p>
        </div>
    </section>
</x-layouts.app>
