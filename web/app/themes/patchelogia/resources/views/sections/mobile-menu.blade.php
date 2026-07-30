<div
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    class="mobile-menu absolute inset-x-0 top-full bg-white"
    x-cloak
    x-show="open"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:enter-start="-translate-y-10 opacity-0"
    x-transition:enter="transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
    x-transition:leave-end="-translate-y-6 opacity-0"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave="transition-all duration-300 ease-out"
>
    <div
        class="mobile-menu__container custom-container mx-auto flex min-h-[calc(100vh-60px)] flex-col justify-between pb-3 pt-12">
        <nav>
            <ul class="mobile-menu__items flex flex-col gap-y-8">
                @foreach ($menu['items'] as $item)
                    <li class="mobile-menu__item">
                        <a
                            @click="open = false"
                            class="flex items-center justify-between border-b border-zinc-200 pb-4 text-xl font-light uppercase tracking-[0.2em] text-black/80"
                            href="{{ $item->url }}"
                        >
                            <span>
                                {{ $item->title }}
                            </span>

                            <span class="text-xs">
                                {{ $loop->index + 1 }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="mobile-menu__contacts flex justify-between gap-6 uppercase tracking-[0.2em]">
            @if (!empty($socials['telegram_url']))
                <a
                    class="font-manrope text-[0.625rem] font-bold tracking-[0.2em] text-black/45"
                    href="{{ $socials['telegram_url'] }}"
                    target="_blank"
                >
                    TG
                </a>
            @endif

            @if (!empty($socials['instagram_url']))
                <a
                    class="font-manrope text-[0.625rem] font-bold tracking-[0.2em] text-black/45"
                    href="{{ $socials['instagram_url'] }}"
                    target="_blank"
                >
                    IG
                </a>
            @endif

            @if (!empty($socials['tiktok_url']))
                <a
                    class="font-manrope text-[0.625rem] font-bold tracking-[0.2em] text-black/45"
                    href="{{ $socials['tiktok_url'] }}"
                    target="_blank"
                >
                    TT
                </a>
            @endif

            @if (!empty($socials['vk_url']))
                <a
                    class="font-manrope text-[0.625rem] font-bold tracking-[0.2em] text-black/45"
                    href="{{ $socials['vk_url'] }}"
                    target="_blank"
                >
                    VK
                </a>
            @endif

            <a class="font-manrope text-[0.625rem] font-bold tracking-[0.2em] text-black/45"
                href="mailto:info@patchelogia.ru"
            >
                info@patchelogia.ru
            </a>
        </div>
    </div>
</div>
