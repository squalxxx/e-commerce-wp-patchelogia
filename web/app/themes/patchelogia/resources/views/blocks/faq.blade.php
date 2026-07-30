<section @class(['faq', 'py-30' => $fields['settings']['title_toggle']])>
    @if ($fields['settings']['title_toggle'])
        <x-block-header :title="$fields['settings']['title']" class="faq__header mb-14" />
    @endif

    <div class="faq__container custom-sm-container" x-data="{ active: null }">
        <ul class="faq__items divide-y divide-zinc-200 border-y border-zinc-200">
            @foreach ($fields['questions'] as $item)
                <li class="faq__item" x-data="{ id: {{ $loop->index }} }">
                    <button
                        @click="active = active === id ? null : id"
                        class="faq__question flex w-full cursor-pointer items-center justify-between gap-6 py-6 text-left transition-all hover:px-2"
                        type="button"
                    >
                        <span class="text-lg font-medium">
                            {{ $item['question'] }}
                        </span>

                        <span :class="{ 'rotate-45': active === id }"
                            class="relative h-5 w-5 shrink-0 transition-transform duration-300"
                        >
                            <span class="absolute left-1/2 top-0 h-full w-px -translate-x-1/2 bg-neutral-900"></span>

                            <span class="absolute left-0 top-1/2 h-px w-full -translate-y-1/2 bg-neutral-900"></span>
                        </span>
                    </button>

                    <div
                        x-cloak
                        x-collapse.duration.300ms
                        x-show="active === id"
                    >
                        <div class="faq__answer pb-6 pr-10">
                            {{ $item['answer'] }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
