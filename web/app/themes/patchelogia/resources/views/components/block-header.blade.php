@props([
    'subtitle' => false,
    'title' => false,
])

@if ($title)
    <div {{ $attributes->merge(['class' => 'block-header flex flex-col gap-y-2 text-center']) }}>
        @if ($subtitle)
            <h2 class="block-header__subtitle text-primary text-black/45">
                {{ $subtitle }}
            </h2>
        @endif

        <h3 class="block-header__title text-heading">
            {{ $title }}
        </h3>
    </div>
@endif
