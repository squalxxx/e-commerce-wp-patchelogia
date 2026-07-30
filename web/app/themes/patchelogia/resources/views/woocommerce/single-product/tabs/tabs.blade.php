@php
    /**
     * Single Product tabs
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.8.0
     */

    if (!defined('ABSPATH')) {
        exit();
    }

    /**
     * Filter tabs and allow third parties to add their own.
     *
     * Each tab is an array containing title, callback and priority.
     *
     * @see woocommerce_default_product_tabs()
     */
    $product_tabs = apply_filters('woocommerce_product_tabs', []);
    $active_tab = array_key_first($product_tabs);
@endphp

@if (!empty($product_tabs))
    <div class="product-tabs" x-data="{ active: '{{ $active_tab }}' }">
        <div class="product-tabs__nav grid grid-cols-1 gap-x-8 gap-y-2 sm:grid-cols-2" id="productTabsSwiper">
            @foreach ($product_tabs as $key => $product_tab)
                <div class="product-tabs__nav-item">
                    <button
                        :aria-selected="active === '{{ $key }}'"
                        :class="active === '{{ $key }}'
                            ?
                            'border-neutral-900 text-neutral-900' :
                            'border-transparent text-black/60 hover:text-neutral-900'"
                        @click="active = '{{ $key }}'"
                        aria-controls="tab-{{ esc_attr($key) }}"
                        class="product-tabs__nav-link flex w-full cursor-pointer items-center justify-between whitespace-nowrap border-b py-2 text-left text-sm uppercase tracking-[0.10em] transition-colors"
                        id="tab-title-{{ esc_attr($key) }}"
                        role="tab"
                        type="button"
                    >
                        {{ wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)) }}

                        <span
                            :class="active === '{{ $key }}'
                                ?
                                'opacity-100' :
                                'opacity-0'"
                            class="transition-opacity"
                        >
                            {{ $loop->iteration }}
                        </span>
                    </button>
                </div>
            @endforeach
        </div>

        @foreach ($product_tabs as $key => $product_tab)
            <div
                aria-labelledby="tab-title-{{ esc_attr($key) }}"
                class="product-tabs__panel pt-6"
                id="tab-{{ esc_attr($key) }}"
                role="tabpanel"
                x-cloak
                x-show="active === '{{ $key }}'"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter="transition ease-out duration-300"
            >
                <div class="product-tabs__content page-content text-black/60">
                    @php
                        if (isset($product_tab['callback'])) {
                            call_user_func($product_tab['callback'], $key, $product_tab);
                        }
                    @endphp
                </div>
            </div>
        @endforeach

        @php do_action('woocommerce_product_after_tabs'); @endphp
    </div>
@endif
