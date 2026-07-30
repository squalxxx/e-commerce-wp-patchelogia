@php
    /**
     * Simple product add to cart
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 10.2.0
     */

    defined('ABSPATH') || exit();

    global $product;

    if (!$product->is_purchasable()) {
        return;
    }
@endphp

{{-- {!! wc_get_stock_html($product) !!} --}}

@if ($product->is_in_stock())
    @php do_action('woocommerce_before_add_to_cart_form'); @endphp

    <form
        action="{{ esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) }}"
        class="cart mb-14"
        enctype='multipart/form-data'
        method="post"
    >
        @php do_action('woocommerce_before_add_to_cart_quantity'); @endphp

        <div class="mb-4 flex items-center justify-between overflow-hidden rounded-full border border-zinc-200" x-data>
            <button
                @click="
                const input = $refs.quantity;
                if (+input.value > +input.min) {
                    input.stepDown();
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            "
                class="flex h-12 w-16 cursor-pointer items-center justify-center text-2xl transition hover:bg-zinc-100"
                type="button"
            >
                −
            </button>

            <input
                class="w-16 border-none bg-transparent text-center text-lg outline-none"
                max="{{ $product->get_max_purchase_quantity() > 0 ? $product->get_max_purchase_quantity() : '' }}"
                min="{{ $product->get_min_purchase_quantity() }}"
                name="quantity"
                type="number"
                value="{{ $product->get_min_purchase_quantity() }}"
                x-ref="quantity"
            >

            <button
                @click="
                const input = $refs.quantity;
                if (!input.max || +input.value < +input.max) {
                    input.stepUp();
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            "
                class="flex h-12 w-16 cursor-pointer items-center justify-center text-2xl transition hover:bg-zinc-100"
                type="button"
            >
                +
            </button>
        </div>

        @php do_action('woocommerce_after_add_to_cart_quantity'); @endphp

        @php do_action('woocommerce_before_add_to_cart_button'); @endphp

        <button
            class="single_add_to_cart_button button alt{{ esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') }} hover-roll w-full py-5"
            name="add-to-cart"
            type="submit"
            value="{{ esc_attr($product->get_id()) }}"
        >
            <span class="hover-roll__container">
                <span class="hover-roll__items">
                    <span class="hover-roll__item">
                        {{ esc_html($product->single_add_to_cart_text()) }}
                    </span>

                    <span class="hover-roll__item">
                        {{ esc_html($product->single_add_to_cart_text()) }}
                    </span>
                </span>
            </span>
        </button>

        @php do_action('woocommerce_after_add_to_cart_button'); @endphp
    </form>

    @php do_action('woocommerce_after_add_to_cart_form'); @endphp
@endif
