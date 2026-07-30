@php
    /**
     * Cart Page
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 10.8.0
     */

    defined('ABSPATH') || exit();
@endphp

@php do_action('woocommerce_before_cart') @endphp

<section class="cart flex flex-col items-center gap-16 sm:items-start xl:flex-row">
    <form
        action="{{ esc_url(wc_get_cart_url()) }}"
        class="cart__form cart-form woocommerce-cart-form w-full xl:w-2/3"
        method="post"
    >
        @php do_action('woocommerce_before_cart_table') @endphp

        <div class="cart-form__items woocommerce-cart-form__contents flex flex-col gap-y-6">
            @php do_action('woocommerce_before_cart_contents') @endphp

            @foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
                @php
                    $_product = apply_filters(
                        'woocommerce_cart_item_product',
                        $cart_item['data'],
                        $cart_item,
                        $cart_item_key,
                    );
                    $product_id = apply_filters(
                        'woocommerce_cart_item_product_id',
                        $cart_item['product_id'],
                        $cart_item,
                        $cart_item_key,
                    );

                    /**
                     * Filter whether this cart item is visible in the cart.
                     *
                     * @since 2.1.0
                     * @param bool   $visible     Whether the cart item is visible. Default true.
                     * @param array  $cart_item     The cart item data.
                     * @param string $cart_item_key The cart item key.
                     */
                    $visible = apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key);
                @endphp

                @if ($_product instanceof WC_Product && $_product->exists() && $cart_item['quantity'] > 0 && $visible)
                    @php
                        /**
                         * Filter the product name.
                         *
                         * @since 2.1.0
                         * @param string $product_name Name of the product in the cart.
                         * @param array $cart_item The product in the cart.
                         * @param string $cart_item_key Key for the product in the cart.
                         */
                        $product_name = apply_filters(
                            'woocommerce_cart_item_name',
                            $_product->get_name(),
                            $cart_item,
                            $cart_item_key,
                        );
                        $product_permalink = apply_filters(
                            'woocommerce_cart_item_permalink',
                            $_product->is_visible() ? $_product->get_permalink($cart_item) : '',
                            $cart_item,
                            $cart_item_key,
                        );
                    @endphp

                    <div
                        class="cart-form__item woocommerce-cart-form__cart-item {{ esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)) }} flex flex-col items-center justify-between gap-4 border-b border-zinc-200 pb-6 last:border-none sm:flex-row">
                        <div class="product-thumbnail">
                            @php
                                /**
                                 * Filter the product thumbnail displayed in the WooCommerce cart.
                                 *
                                 * This filter allows developers to customize the HTML output of the product
                                 * thumbnail. It passes the product image along with cart item data
                                 * for potential modifications before being displayed in the cart.
                                 *
                                 * @param string $thumbnail     The HTML for the product image.
                                 * @param array  $cart_item     The cart item data.
                                 * @param string $cart_item_key Unique key for the cart item.
                                 *
                                 * @since 2.1.0
                                 */
                                $thumbnail = apply_filters(
                                    'woocommerce_cart_item_thumbnail',
                                    $_product->get_image('medium', [
                                        'class' => 'w-auto h-full object-cover transition-all group-hover:scale-110',
                                    ]),
                                    $cart_item,
                                    $cart_item_key,
                                );
                            @endphp

                            @if (!$product_permalink)
                                {!! $thumbnail !!}
                            @else
                                <a class="group block h-36 w-fit overflow-hidden rounded-lg bg-gray-50"
                                    href="{{ esc_url($product_permalink) }}"
                                >
                                    {!! $thumbnail !!}
                                </a>
                            @endif
                        </div>

                        <div class="flex flex-col items-center gap-y-1 sm:items-start">
                            <div
                                class="product-name hover-underline text-lg uppercase tracking-widest"
                                data-title="@php esc_attr_e('Product', 'woocommerce') @endphp"
                                role="rowheader"
                                scope="row"
                            >
                                @php
                                    if (!$product_permalink) {
                                        echo wp_kses_post($product_name . '&nbsp;');
                                    } else {
                                        /**
                                         * This filter is documented above.
                                         *
                                         * @since 2.1.0
                                         */
                                        echo wp_kses_post(
                                            apply_filters(
                                                'woocommerce_cart_item_name',
                                                sprintf(
                                                    '<a href="%s">%s</a>',
                                                    esc_url($product_permalink),
                                                    $_product->get_name(),
                                                ),
                                                $cart_item,
                                                $cart_item_key,
                                            ),
                                        );
                                    }

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if (
                                        $_product->backorders_require_notification() &&
                                        $_product->is_on_backorder($cart_item['quantity'])
                                    ) {
                                        echo wp_kses_post(
                                            apply_filters(
                                                'woocommerce_cart_item_backorder_notification',
                                                '<p class="backorder_notification">' .
                                                    esc_html__('Available on backorder', 'woocommerce') .
                                                    '</p>',
                                                $product_id,
                                            ),
                                        );
                                    }
                                @endphp
                            </div>

                            <div class="product-price font-medium" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                {!! apply_filters(
                                    'woocommerce_cart_item_price',
                                    WC()->cart->get_product_price($_product),
                                    $cart_item,
                                    $cart_item_key,
                                ) !!}
                            </div>
                        </div>

                        <div class="product-quantity flec-col flex items-center gap-x-10"
                            data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>"
                        >
                            @php
                                if ($_product->is_sold_individually()) {
                                    $min_quantity = 1;
                                    $max_quantity = 1;
                                } else {
                                    $min_quantity = 1;
                                    $max_quantity = $_product->get_max_purchase_quantity();
                                }

                                $product_quantity = woocommerce_quantity_input(
                                    [
                                        'input_name' => "cart[{$cart_item_key}][qty]",
                                        'input_value' => $cart_item['quantity'],
                                        'max_value' => $max_quantity,
                                        'min_value' => $min_quantity,
                                        'product_name' => $product_name,
                                    ],
                                    $_product,
                                    false,
                                );
                            @endphp

                            <div
                                :class="{ 'opacity-50 pointer-events-none': loading }"
                                class="quantity-stepper inline-flex items-center rounded-lg border border-zinc-200"
                                data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>"
                                x-data="cartQuantityStepper({
                                    key: '{{ esc_js($cart_item_key) }}',
                                    quantity: {{ (int) $cart_item['quantity'] }},
                                    min: {{ (int) $min_quantity }},
                                    max: {{ $max_quantity ? (int) $max_quantity : 'null' }},
                                })"
                            >
                                <button
                                    :disabled="quantity <= min"
                                    @click="decrement()"
                                    aria-label="{{ esc_attr__('Decrease quantity', 'woocommerce') }}"
                                    class="flex h-9 w-9 cursor-pointer items-center justify-center text-zinc-500 transition hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-30"
                                    type="button"
                                >&minus;</button>

                                <input
                                    :max="max ?? undefined"
                                    :min="min"
                                    @change="commit()"
                                    class="w-10 border-0 bg-transparent text-center text-sm [appearance:textfield] focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                    inputmode="numeric"
                                    name="cart[{{ $cart_item_key }}][qty]"
                                    type="number"
                                    x-model.number="quantity"
                                />

                                <button
                                    :disabled="max !== null && quantity >= max"
                                    @click="increment()"
                                    aria-label="{{ esc_attr__('Increase quantity', 'woocommerce') }}"
                                    class="flex h-9 w-9 cursor-pointer items-center justify-center text-zinc-500 transition hover:text-zinc-900 disabled:pointer-events-none disabled:opacity-30"
                                    type="button"
                                >+</button>
                            </div>

                            <div
                                class="product-subtotal font-medium"
                                data-cart-item-key="{{ esc_attr($cart_item_key) }}"
                                data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"
                            >
                                {!! apply_filters(
                                    'woocommerce_cart_item_subtotal',
                                    WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
                                    $cart_item,
                                    $cart_item_key,
                                ) !!}
                            </div>
                        </div>

                        <div class="product-remove scale-120 px-2 text-2xl transition-all hover:scale-100">
                            {!! apply_filters(
                                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                    /* translators: %s is the product name */
                                    esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                                    esc_attr($product_id),
                                    esc_attr($_product->get_sku()),
                                ),
                                $cart_item_key,
                            ) !!}
                        </div>
                    </div>
                @endif
            @endforeach

            @php do_action('woocommerce_after_cart_contents'); @endphp
        </div>

        @php do_action('woocommerce_after_cart_table'); @endphp
    </form>

    @php do_action('woocommerce_before_cart_collaterals'); @endphp

    <div
        class="cart__collaterals cart-collaterals item-center h-fit w-full max-w-2xl rounded-2xl border border-zinc-200 p-8 sm:p-10 xl:w-1/3">
        <div class="cart__actions actions mb-6" colspan="6">
            @if (wc_coupons_enabled())
                <div class="coupon mb-6 flex items-center justify-between gap-x-4">
                    <input
                        class="input input--sharpened input-text grow"
                        id="coupon_code"
                        name="coupon_code"
                        placeholder="@php esc_attr_e('Coupon code', 'woocommerce') @endphp"
                        type="text"
                        value=""
                    />

                    <button
                        class="button{{ esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') }} hover-roll"
                        name="apply_coupon"
                        type="submit"
                        value="@php esc_attr_e('Apply coupon', 'woocommerce') @endphp"
                    >
                        <x-hover-roll text="Применить купон" />
                    </button>
                </div>

                @php do_action('woocommerce_cart_coupon') @endphp
            @endif

            <button
                class="button{{ esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') }} button--inverted hover-roll w-full"
                name="update_cart"
                type="submit"
                value="@php esc_attr_e('Update cart', 'woocommerce') @endphp"
            >
                <x-hover-roll text="Обновить корзину" />
            </button>

            @php do_action('woocommerce_cart_actions') @endphp

            @php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce') @endphp
        </div>

        @php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
        @endphp
    </div>
</section>

@php do_action('woocommerce_after_cart'); @endphp
