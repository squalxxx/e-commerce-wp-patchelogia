<!DOCTYPE html>

<html {!! get_language_attributes() !!}>

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">

        {{-- @php(do_action('get_header')) --}}
        @php(wp_head())

        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,300&amp;family=Cormorant+Infant:ital,wght@1,300&amp;family=Manrope:wght@300;400;500;600;700&amp;family=Montserrat:wght@200;300;400;500;600&amp;display=swap"
            rel="stylesheet"
        >

        <script>
            window.cartAjax = @json([
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('update_cart_quantity'),
                'addToCartNonce' => wp_create_nonce('add_to_cart')
            ]);
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body @php(body_class())>
        @php(wp_body_open())

        <div id="app">
            @include('sections.subheader')
            @include('sections.header')

            <x-notification />

            @yield('content')

            @include('sections.footer')
        </div>

        {{-- @php(do_action('get_footer')) --}}
        @php(wp_footer())
    </body>

</html>
