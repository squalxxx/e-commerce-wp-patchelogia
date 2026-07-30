<section @class([
    'video py-30 px-3 xs:px-0',
    'align-full' => $block['align'] === 'full',
])>
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="video__header mb-14"
    />

    <div class="video-swiper swiper" id="videoSwiper">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 10; $i++)
                @foreach ($fields['slides'] as $item)
                    @php
                        $product = wc_get_product($item['product']);
                    @endphp

                    <div class="video-swiper__slide swiper-slide flex! flex-col gap-y-4">
                        <div class="video-swiper__media shading-image h-140 overflow-hidden rounded-2xl">
                            <img class="h-full w-full object-cover"
                                src="{{ wp_get_attachment_image_url($item['preview'], 'full') }}"
                            >

                            <video
                                class="video-swiper__video absolute inset-0 hidden h-full w-full object-cover"
                                controls
                                loop
                                muted
                                playsinline
                                preload="metadata"
                            >
                                <source src="{{ wp_get_attachment_url($item['video']) }}" type="video/mp4">
                            </video>
                        </div>

                        <div class="video-swiper__product group flex items-center gap-x-2">
                            <a class="video-swiper__product-image h-12 w-12 overflow-hidden rounded-lg border border-zinc-200 transition-colors group-hover:border-neutral-900"
                                href="{{ $product->get_permalink() }}"
                            >
                                <?= $product->get_image('woocommerce_thumbnail', [
                                    'class' => 'h-full w-full object-cover',
                                ]) ?>
                            </a>

                            <a class="video-swiper__product-holder grow-1" href="{{ $product->get_permalink() }}">
                                {{ $product->get_name() }}

                                @if ($price_html = $product->get_price_html())
                                    <div class="video-swiper__product-price price font-medium">
                                        {!! $price_html !!}
                                    </div>
                                @endif
                            </a>

                            @if ($product->is_purchasable() && $product->is_in_stock())
                                <a
                                    class="add_to_cart_button ajax_add_to_cart flex h-9 w-9 items-center justify-center rounded-full bg-black text-lg font-medium text-white transition-all hover:rotate-90"
                                    data-product_id="{{ $product->get_id() }}"
                                    data-quantity="1"
                                    href="{{ esc_url($product->add_to_cart_url()) }}"
                                    rel="nofollow"
                                >
                                    +
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endfor
        </div>
    </div>
</section>
