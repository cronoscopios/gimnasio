<x-layouts.app title="Tarifas" description="Tarifa de Gimnasio ACME con IVA incluido: cuota ilimitada, matrícula y permanencia sin letra pequeña.">
    <x-page-header title="Tarifas" color="mint" intro="Una sola cuota, todo incluido y con IVA. Sin letra pequeña: aquí tienes la matrícula, la permanencia y lo que incluye." />

    <section class="section">
        <div class="container">
            <ul class="grid grid--2">
                @foreach ($plans as $plan)
                    <li>
                        <article @class(['plan', 'plan--featured' => $plan->is_featured])>
                            @if ($plan->is_featured)
                                <p class="plan__badge">Todo incluido</p>
                            @endif

                            <h2>{{ $plan->name }}</h2>
                            <p>{{ $plan->description }}</p>

                            <p>
                                <span class="plan__price">{{ $plan->formatted_monthly_price }}</span>
                                <span class="plan__period">/mes</span>
                            </p>

                            <dl class="plan__terms">
                                <div>
                                    <dt>Matrícula:</dt>
                                    <dd>{{ $plan->enrollment_fee_cents > 0 ? $plan->formatted_enrollment_fee : 'Gratis' }}</dd>
                                </div>
                                <div>
                                    <dt>Permanencia:</dt>
                                    <dd>{{ $plan->commitment_months ? $plan->commitment_months.' meses' : 'Sin permanencia' }}</dd>
                                </div>
                            </dl>

                            <ul class="plan__features">
                                @foreach ($plan->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>

                            {{-- TODO: enlazar al alta cuando exista. --}}
                            <a href="{{ route('contact') }}" class="button button--primary">Empieza con una clase gratis</a>
                        </article>
                    </li>
                @endforeach
            </ul>

            <div class="stack" style="margin-top: var(--space-12); max-width: 40rem">
                <h2>Condiciones</h2>
                <p class="text-muted">Texto de ejemplo sobre la renovación de la cuota, la forma de pago y cómo darse de baja. Sustituir por las condiciones definitivas revisadas por un abogado.</p>
            </div>
        </div>
    </section>
</x-layouts.app>
