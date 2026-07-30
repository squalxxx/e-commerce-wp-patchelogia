{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}

@extends('layouts.app')

@section('content')
    <main class="archive-product min-h-screen">
        @if (apply_filters('woocommerce_show_page_title', true))
            <x-page-header :title="$pageTitle" class="pb-12 pt-24" />
        @endif

        @php do_action('woocommerce_archive_description'); @endphp

        <div class="custom-md-container pb-24">
            @php
                do_action('get_header', 'shop');

                /**
                 * Hook: woocommerce_before_main_content.
                 *
                 * @hooked woocommerce_breadcrumb - 20
                 * @hooked WC_Structured_Data::generate_website_data() - 30
                 * @hooked woocommerce_output_all_notices - 40
                 */
                do_action('woocommerce_before_main_content');
            @endphp

            @if (woocommerce_product_loop())
                <div class="archive-product__loop-header mb-6 flex justify-between">
                    @php
                        /**
                         * Hook: woocommerce_before_shop_loop.
                         */
                        do_action('woocommerce_before_shop_loop');
                    @endphp
                </div>

                @php woocommerce_product_loop_start(); @endphp

                @if (wc_get_loop_prop('total'))
                    @while (have_posts())
                        @php
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        @endphp
                    @endwhile
                @endif

                @php
                    woocommerce_product_loop_end();

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action('woocommerce_after_shop_loop');
                @endphp
            @else
                @php
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action('woocommerce_no_products_found');
                @endphp
            @endif
        </div>

        @php
            $page = get_post(wc_get_page_id('shop'));
            $content = apply_filters('the_content', $page->post_content);

            echo $content;
        @endphp

        @php
            /**
             * Hook: woocommerce_after_main_content.
             */
            do_action('woocommerce_after_main_content');

            do_action('get_sidebar', 'shop');
            do_action('get_footer', 'shop');
        @endphp
    </main>
@endsection
