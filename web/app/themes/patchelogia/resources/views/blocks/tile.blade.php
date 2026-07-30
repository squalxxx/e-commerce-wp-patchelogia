<section class="tile py-30">
    <div class="tile__container custom-sm-container">
        <ul class="tile__items grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($fields['items'] as $item)
                <li @class([
                    'tile__item flex flex-col items-center justify-center gap-y-3 border border-zinc-200 px-4 py-6 group',
                    'sm:col-span-2 md:col-span-1' => $loop->last && $loop->count % 2 !== 0,
                    'text-left' => $fields['text_align'] == 'left',
                    'text-center' => $fields['text_align'] == 'center',
                    'text-right' => $fields['text_align'] == 'right',
                ])>
                    @if (!empty($item['icon']))
                        <div
                            class="tile__icon svg-current h-8 w-8 text-black/45 transition-colors group-hover:text-neutral-900">
                            {!! file_get_contents(get_attached_file($item['icon'])) !!}
                        </div>
                    @endif

                    <span
                        class="tile__title text-primary w-full text-black/45 transition-colors group-hover:text-neutral-900"
                    >
                        {{ $item['title'] }}
                    </span>

                    @if (!empty($item['subtitle']))
                        <span class="tile__subtitle text-xs">
                            {{ $item['subtitle'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>
