@props(['article', 'wide' => false])

<li @class([
    'md:col-span-2 lg:col-span-1' => $wide,
])>
    <a class="articles__item article-card group block border border-zinc-200 bg-white transition-all hover:border-b-black"
        href="{{ $article['url'] }}"
    >
        <div class="article-card__image overflow-hidden">
            <img class="h-full w-full transition-transform duration-500 group-hover:scale-105"
                src="{{ $article['preview_image_url'] }}"
            >
        </div>

        <div class="article-card__holder px-4 py-6">
            <h3 class="article-card__title mb-2 text-lg">
                {{ $article['title'] }}
            </h3>

            <p class="article-card__content-excerpt mb-4 text-sm text-black/45 transition-colors group-hover:text-black">
                {{ $article['content_excerpt'] }}
            </p>

            <span
                class="article-card__publish-date flex items-center justify-between gap-2 text-[0.625rem] font-light text-black/45 transition-colors group-hover:text-black"
            >
                {{ $article['publish_date'] }}

                <svg
                    class="-translate-x-1 opacity-0 transition-all group-hover:translate-x-0 group-hover:opacity-100"
                    fill="none"
                    height="14"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    width="14"
                >
                    <path
                        d="M7 17L17 7"
                        stroke-linecap="round"
                        stroke-width="1.5"
                    />

                    <path
                        d="M9 7H17V15"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                    />
                </svg>
            </span>
        </div>
    </a>
</li>
