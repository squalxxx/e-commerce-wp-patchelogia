<section class="products py-30">
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="products__header mb-14"
    />

    <div class="custom-md-container">
        @php woocommerce_product_loop_start(); @endphp

        @foreach ($fields['products'] as $product)
            @php
                $product = wc_setup_product_data($product);
                wc_get_template_part('content', 'product');
            @endphp
        @endforeach

        @php
            woocommerce_product_loop_end();
            wp_reset_postdata();
        @endphp
    </div>
</section>
