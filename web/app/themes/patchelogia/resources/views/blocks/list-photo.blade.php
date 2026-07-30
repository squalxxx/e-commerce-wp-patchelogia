<section class="list-photo align-full py-30">
    <div class="custom-md-container">
        <div @class([
            'list-photo__wrapper flex flex-col gap-16',
            'md:flex-row' => $fields['image_position'] === 'left',
            'md:flex-row-reverse' => $fields['image_position'] === 'right',
        ])>
            <div
                class="list-photo__image md:top-18 md:max-w-1/2 relative h-fit shrink-0 overflow-hidden rounded-2xl border border-zinc-200 md:sticky">
                <img class="h-auto w-full object-cover"
                    src="{{ wp_get_attachment_image_url($fields['image'], 'full') }}" />

                @if ($fields['image_notice_toggle'])
                    <div
                        class="list-photo__image-notice absolute bottom-6 right-6 flex min-w-36 flex-col items-center rounded-full border border-zinc-200 bg-white/85 px-6 py-3">
                        <span class="text-heading text-3xl">
                            {{ $fields['image_notice']['title'] }}
                        </span>

                        <span class="text-primary text-black/45">
                            {{ $fields['image_notice']['subtitle'] }}
                        </span>
                    </div>
                @endif
            </div>

            <div class="list-photo__holder md:top-18 h-fit md:sticky">
                <x-block-header
                    :subtitle="$fields['subtitle']"
                    :title="$fields['title']"
                    class="list-photo__header mb-8 text-left"
                />

                @if ($fields['content'])
                    <p class="list-photo__content mb-4 text-black/60">
                        {{ $fields['content'] }}
                    </p>
                @endif

                <ul class="list-photo__list">
                    @foreach ($fields['list'] as $item)
                        <li class="list-photo__item flex gap-x-4 border-b border-zinc-200 py-4 last:border-none">
                            <span class="h-5 w-5 shrink-0 pt-0.5 text-black/45">
                                {!! file_get_contents(resource_path('images/icons/approw.svg')) !!}
                            </span>

                            <div class="w-full text-black/60">
                                {!! $item['point'] !!}
                            </div>
                        </li>
                    @endforeach
                </ul>

                @if ($fields['notice'])
                    <p class="list-photo__notice text-primary mt-4 text-black/45">
                        {{ $fields['notice'] }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>
