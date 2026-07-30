<a {{ $attributes->merge(['class' => 'logotype font-logotype relative w-fit font-light tracking-[0.01em] text-black transition-all hover:tracking-wider']) }}
    href="{{ home_url('/') }}"
>
    {!! $siteName !!}

    <span class="logotype__symbol absolute -right-4 -top-0.5 text-xs">®</span>
</a>
