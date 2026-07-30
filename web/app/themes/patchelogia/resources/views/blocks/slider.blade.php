<section @class(['slider py-30', 'align-full' => $block['align'] === 'full'])>
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="slider__header mb-14"
    />

    <div class="slider__container custom-container">
        <div class="slider__swiper swiper h-100" id="sliderSwiper">
            <div class="swiper-wrapper">
                @foreach ($fields['items'] as $item)
                    <div class="slider__slide swiper-slide gradient-shading-image content-end overflow-hidden rounded-2xl border border-zinc-200 p-5"
                        style="background: url({{ wp_get_attachment_image_url($item['image'], 'full') }}) center / cover no-repeat"
                    >
                        <div class="slider__slide-holder relative z-10">
                            <span class="slider__slide-count text-primary block text-white/60">
                                {{ sprintf('%02d', $loop->iteration) }}
                            </span>

                            <h4 class="slider__slide-title text-lg text-white">
                                {{ $item['title'] }}
                            </h4>

                            @if ($item['description'])
                                <p class="slider__slide-description mt-2 text-xs text-white">
                                    {{ $item['description'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
