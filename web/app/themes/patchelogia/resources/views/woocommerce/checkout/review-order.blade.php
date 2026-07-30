@php
    /**
     * Review order table
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 5.2.0
     */

    defined('ABSPATH') || exit();
@endphp

<div class="shop_table woocommerce-checkout-review-order-table mb-4 flex flex-col gap-y-3">
    @php do_action( 'woocommerce_review_order_before_cart_contents' ) @endphp

    @foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
        @php $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key) @endphp

        @if (
            $_product &&
                $_product->exists() &&
                $cart_item['quantity'] > 0 &&
                apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key))
            <div
                class="{{ esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)) }} flex justify-between gap-x-2">
                <span class="product-name">
                    {!! wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) !!}

                    {!! apply_filters(
                        'woocommerce_checkout_cart_item_quantity',
                        ' <span class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</span>',
                        $cart_item,
                        $cart_item_key,
                    ) !!}

                    {!! wc_get_formatted_cart_item_data($cart_item) !!}
                </span>

                <span class="grow border-b border-zinc-200"></span>

                <span class="product-total">
                    {!! apply_filters(
                        'woocommerce_cart_item_subtotal',
                        WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
                        $cart_item,
                        $cart_item_key,
                    ) !!}
                </span>
            </div>
        @endif
    @endforeach

    @php do_action( 'woocommerce_review_order_after_cart_contents' ) @endphp

    <div class="cart-subtotal flex justify-between gap-x-2">
        <span>
            @php esc_html_e('Subtotal', 'woocommerce') @endphp
        </span>

        <span class="grow border-b border-zinc-200"></span>

        <span>
            @php wc_cart_totals_subtotal_html() @endphp
        </span>
    </div>

    @foreach (WC()->cart->get_coupons() as $code => $coupon)
        <div class="cart-discount coupon-{{ esc_attr(sanitize_title($code)) }} flex justify-between gap-x-2">
            <span>
                @php wc_cart_totals_coupon_label($coupon) @endphp
            </span>

            <span class="grow border-b border-zinc-200"></span>

            <span>
                @php wc_cart_totals_coupon_html($coupon) @endphp
            </span>
        </div>
    @endforeach

    @if (WC()->cart->needs_shipping() && WC()->cart->show_shipping())
        @php do_action('woocommerce_review_order_before_shipping') @endphp

        @php wc_cart_totals_shipping_html() @endphp

        @php do_action('woocommerce_review_order_after_shipping') @endphp
    @endif

    @foreach (WC()->cart->get_fees() as $fee)
        <div class="fee flex justify-between gap-x-2">
            <span>
                {{ esc_html($fee->name) }}
            </span>

            <span class="grow border-b border-zinc-200"></span>

            <span>
                @php wc_cart_totals_fee_html($fee) @endphp
            </span>
        </div>
    @endforeach

    @if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax())
        @if ('itemized' === get_option('woocommerce_tax_total_display'))
            @foreach (WC()->cart->get_tax_totals() as $code => $tax)
                <div class="tax-rate tax-rate-{{ esc_attr(sanitize_title($code)) }} flex justify-between gap-x-2">
                    <span>
                        {{ esc_html($tax->label) }}
                    </span>

                    <span class="grow border-b border-zinc-200"></span>

                    <span>
                        {!! wp_kses_post($tax->formatted_amount) !!}
                    </span>
                </div>
            @endforeach
        @else
            <div class="tax-total flex justify-between gap-x-2">
                <span>
                    {{ esc_html(WC()->countries->tax_or_vat()) }}
                </span>

                <span class="grow border-b border-zinc-200"></span>

                <span>
                    {!! wc_cart_totals_taxes_total_html() !!}
                </span>
            </div>
        @endif
    @endif

    @php do_action('woocommerce_review_order_before_order_total') @endphp

    <div class="order-total flex justify-between gap-x-2">
        <span class="font-medium">
            @php esc_html_e('Total', 'woocommerce') @endphp
        </span>

        <span class="grow border-b border-zinc-200"></span>

        <span>
            @php wc_cart_totals_order_total_html() @endphp
        </span>
    </div>

    @php do_action('woocommerce_review_order_after_order_total') @endphp
</div>
