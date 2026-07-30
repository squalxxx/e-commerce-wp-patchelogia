<section @class([
    'list-note py-30',
    'align-full' => $block['align'] === 'full',
])>
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="list-note__header mb-14"
    />

    <div class="list-note__container custom-md-container flex flex-col gap-4 lg:flex-row">
        <div class="list-note__holder flex flex-col gap-y-7 rounded-2xl border border-zinc-200 p-6 md:p-9 lg:w-2/3">
            @if ($fields['content'])
                <p class="list-note__content text-black/60">
                    {!! $fields['content'] !!}
                </p>
            @endif

            <ul class="list-note__list">
                @foreach ($fields['list'] as $item)
                    <li class="list-note__item flex gap-x-4 border-b border-zinc-200 py-4 last:border-none">
                        <span class="h-5 w-5 shrink-0 pt-1 text-black/45">
                            {!! file_get_contents(resource_path('images/icons/approw.svg')) !!}
                        </span>

                        <span class="w-full text-black/60">
                            {!! $item['point'] !!}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        @if ($fields['note_title'] || $fields['note_list'])
            <div
                class="list-note__note flex flex-col items-center justify-center gap-y-7 rounded-2xl border border-zinc-200 bg-gray-100 p-9 text-center lg:w-1/3">
                @if ($fields['note_title'])
                    <span class="list-note__note-title text-lg font-medium">
                        {{ $fields['note_title'] }}
                    </span>
                @endif

                <ul class="list-note__note-list w-full text-black/60">
                    @foreach ($fields['note_list'] as $item)
                        <li
                            class="list-note__note-item flex items-center justify-center gap-x-1.5 border-b border-zinc-200 py-3 text-xs last:border-none">
                            <span class="text-sm">
                                ×
                            </span>

                            {{ $item['point'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
