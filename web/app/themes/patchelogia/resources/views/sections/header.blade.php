@php
    $mainMenu = $mainMenu();
@endphp

<header class="header z-1000 h-15 sticky top-0 flex items-center border-b border-zinc-200 bg-white"
    x-data="{ open: false }"
>
    <div class="header__container custom-container mx-auto flex items-center justify-between">
        @if (!empty($mainMenu['items']))
            <nav class="header__nav min-w-1/3 hidden lg:block">
                <ul class="header__nav-items flex gap-7">
                    @foreach ($mainMenu['items'] as $item)
                        <li class="header__nav-item">
                            <a @class([
                                'header__nav-link text-primary',
                                'text-black/45 hover-underline transition-colors duration-300 hover:text-neutral-900' => !isActiveMenuItem(
                                    $item->url),
                                'text-black' => isActiveMenuItem($item->url),
                            ]) href="{{ $item->url }}">
                                {{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        @endif

        <button @click="open = !open" class="header__burger relative h-3 w-5 lg:hidden">
            <span :class="open ? 'top-2 rotate-45' : 'top-1'"
                class="absolute left-0 h-px w-5 bg-black transition-all duration-300"
            ></span>

            <span :class="open ? 'top-2 -rotate-45' : 'top-3'"
                class="absolute left-0 h-px w-5 bg-black transition-all duration-300"
            ></span>
        </button>

        <x-logotype class="header__logotype text-2xl" />

        <div class="header__actions text-primary min-w-1/3 hidden justify-end gap-x-7 text-black/45 lg:flex">
            {{-- <a class="header__favorite hover-roll flex items-center gap-x-1 transition-colors hover:text-neutral-900"
                href="{{ wc_get_cart_url() }}"
            >
                <svg
                    aria-hidden="true"
                    fill="none"
                    height="18"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    width="18"
                >
                    <path
                        d="M12 20.5s-7-4.7-9-8.8C1.4 8.5 3.2 5 6.8 5c2.1 0 3.6 1.2 5.2 3 1.6-1.8 3.1-3 5.2-3C20.8 5 22.6 8.5 21 11.7c-2 4.1-9 8.8-9 8.8z"
                    ></path>
                </svg>

                <x-hover-roll text="999" />
            </a> --}}

            <a
                class="header__cart hover-roll flex items-center gap-x-1 transition-colors hover:text-neutral-900"
                data-cart-count
                href="{{ wc_get_cart_url() }}"
            >
                <svg
                    fill="none"
                    height="18"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    width="18"
                >
                    <path d="M6.5 7.5h11l.9 12.5H5.6L6.5 7.5Z"></path>
                    <path d="M9 7.5V6a3 3 0 0 1 6 0v1.5"></path>
                </svg>

                <x-hover-roll :text="WC()->cart->get_cart_contents_count()" />
            </a>
        </div>

        <div class="w-5 lg:hidden"></div>
    </div>

    @include('sections.mobile-menu', [
        'menu' => $mainMenu,
        'socials' => $socials(),
    ])
</header>
