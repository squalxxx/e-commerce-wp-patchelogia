<section @class([
    'compare py-30 bg-gray-100',
    'align-full' => $block['align'] === 'full',
])>
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="compare__header mb-14"
    />

    <div class="compare__container custom-sm-container relative grid grid-cols-1 gap-4 overflow-x-auto md:grid-cols-2">
        <x-compare-card
            :list="$fields['favorite_list']"
            :subtitle="$fields['favorite_subtitle']"
            :title="$fields['favorite_title']"
            favorite
        />

        <x-compare-card
            :list="$fields['outsider_list']"
            :subtitle="$fields['outsider_subtitle']"
            :title="$fields['outsider_title']"
        />

        <div
            class="compare__symbol text-primary -translate-1/2 absolute left-1/2 top-1/2 hidden h-12 w-12 items-center justify-center rounded-full border border-zinc-200 bg-white text-black/45 md:flex">
            VS
        </div>
    </div>
</section>
