@php
    /**
     * Checkout Form
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.4.0
     */

    if (!defined('ABSPATH')) {
        exit();
    }
@endphp

<section class="checkout">
    @php do_action('woocommerce_before_checkout_form', $checkout) @endphp

    @php
        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
            echo esc_html(
                apply_filters(
                    'woocommerce_checkout_must_be_logged_in_message',
                    __('You must be logged in to checkout.', 'woocommerce'),
                ),
            );
            return;
        }
    @endphp

    <form
        action="{{ esc_url(wc_get_checkout_url()) }}"
        aria-label="{{ esc_attr__('Checkout', 'woocommerce') }}"
        class="checkout__checkout-form checkout-form woocommerce-checkout flex gap-16"
        enctype="multipart/form-data"
        method="post"
        name="checkout"
    >
        @if ($checkout->get_checkout_fields())
            @php do_action('woocommerce_checkout_before_customer_details') @endphp

            <div class="checkout-form__fields flex grow flex-col gap-y-6" id="customer_details">
                @php do_action('woocommerce_checkout_billing') @endphp

                @php do_action('woocommerce_checkout_shipping') @endphp
            </div>

            @php do_action('woocommerce_checkout_after_customer_details') @endphp
        @endif

        <div
            class="checkout__collaterals checkout-collaterals h-fit w-full max-w-lg rounded-2xl border border-zinc-200 p-10">
            @php do_action('woocommerce_checkout_before_order_review_heading') @endphp

            {{-- <h3 id="order_review_heading">
                @php esc_html_e('Your order', 'woocommerce') @endphp
            </h3> --}}

            @php do_action('woocommerce_checkout_before_order_review') @endphp

            <div class="woocommerce-checkout-review-order" id="order_review">
                @php do_action('woocommerce_checkout_order_review') @endphp
            </div>

            @php do_action('woocommerce_checkout_after_order_review') @endphp
        </div>
    </form>

    @php do_action('woocommerce_after_checkout_form', $checkout) @endphp
</section>
