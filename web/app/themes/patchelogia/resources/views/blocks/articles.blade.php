<section class="articles py-30">
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="articles__header mb-14"
    />

    <div class="articles__container custom-container">
        <ul class="articles__items mb-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($fields['articles'] as $article)
                <x-article-card :article="$article" :wide="$loop->last && $loop->count % 2" />
            @endforeach
        </ul>

        <a class="articles__button hover-roll block w-full border border-zinc-200 px-4 py-4 text-center uppercase tracking-[0.2em] text-black/45 transition-colors hover:border-black hover:text-black"
            href="{{ get_post_type_archive_link('articles') }}"
        >
            <x-hover-roll :text="$fields['button_text']" />
        </a>
    </div>
</section>
