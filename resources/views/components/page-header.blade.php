@props([
    'title',
    'intro' => null,
    'color' => null,
])

<section class="page-header" @if ($color) style="--page-header-color: var(--color-{{ $color }})" @endif>
    <div class="container page-header__content">
        <h1>{{ $title }}</h1>

        @if ($intro)
            <p class="page-header__intro">{{ $intro }}</p>
        @endif

        {{ $slot }}
    </div>
</section>
