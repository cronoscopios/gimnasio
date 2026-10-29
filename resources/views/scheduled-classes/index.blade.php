@use('App\Models\ScheduledClass')

<x-layouts.app title="Horarios de clases" description="Horario semanal de clases y open box de Gimnasio ACME.">
    <x-page-header title="Horarios" intro="Horario semanal de clases y open box. El horario de apertura del box lo tienes en el pie de página." />

    <section class="section">
        <div class="container">
            {{-- TODO: reserva de plaza desde el área de socio. --}}
            <div class="timetable">
                @foreach (ScheduledClass::DAY_NAMES as $dayOfWeek => $dayName)
                    <section class="timetable__day">
                        <h2 class="timetable__day-name">{{ $dayName }}</h2>

                        @if ($classesByDay->has($dayOfWeek))
                            <ul class="timetable__list">
                                @foreach ($classesByDay[$dayOfWeek] as $scheduledClass)
                                    <li>
                                        <p>
                                            <span class="timetable__time">{{ substr($scheduledClass->starts_at, 0, 5) }} – {{ substr($scheduledClass->ends_at, 0, 5) }}</span>
                                            <a href="{{ route('activities.show', $scheduledClass->activity) }}">{{ $scheduledClass->activity->name }}</a>
                                        </p>
                                        <p class="timetable__details">
                                            {{ $scheduledClass->room }}
                                            @if ($scheduledClass->trainer)
                                                · {{ $scheduledClass->trainer->name }}
                                            @endif
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="timetable__empty">Sin clases dirigidas.</p>
                        @endif
                    </section>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
