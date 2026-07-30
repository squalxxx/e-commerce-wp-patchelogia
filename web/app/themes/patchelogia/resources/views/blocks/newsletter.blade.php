<section class="newsletter align-full py-30 bg-gray-100">
    <x-block-header
        :subtitle="$fields['subtitle']"
        :title="$fields['title']"
        class="newsletter__header mb-8"
    />

    <div class="newsletter__container custom-container">
        <form
            @ajax-form:message="show($event)"
            class="newsletter__form flex flex-col items-center gap-3"
            data-action="newsletter"
            data-ajax-form
            data-disable-on-success
            data-nonce="{{ wp_create_nonce('newsletter') }}"
            data-url="{{ admin_url('admin-ajax.php') }}"
        >
            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                <input
                    class="input input--rounded sm:w-xs w-full"
                    name="email"
                    placeholder="Почта *"
                    type="email"
                />

                <button class="button hover-roll w-full disabled:pointer-events-none disabled:opacity-50 sm:w-fit"
                    type="submit"
                >
                    <x-hover-roll :text="$fields['button_text']" />
                </button>
            </div>
        </form>
    </div>
</section>
