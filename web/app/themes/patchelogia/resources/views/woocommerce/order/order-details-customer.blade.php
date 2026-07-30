@php
    /**
     * Order Customer Details
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 8.7.0
     */

    defined('ABSPATH') || exit();

    $show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
@endphp

<section class="customer-details woocommerce-customer-details border-t border-zinc-200 pt-6">
    @if ($show_shipping)
        <!-- .col-2-set -->
        <section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
            <!-- .col-1 -->
            <div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">
    @endif

    <div class="flex justify-between">
        <address>
            <p class="text-primary not-italic">Адрес доставки:</p>

            {!! wp_kses_post($order->get_formatted_billing_address(esc_html__('N/A', 'woocommerce'))) !!}

            @php
                /**
                 * Action hook fired after an address in the order customer details.
                 *
                 * @since 8.7.0
                 * @param string $address_type Type of address (billing or shipping).
                 * @param WC_Order $order Order object.
                 */
                do_action('woocommerce_order_details_after_customer_address', 'billing', $order);
            @endphp
        </address>

        <div class="flex flex-col text-right">
            <p class="text-primary not-italic">Контакты:</p>

            @if ($order->get_billing_phone())
                <a class="woocommerce-customer-details--phone hover-underline"
                    href="{{ phoneHref($order->get_billing_phone()) }}"
                >
                    {{ esc_html($order->get_billing_phone()) }}
                </a>
            @endif

            @if ($order->get_billing_email())
                <a class="woocommerce-customer-details--email hover-underline"
                    href="mailto:{{ $order->get_billing_email() }}"
                >
                    {{ esc_html($order->get_billing_email()) }}
                </a>
            @endif
        </div>
    </div>

    @if ($show_shipping)
        </div><!-- /.col-1 -->

        <div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
            <h2 class="woocommerce-column__title"><?php esc_html_e('Shipping address', 'woocommerce'); ?></h2>
            <address>
                {!! wp_kses_post($order->get_formatted_shipping_address(esc_html__('N/A', 'woocommerce'))) !!}

                @if ($order->get_shipping_phone())
                    <p class="woocommerce-customer-details--phone"><?php echo esc_html($order->get_shipping_phone()); ?></p>
                @endif

                @php
                    /**
                     * Action hook fired after an address in the order customer details.
                     *
                     * @since 8.7.0
                     * @param string $address_type Type of address (billing or shipping).
                     * @param WC_Order $order Order object.
                     */
                    do_action('woocommerce_order_details_after_customer_address', 'shipping', $order);
                @endphp
            </address>
        </div><!-- /.col-2 -->
</section><!-- /.col2-set -->
@endif

@php do_action('woocommerce_order_details_after_customer_details', $order) @endphp
</section>
