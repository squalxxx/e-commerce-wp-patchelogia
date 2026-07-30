<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined('ABSPATH') || exit();

do_action('woocommerce_before_shipping_calculator'); ?>

<form
    action="<?php echo esc_url(wc_get_cart_url()); ?>"
    class="woocommerce-shipping-calculator"
    method="post"
>
    <?php printf('<a href="#" class="shipping-calculator-button" aria-expanded="false" aria-controls="shipping-calculator-form" role="button">%s</a>', esc_html(!empty($button_text) ? $button_text : __('Calculate shipping', 'woocommerce'))); ?>

    <section
        class="shipping-calculator-form"
        id="shipping-calculator-form"
        style="display:none;"
    >
        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_country_field">
            <label for="calc_shipping_country"><?php esc_html_e('Country / region', 'woocommerce'); ?></label>
            <select
                class="country_to_state country_select"
                id="calc_shipping_country"
                name="calc_shipping_country"
                rel="calc_shipping_state"
            >
                <option value="default"><?php esc_html_e('Select a country / region&hellip;', 'woocommerce'); ?></option>
                <?php
                foreach (WC()->countries->get_shipping_countries() as $key => $value) {
                    echo '<option value="' . esc_attr($key) . '"' . selected(WC()->customer->get_shipping_country(), esc_attr($key), false) . '>' . esc_html($value) . '</option>';
                }
                ?>
            </select>
        </p>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_state_field">
            <?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {
					?>
            <input
                id="calc_shipping_state"
                name="calc_shipping_state"
                type="hidden"
            />
            <?php
				} elseif ( is_array( $states ) ) {
					?>
            <span>
                <label for="calc_shipping_state"><?php esc_html_e('State / County', 'woocommerce'); ?></label>
                <select
                    class="state_select"
                    id="calc_shipping_state"
                    name="calc_shipping_state"
                >
                    <option value=""><?php esc_html_e('Select an option&hellip;', 'woocommerce'); ?></option>
                    <?php
                    foreach ($states as $ckey => $cvalue) {
                        echo '<option value="' . esc_attr($ckey) . '" ' . selected($current_r, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                    }
                    ?>
                </select>
            </span>
            <?php
				} else {
					?>
            <label for="calc_shipping_state"><?php esc_html_e('State / County', 'woocommerce'); ?></label>
            <input
                class="input-text"
                id="calc_shipping_state"
                name="calc_shipping_state"
                type="text"
                value="<?php echo esc_attr($current_r); ?>"
            />
            <?php
				}
				?>
        </p>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_city_field">
            <label for="calc_shipping_city"><?php esc_html_e('City:', 'woocommerce'); ?></label>
            <input
                class="input-text"
                id="calc_shipping_city"
                name="calc_shipping_city"
                type="text"
                value="<?php echo esc_attr(WC()->customer->get_shipping_city()); ?>"
            />
        </p>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
            <label for="calc_shipping_postcode"><?php esc_html_e('Postcode / ZIP:', 'woocommerce'); ?></label>
            <input
                class="input-text"
                id="calc_shipping_postcode"
                name="calc_shipping_postcode"
                type="text"
                value="<?php echo esc_attr(WC()->customer->get_shipping_postcode()); ?>"
            />
        </p>
        <?php endif; ?>

        <button
            class="button{{ esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') }} hover-roll w-full"
            name="calc_shipping"
            type="submit"
            value="1"
        >
            <x-hover-roll text="Обновить" />
        </button>

        <?php wp_nonce_field('woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce'); ?>
    </section>
</form>

<?php do_action('woocommerce_after_shipping_calculator'); ?>
