@if (!empty($menu['items']))
    <nav class="footer-menu max-w-3xs flex flex-col gap-y-4">
        <span class="footer-menu__title text-primary text-black/45">
            {{ $menu['name'] }}
        </span>

        <ul class="footer-menu__items flex flex-col gap-y-2">
            @foreach ($menu['items'] as $item)
                <li class="footer-menu__item">
                    <a @class([
                        'footer-menu__link hover-underline',
                        'text-black' => isActiveMenuItem($item->url),
                    ]) href="{{ $item->url }}">
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif
