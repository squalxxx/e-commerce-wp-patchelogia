@if ($fields['reviews'])
    <section class="reviews py-30 bg-gray-100">
        <x-block-header
            :subtitle="$fields['subtitle']"
            :title="$fields['title']"
            class="reviews__header mb-14"
        />

        <div class="reviews__container custom-container">
            <ul class="reviews__items grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($fields['reviews'] as $review)
                    <li @class([
                        'reviews__item group border border-zinc-200 bg-white px-4 py-8 transition-all hover:-translate-y-1 hover:border-b-black',
                        'md:col-span-2 lg:col-span-1' => $loop->last && $loop->count % 2 !== 0,
                    ])>
                        <div class="reviews__rating mb-4 flex items-center gap-3">
                            <div class="flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg @class([
                                        'h-3.5 w-3.5 transition-colors',
                                        'fill-black group-hover:fill-amber-500' => $i <= floor($review['rating']),
                                        'fill-zinc-200' => $i > floor($review['rating']),
                                    ]) viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.5l2.92 5.92 6.53.95-4.72 4.6 1.11 6.5L12 17.4l-5.84 3.07 1.11-6.5-4.72-4.6 6.53-.95L12 2.5z"
                                        />
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <p class="reviews__content font-garamond mb-6 text-base italic">
                            «{{ $review['content'] }}»
                        </p>

                        <div class="reviews__author flex items-center gap-x-3">
                            <div
                                class="reviews__author-avatar flex h-8 w-8 items-center justify-center rounded-full bg-zinc-200 font-medium transition-colors group-hover:bg-black group-hover:text-white">
                                {{ $review['avatar'] }}
                            </div>

                            <div class="reviews__author-holder flex flex-col justify-between">
                                <span class="reviews__author-name text-xs transition-colors group-hover:text-black">
                                    {{ $review['name'] }}
                                </span>

                                <span class="reviews__author-info text-[0.625rem] font-light text-black/45">
                                    {{ $review['city'] ?: $review['date'] }}
                                </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
