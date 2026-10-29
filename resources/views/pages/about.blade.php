<x-layouts.app title="Sobre nosotros" description="La historia, la filosofía y la comunidad de Gimnasio ACME.">
    <x-page-header title="Sobre nosotros" color="sky" intro="Un box de barrio hecho por y para la gente que entrena en él." />

    <section class="section">
        <div class="container container--narrow stack stack--lg">
            <div class="stack">
                <h2>Nuestra historia</h2>
                <p>Texto de ejemplo sobre cómo y cuándo nació Gimnasio ACME. Sustituir por el contenido definitivo.</p>
            </div>

            <div class="stack">
                <h2>Cómo entrenamos</h2>
                <p>Texto de ejemplo sobre la metodología: técnica primero, intensidad después y cada ejercicio adaptado a tu nivel. Sustituir por el contenido definitivo.</p>
            </div>

            <div class="stack">
                <h2>Una comunidad</h2>
                <p>Texto de ejemplo sobre la comunidad del box: retos internos, competiciones y quedadas. Sustituir por el contenido definitivo.</p>
            </div>

            <p><a href="{{ route('trainers.index') }}" class="link-arrow">Conoce a nuestro equipo</a></p>
        </div>
    </section>
</x-layouts.app>
