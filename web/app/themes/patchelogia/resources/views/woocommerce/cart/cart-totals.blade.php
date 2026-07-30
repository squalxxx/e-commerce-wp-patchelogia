@php
    /**
     * Cart totals
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 2.3.6
     */

    defined('ABSPATH') || exit();
@endphp

<div class="cart__totals cart_totals {{ WC()->customer->has_calculated_shipping() ? 'calculated_shipping' : '' }}">
    @php do_action('woocommerce_before_cart_totals') @endphp

    {{-- <h2 class="mb-2">
        @php esc_html_e('Cart totals', 'woocommerce') @endphp
    </h2> --}}

    <div class="shop_table mb-8">
        <div class="flex flex-col gap-y-3">
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
                @php do_action('woocommerce_cart_totals_before_shipping') @endphp

                @php wc_cart_totals_shipping_html() @endphp

                @php do_action('woocommerce_cart_totals_after_shipping') @endphp
            @elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc'))
                <div class="shipping flex justify-between gap-x-2">
                    <span>
                        @php esc_html_e('Shipping', 'woocommerce') @endphp
                    </span>

                    <span class="grow border-b border-zinc-200"></span>

                    <span>
                        @php woocommerce_shipping_calculator() @endphp
                    </span>
                </div>
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

            {{-- @if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax())
                @php
                    $taxable_address = WC()->customer->get_taxable_address();
                    $estimated_text = '';
                @endphp

                @if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping())
                    @php
                        /* translators: %s location. */
                        $estimated_text = sprintf(
                            ' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>',
                            WC()->countries->estimated_for_prefix($taxable_address[0]) .
                                WC()->countries->countries[$taxable_address[0]],
                        );
                    @endphp
                @endif

                @if ('itemized' === get_option('woocommerce_tax_total_display'))
                    @foreach (WC()->cart->get_tax_totals() as $code => $tax)
                        <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                            <th>
                                {{ esc_html($tax->label) . $estimated_text }}
                            </th>

                            <td data-title="{{ esc_attr($tax->label) }}">
                                {{ wp_kses_post($tax->formatted_amount) }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="tax-total">
                        <th>
                            {{ esc_html(WC()->countries->tax_or_vat()) . $estimated_text }}
                        </th>

                        <td data-title="{{ esc_attr(WC()->countries->tax_or_vat()) }}">
                            @php wc_cart_totals_taxes_total_html() @endphp
                        </td>
                    </tr>
                @endif
            @endif --}}

            @php do_action('woocommerce_cart_totals_before_order_total') @endphp

            <div class="order-total flex justify-between gap-x-2">
                <span class="font-medium">
                    @php esc_html_e('Total', 'woocommerce') @endphp
                </span>

                <span class="grow border-b border-zinc-200"></span>

                <span>
                    @php wc_cart_totals_order_total_html() @endphp
                </span>
            </div>

            @php do_action('woocommerce_cart_totals_after_order_total') @endphp
        </div>
    </div>

    <div class="wc-proceed-to-checkout">
        @php do_action('woocommerce_proceed_to_checkout') @endphp
    </div>

    @php do_action('woocommerce_after_cart_totals') @endphp
</div>
