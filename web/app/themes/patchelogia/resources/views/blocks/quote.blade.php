<section class="quote pt-30">
    <div class="quote__container custom-sm-container flex flex-col justify-between gap-16 lg:flex-row">
        <div class="quote__header flex shrink-0 flex-col gap-y-2 lg:w-2/5">
            @if ($fields['subtitle'])
                <h3 class="quote__subtitle text-primary text-black/45">
                    {{ $fields['subtitle'] }}
                </h3>
            @endif

            <h2 class="quote__title text-heading">
                {{ $fields['title'] }}
            </h2>
        </div>

        <div class="quote__content page-content border-t border-zinc-200 pt-7 text-black/60">
            {!! $fields['content'] !!}
        </div>
    </div>
</section>
