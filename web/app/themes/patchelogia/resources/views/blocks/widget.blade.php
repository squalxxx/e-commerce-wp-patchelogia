<section @class(['widget pt-30', 'align-full' => $block['align'] === 'full'])>
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="widget__header mb-14"
    />

    {!! $fields['code'] !!}
</section>
