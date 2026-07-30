@if ($fields['left_image'] && $fields['right_image'])
    <section class="hero-banner relative flex h-[calc(100vh-92px)] flex-col gap-0.5 overflow-hidden md:flex-row">
        <div class="hero-banner__wrapper pointer-events-none h-1/2 w-full md:h-full md:w-1/2">
            <img class="hero-banner__image hero-banner__image--left h-full w-full object-cover"
                src="{{ wp_get_attachment_image_url($fields['left_image'], 'full') }}"
            />
        </div>

        <div class="hero-banner__wrapper pointer-events-none h-1/2 w-full md:h-full md:w-1/2">
            <img class="hero-banner__image hero-banner__image--right h-full w-full object-cover"
                src="{{ wp_get_attachment_image_url($fields['right_image'], 'full') }}"
            />
        </div>

        <button
            class="hero-banner__scroll hover-paused hover-opacity absolute bottom-3 left-1/2 z-10 flex -translate-x-1/2 animate-bounce cursor-pointer flex-col items-center"
            onclick="document.querySelector('.products')?.scrollIntoView({ behavior: 'smooth' })"
            type="button"
        >
            <div class="hero-banner__scroll-text text-primary relative overflow-hidden">
                <span class="hero-banner__typing"></span>

                <span class="hero-banner__cursor animate-cursor inline-block h-2 w-[1px] bg-current"></span>
            </div>

            <svg
                class="h-8 w-8"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    d="M12 3V20"
                    stroke-linecap="round"
                    stroke-width="1"
                />

                <path
                    d="M8 16L12 20L16 16"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1"
                />
            </svg>
        </button>
    </section>
@endif
