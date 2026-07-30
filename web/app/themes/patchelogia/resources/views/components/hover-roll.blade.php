@props(['text'])

<span class="hover-roll__container">
    <span class="hover-roll__items">
        <span class="hover-roll__item" data-roll-item>
            {{ $text }}
        </span>

        <span
            aria-hidden="true"
            class="hover-roll__item"
            data-roll-item
        >{{ $text }}</span>
    </span>
</span>
