@props(['title', 'subtitle' => null, 'list' => [], 'favorite' => false])

<div
    {{ $attributes->class([
        'compare-card__relative flex flex-col gap-y-6 rounded-2xl border bg-white p-6 md:p-8',
        'compare__card--favorite border-zinc-300' => $favorite,
        'compare__card--outsider border-zinc-200' => !$favorite,
    ]) }}>
    <div class="compare-card__header">
        @if ($subtitle)
            <h5 class="compare-card__subtitle text-primary mb-1 text-black/45">
                {{ $subtitle }}
            </h5>
        @endif

        <h4 class="compare-card__title text-lg">
            {{ $title }}
        </h4>
    </div>

    <ul class="compare-card__list">
        @foreach ($list as $item)
            <li class="compare-card__item flex items-center gap-x-4 border-b border-zinc-200 py-4 last:border-none">
                @if ($favorite)
                    <span class="h-5 w-5 shrink-0 text-black/45">
                        {!! file_get_contents(resource_path('images/icons/approw.svg')) !!}
                    </span>
                @endif

                <span class="w-full text-black/60">
                    {{ $item['point'] }}
                </span>
            </li>
        @endforeach
    </ul>

    @if ($favorite)
        <div
            class="compare__symbol text-primary absolute -bottom-8 left-1/2 z-10 flex h-12 w-12 -translate-x-1/2 items-center justify-center rounded-full border border-zinc-200 bg-white text-black/45 md:hidden">
            VS
        </div>
    @endif
</div>
