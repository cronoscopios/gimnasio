<x-layouts.app description="Gimnasio ACME: box de entrenamiento funcional con clases en grupo, open box y coaches titulados. Ven a probar una clase gratis.">
    <section class="hero">
        <div class="container hero__content">
            <h1 class="hero__title">Aquí nadie entrena solo</h1>
            <p class="hero__lead">Entrenamiento funcional en grupos reducidos, con coaches que te corrigen, te animan y adaptan cada WOD a tu nivel. Empieces de cero o vengas a por tu próxima marca, este es tu sitio.</p>

            <div class="cluster hero__actions">
                <a href="{{ route('contact') }}" class="button button--sun">Prueba una clase gratis</a>
                <a href="{{ route('membership-plans.index') }}" class="link-arrow">Ver tarifas</a>
            </div>

            @if ($cheapestPlan)
                <p class="hero__price">Desde {{ $cheapestPlan->formatted_monthly_price }}/mes, IVA incluido</p>
            @endif
            {{-- TODO: valoración de Google (T10). --}}
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2>Qué entrenamos</h2>
                <a href="{{ route('activities.index') }}" class="link-arrow">Todas las actividades</a>
            </div>

            <ul class="grid grid--3">
                @foreach ($activities as $activity)
                    <li>
                        <article class="card">
                            <h3 class="card__title"><a href="{{ route('activities.show', $activity) }}">{{ $activity->name }}</a></h3>
                            <p class="card__text">{{ $activity->summary }}</p>
                        </article>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section section--sun">
        <div class="container">
            <div class="section__header">
                <div>
                    <h2>Clases todos los días</h2>
                    <p class="section__lead">WOD de mañana, mediodía y tarde, y open box para entrenar a tu aire.</p>
                </div>
                <a href="{{ route('scheduled-classes.index') }}" class="button">Ver horario</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2>Tus coaches</h2>
                <a href="{{ route('trainers.index') }}" class="link-arrow">Conoce al equipo</a>
            </div>

            <ul class="grid grid--3">
                @foreach ($trainers as $trainer)
                    <li>
                        <article class="card">
                            <h3 class="card__title">{{ $trainer->name }}</h3>
                            <p class="card__text">{{ $trainer->specialty }}</p>
                        </article>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section section--tinted">
        <div class="container">
            <h2>Lo que dicen en el box</h2>
            <div class="media-placeholder media-placeholder--auto" style="margin-top: var(--space-6)">Testimonios de socios (pendiente)</div>
        </div>
    </section>

    <section class="section">
        <div class="container text-center stack">
            <h2>¿Te vienes a probar?</h2>
            <p class="text-muted">Tu primera clase es gratis. Sin compromiso y adaptada a tu nivel.</p>
            <p><a href="{{ route('contact') }}" class="button button--primary">Reserva tu clase de prueba</a></p>
        </div>
    </section>
</x-layouts.app>
