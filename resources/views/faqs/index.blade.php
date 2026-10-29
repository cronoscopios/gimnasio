<x-layouts.app title="Preguntas frecuentes" description="Resolvemos tus dudas sobre la cuota, la clase de prueba, las reservas y el día a día en Gimnasio ACME.">
    <x-page-header title="Preguntas frecuentes" color="mint" />

    <section class="section">
        <div class="container container--narrow">
            <div class="faq">
                @foreach ($faqs as $faq)
                    <details class="faq__item">
                        <summary class="faq__question">{{ $faq->question }}</summary>
                        <p class="faq__answer">{{ $faq->answer }}</p>
                    </details>
                @endforeach
            </div>

            <p style="margin-top: var(--space-12)">
                ¿No encuentras lo que buscas? <a href="{{ route('contact') }}">Escríbenos</a>.
            </p>
        </div>
    </section>
</x-layouts.app>
