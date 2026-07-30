@php
    $socials = $socials();
@endphp

<footer class="footer border-t border-zinc-200" id="footer">
    <div class="footer__container custom-container">
        <div class="footer__top flex flex-col justify-between gap-y-12 py-10 lg:flex-row">
            <div
                class="footer__holder flex flex-col items-center justify-start gap-y-6 text-center md:flex-row md:items-stretch md:justify-between md:text-left lg:flex-col lg:justify-start">
                <x-logotype class="footer__logotype text-xl" />

                <ul class="footer__socials flex gap-x-4">
                    @if (!empty($socials['telegram_url']))
                        <li class="footer__socials-item h-5 w-5">
                            <a
                                class="footer__socials-link svg-current hover-opacity text-neutral-900"
                                href="{{ $socials['telegram_url'] }}"
                                target="_blank"
                            >
                                <svg
                                    fill="none"
                                    viewBox="0 0 48 48"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M41.4193 7.30899C41.4193 7.30899 45.3046 5.79399 44.9808 9.47328C44.8729 10.9883 43.9016 16.2908 43.1461 22.0262L40.5559 39.0159C40.5559 39.0159 40.3401 41.5048 38.3974 41.9377C36.4547 42.3705 33.5408 40.4227 33.0011 39.9898C32.5694 39.6652 24.9068 34.7955 22.2086 32.4148C21.4531 31.7655 20.5897 30.4669 22.3165 28.9519L33.6487 18.1305C34.9438 16.8319 36.2389 13.8019 30.8426 17.4812L15.7331 27.7616C15.7331 27.7616 14.0063 28.8437 10.7686 27.8698L3.75342 25.7055C3.75342 25.7055 1.16321 24.0823 5.58815 22.459C16.3807 17.3729 29.6555 12.1786 41.4193 7.30899Z"
                                        fill="#000000"
                                    >
                                    </path>
                                </svg>
                            </a>
                        </li>
                    @endif

                    @if (!empty($socials['instagram_url']))
                        <li class="footer__socials-item h-5 w-5">
                            <a
                                class="footer__socials-link svg-current hover-opacity text-neutral-900"
                                href="{{ $socials['instagram_url'] }}"
                                target="_blank"
                            >
                                <svg
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect
                                        height="20"
                                        rx="5"
                                        ry="5"
                                        width="20"
                                        x="2"
                                        y="2"
                                    ></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line
                                        x1="17.5"
                                        x2="17.51"
                                        y1="6.5"
                                        y2="6.5"
                                    ></line>
                                </svg>
                            </a>
                        </li>
                    @endif

                    @if (!empty($socials['vk_url']))
                        <li class="footer__socials-item h-5 w-5">
                            <a
                                class="footer__socials-link svg-current hover-opacity text-neutral-900"
                                href="{{ $socials['vk_url'] }}"
                                target="_blank"
                            >
                                <svg
                                    fill="#000000"
                                    version="1.1"
                                    viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M25.217 22.402h-2.179c-0.825 0-1.080-0.656-2.562-2.158-1.291-1.25-1.862-1.418-2.179-1.418-0.445 0-0.572 0.127-0.572 0.741v1.968c0 0.53-0.169 0.847-1.566 0.847-2.818-0.189-5.24-1.726-6.646-3.966l-0.021-0.035c-1.632-2.027-2.835-4.47-3.43-7.142l-0.022-0.117c0-0.317 0.127-0.614 0.741-0.614h2.179c0.55 0 0.762 0.254 0.975 0.846 1.078 3.112 2.878 5.842 3.619 5.842 0.275 0 0.402-0.127 0.402-0.825v-3.219c-0.085-1.482-0.868-1.608-0.868-2.137 0.009-0.283 0.241-0.509 0.525-0.509 0.009 0 0.017 0 0.026 0.001l-0.001-0h3.429c0.466 0 0.635 0.254 0.635 0.804v4.34c0 0.465 0.212 0.635 0.339 0.635 0.275 0 0.509-0.17 1.016-0.677 1.054-1.287 1.955-2.759 2.642-4.346l0.046-0.12c0.145-0.363 0.493-0.615 0.9-0.615 0.019 0 0.037 0.001 0.056 0.002l-0.003-0h2.179c0.656 0 0.805 0.337 0.656 0.804-0.874 1.925-1.856 3.579-2.994 5.111l0.052-0.074c-0.232 0.381-0.317 0.55 0 0.975 0.232 0.317 0.995 0.973 1.503 1.566 0.735 0.727 1.351 1.573 1.816 2.507l0.025 0.055c0.212 0.612-0.106 0.93-0.72 0.93zM20.604 1.004h-9.207c-8.403 0-10.392 1.989-10.392 10.392v9.207c0 8.403 1.989 10.392 10.392 10.392h9.207c8.403 0 10.392-1.989 10.392-10.392v-9.207c0-8.403-2.011-10.392-10.392-10.392z"
                                    />
                                </svg>
                            </a>
                        </li>
                    @endif

                    @if (!empty($socials['tiktok_url']))
                        <li class="footer__socials-item h-5 w-5">
                            <a
                                class="footer__socials-link svg-current hover-opacity text-neutral-900"
                                href="{{ $socials['tiktok_url'] }}"
                                target="_blank"
                            >
                                <svg
                                    fill="#000000"
                                    version="1.1"
                                    viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M16.656 1.029c1.637-0.025 3.262-0.012 4.886-0.025 0.054 2.031 0.878 3.859 2.189 5.213l-0.002-0.002c1.411 1.271 3.247 2.095 5.271 2.235l0.028 0.002v5.036c-1.912-0.048-3.71-0.489-5.331-1.247l0.082 0.034c-0.784-0.377-1.447-0.764-2.077-1.196l0.052 0.034c-0.012 3.649 0.012 7.298-0.025 10.934-0.103 1.853-0.719 3.543-1.707 4.954l0.020-0.031c-1.652 2.366-4.328 3.919-7.371 4.011l-0.014 0c-0.123 0.006-0.268 0.009-0.414 0.009-1.73 0-3.347-0.482-4.725-1.319l0.040 0.023c-2.508-1.509-4.238-4.091-4.558-7.094l-0.004-0.041c-0.025-0.625-0.037-1.25-0.012-1.862 0.49-4.779 4.494-8.476 9.361-8.476 0.547 0 1.083 0.047 1.604 0.136l-0.056-0.008c0.025 1.849-0.050 3.699-0.050 5.548-0.423-0.153-0.911-0.242-1.42-0.242-1.868 0-3.457 1.194-4.045 2.861l-0.009 0.030c-0.133 0.427-0.21 0.918-0.21 1.426 0 0.206 0.013 0.41 0.037 0.61l-0.002-0.024c0.332 2.046 2.086 3.59 4.201 3.59 0.061 0 0.121-0.001 0.181-0.004l-0.009 0c1.463-0.044 2.733-0.831 3.451-1.994l0.010-0.018c0.267-0.372 0.45-0.822 0.511-1.311l0.001-0.014c0.125-2.237 0.075-4.461 0.087-6.698 0.012-5.036-0.012-10.060 0.025-15.083z"
                                    />
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>

                <ul class="footer__contacts flex flex-col gap-y-2">
                    <li class="footer__contacts-item">
                        <a class="hover-roll" href="mailto:info@patchelogia.ru">
                            <x-hover-roll text="info@patchelogia.ru" />
                        </a>
                    </li>

                    <li class="footer__contacts-item">
                        <a
                            class="hover-roll"
                            href="https://t.me/patchelogia_support"
                            target="_blank"
                        >
                            <x-hover-roll text="@patchelogia_support" />
                        </a>
                    </li>
                </ul>
            </div>

            <div
                class="footer__menus flex flex-col items-center justify-between gap-10 text-center md:flex-row md:items-baseline md:text-left">
                @include('sections.footer-menu', ['menu' => $leftMenu()])
                @include('sections.footer-menu', ['menu' => $middleMenu()])
                @include('sections.footer-menu', ['menu' => $rightMenu()])
            </div>
        </div>

        <div
            class="footer__bottom flex flex-col items-center justify-between border-t border-zinc-200 py-5 text-[0.625rem] text-[#9b928a] md:flex-row">
            <span class="footer__copyright">2026 © Patchelogia - все права защищены</span>

            <span class="footer__notice">*Meta признана экстремисткой организацией на территории РФ</span>
        </div>
    </div>
</footer>
