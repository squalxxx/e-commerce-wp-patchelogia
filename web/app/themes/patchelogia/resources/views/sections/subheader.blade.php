@php
    $phrases = $marqueePhrases();
@endphp

@if ($phrases)
    <header class="subheader h-8 overflow-hidden bg-neutral-900">
        <div
            class="subheader__marquee marquee hover-paused hover-paused flex h-full w-full items-center whitespace-nowrap">
            <div
                class="marquee__track font-manrope animate-marquee flex w-max cursor-default items-center gap-8 text-[0.55rem] font-normal uppercase tracking-[0.2em] text-white">
                @for ($i = 0; $i < 10; $i++)
                    @foreach ($phrases as $item)
                        <span class="marquee__item">
                            {{ $item['phrase'] }}
                        </span>

                        <span class="marquee__item">
                            ✦
                        </span>
                    @endforeach
                @endfor
            </div>
        </div>
    </header>
@endif
