@props([
    'subtitle' => false,
    'title' => false,
])

@if ($title)
    <div {{ $attributes->merge(['class' => 'page-header flex flex-col gap-y-2 text-center']) }}>
        @if ($subtitle)
            <h2 class="page-header__subtitle text-primary text-black/45">
                {{ $subtitle }}
            </h2>
        @endif

        <h1 class="page-header__title text-heading">
            {{ $title }}
        </h1>
    </div>
@endif
