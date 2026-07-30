<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Remove the "Archives: " prefix from archive titles.
 */
add_filter('get_the_archive_title_prefix', '__return_empty_string');

/**
 * 
 */
add_filter('wc_empty_cart_message', function ($message) {
    return 'В вашей корзине — тишина, но это временно, поверьте, она.';
});

/**
 * Modify the "Add to Cart" button arguments in the product loop.
 */
add_filter('woocommerce_loop_add_to_cart_args', function ($args) {
    $args['class'] = trim(($args['class'] ?? '') . ' button--inverted');
    return $args;
}, 10, 1);

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
?>
    <span class="header__cart-count">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
<?php
    $fragments['.header__cart-count'] = ob_get_clean();
    return $fragments;
});

/**
 */
add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['additional_information'], $tabs['reviews']);

    global $product;

    $customTabs = get_field('tabs', $product->get_id()) ?: [];

    foreach ($customTabs as $index => $tab) {
        $key = 'custom_tab_' . $index;

        $tabs[$key] = [
            'title' => $tab['name'],
            'priority' => 20 + ($index + 1) * 10,
            'callback' => function () use ($tab) {
                echo wp_kses_post($tab['content']);
            },
        ];
    }

    return $tabs;
}, 20);

/**
 * 
 */
add_filter('woocommerce_checkout_fields', function (array $fields) {
    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_email']['priority'] = 30;
    $fields['billing']['billing_phone']['priority'] = 40;
    $fields['billing']['billing_city']['priority'] = 50;
    $fields['billing']['billing_address_1']['priority'] = 60;
    $fields['billing']['billing_postcode']['priority'] = 70;

    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);

    return $fields;
});

add_filter('woocommerce_form_field_args', function (array $args, string $key, $value) {
    $args['class'][] = 'flex flex-col';
    $args['label_class'][] = 'font-medium';
    $args['input_class'][] = 'input input--sharpened w-full';

    return $args;
}, 10, 3);
