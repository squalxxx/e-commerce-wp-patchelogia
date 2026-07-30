<section class="about">
    <div class="about__container custom-sm-container grid grid-cols-2 gap-x-16">
        <div class="about__holder">
            @if ($fields['image'])
                <div class="about__image">
                    <img class="aobut__image pointer-events-none h-full w-full object-cover"
                        src="{{ wp_get_attachment_image_url($fields['image'], 'full') }}"
                    />
                </div>
            @endif

            @if ($fields['subtitle'])
                <h3 class="about__subtitle text-primary mb-3 text-black/45">
                    {{ $fields['subtitle'] }}
                </h3>
            @endif

            <h2 class="about__title text-heading mb-8">
                {{ $fields['title'] }}
            </h2>

            @if ($fields['phrase'])
                <p class="about__phrase text-black/60">
                    {{ $fields['phrase'] }}
                </p>
            @endif
        </div>

        <div class="about__content flex flex-col gap-y-6">
            {!! $fields['content'] !!}
        </div>
    </div>
</section>
