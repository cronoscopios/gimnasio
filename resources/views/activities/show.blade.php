@use('App\Models\ScheduledClass')

<x-layouts.app :title="$activity->name" :description="$activity->summary">
    <x-page-header :title="$activity->name" :intro="$activity->summary" color="sky">
        <p class="page-header__meta">
            {{ $activity->level }}
            @if ($activity->duration_minutes)
                · {{ $activity->duration_minutes }} min
            @endif
        </p>
    </x-page-header>

    <section class="section">
        <div class="container split">
            <div class="stack">
                <h2>En qué consiste</h2>
                <p>{{ $activity->description }}</p>
            </div>

            <aside class="timetable__day">
                <h2 class="timetable__day-name">Horario</h2>

                @if ($scheduledClasses->isEmpty())
                    <p class="timetable__empty">Ahora mismo no hay clases programadas.</p>
                @else
                    <ul class="timetable__list">
                        @foreach ($scheduledClasses as $scheduledClass)
                            <li>
                                <span class="timetable__time">{{ substr($scheduledClass->starts_at, 0, 5) }}</span>
                                {{ ScheduledClass::DAY_NAMES[$scheduledClass->day_of_week] }}
                                @if ($scheduledClass->trainer)
                                    <span class="timetable__details">· {{ $scheduledClass->trainer->name }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif

                <p style="margin-top: var(--space-6)">
                    <a href="{{ route('contact') }}" class="button button--primary">Prueba una clase gratis</a>
                </p>
            </aside>
        </div>
    </section>

    <section class="container" style="padding-bottom: var(--space-16)">
        <a href="{{ route('activities.index') }}">← Todas las actividades</a>
    </section>
</x-layouts.app>
