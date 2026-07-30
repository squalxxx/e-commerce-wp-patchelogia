@php
    /**
     * Single Product Image
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 10.5.0
     */

    use Automattic\WooCommerce\Enums\ProductType;

    defined('ABSPATH') || exit();

    global $product;

    $imageIds = $product->get_gallery_image_ids();
    array_unshift($imageIds, $product->get_image_id());
@endphp

<div class="product-gallery__swiper swiper lg:hidden! h-120" id="productGallerySwiper">
    <div class="swiper-wrapper">
        @foreach ($imageIds as $imageId)
            <div class="product-gallery__slide swiper-slide">
                <img class="h-full w-full object-cover" src="{{ wp_get_attachment_image_url($imageId, 'full') }}" />
            </div>
        @endforeach
    </div>
</div>

<div class="product-gallery__grid hidden grid-cols-2 gap-4 lg:grid">
    @foreach ($imageIds as $imageId)
        <div>
            <img class="h-full w-full object-cover" src="{{ wp_get_attachment_image_url($imageId, 'full') }}" />
        </div>
    @endforeach
</div>
