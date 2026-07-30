@php
    /**
     * Thankyou page
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 8.1.0
     *
     * @var WC_Order $order
     */

    defined('ABSPATH') || exit();
@endphp

<section class="checkout__order checkout-order woocommerce-order align-full">
    <div class="checkout-order__container custom-sm-container">
        @if ($order)
            @php do_action( 'woocommerce_before_thankyou', $order->get_id() ) @endphp

            @if ($order->has_status('failed'))
                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                    @php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce') @endphp
                </p>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                    <a class="button pay" href="{{ esc_url($order->get_checkout_payment_url()) }}">
                        @php esc_html_e('Pay', 'woocommerce') @endphp
                    </a>

                    @if (is_user_logged_in())
                        <a class="button pay" href="{{ esc_url(wc_get_page_permalink('myaccount')) }}">
                            @php esc_html_e('My account', 'woocommerce') @endphp
                        </a>
                    @endif
                </p>
            @else
                @php wc_get_template('checkout/order-received.php', ['order' => $order]) @endphp

                <ul
                    class="woocommerce-order-overview woocommerce-thankyou-order-details order_details mb-6 grid grid-cols-2 gap-1">
                    <li class="woocommerce-order-overview__order order">
                        @php esc_html_e('Order number:', 'woocommerce') @endphp
                        <span class="font-medium">{{ $order->get_order_number() }}</span>
                    </li>

                    <li class="woocommerce-order-overview__date date">
                        @php esc_html_e('Date:', 'woocommerce') @endphp
                        <span class="font-medium">{{ wc_format_datetime($order->get_date_created()) }}</span>
                    </li>

                    @if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email())
                        <li class="woocommerce-order-overview__email email">
                            @php esc_html_e('Email:', 'woocommerce') @endphp
                            <span class="font-medium">{{ $order->get_billing_email() }}</span>
                        </li>
                    @endif

                    <li class="woocommerce-order-overview__total total">
                        @php esc_html_e('Total:', 'woocommerce') @endphp
                        <span class="font-medium">{!! $order->get_formatted_order_total() !!}</span>
                    </li>

                    @if ($order->get_payment_method_title())
                        <li class="woocommerce-order-overview__payment-method method">
                            @php esc_html_e('Payment method:', 'woocommerce') @endphp
                            <span class="font-medium">{{ wp_kses_post($order->get_payment_method_title()) }}</span>
                        </li>
                    @endif
                </ul>
            @endif

            @php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()) @endphp
            @php do_action('woocommerce_thankyou', $order->get_id()) @endphp
        @else
            @php wc_get_template('checkout/order-received.php', ['order' => false]) @endphp
        @endif
    </div>
</section>
