<section class="info-panel">
    <div class="info-panel__container custom-sm-container">
        <ul class="info-panel__cards grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach ($fields['cards'] as $card)
                <li class="info-panel__card flex flex-col gap-y-4 rounded-2xl border border-zinc-200 p-4 md:p-8">
                    <h2 class="info-panel__title text-primary text-black/45">
                        {{ $card['title'] }}
                    </h2>

                    @if (!empty($card['subtitle']))
                        <p class="info-panel__subtitle">
                            {{ $card['subtitle'] }}
                        </p>
                    @endif

                    @if (!empty($card['image']))
                        <div class="info-panel__image">
                            <img src="{{ wp_get_attachment_image_url($card['image'], 'full') }}">
                        </div>
                    @endif

                    @if (!empty($card['content']))
                        <p class="info-panel__content">
                            {{ $card['content'] }}
                        </p>
                    @endif

                    @if (!empty($card['notice']))
                        <span class="border-t border-zinc-200"></span>

                        <p class="info-panel__notice text-xs leading-5 text-black/60">
                            {{ $card['notice'] }}
                        </p>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>
