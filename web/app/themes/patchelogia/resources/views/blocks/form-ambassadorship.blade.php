<section class="form-ambassadorship">
    <form
        @ajax-form:message="show($event)"
        class="form md:w-2xl mx-auto flex w-full flex-col overflow-hidden rounded-2xl border border-zinc-200 md:flex-row"
        data-action="ambassadorship"
        data-ajax-form
        data-nonce="{{ wp_create_nonce('ambassadorship') }}"
        data-url="{{ admin_url('admin-ajax.php') }}"
    >
        <div class="form__image pointer-events-none w-full md:w-[45%]">
            <img class="max-h-100 h-full w-full object-cover md:max-h-none"
                src="{{ wp_get_attachment_image_url($fields['image'], 'full') }}"
            />
        </div>

        <div class="form__holder w-full px-6 py-8 md:w-[55%] md:px-12 md:py-16">
            @if ($fields['title'])
                <div class="form__header mb-10 flex flex-col gap-y-2 text-center">
                    @if ($fields['subtitle'])
                        <h3 class="form__subtitle text-primary text-black/45">
                            {{ $fields['subtitle'] }}
                        </h3>
                    @endif

                    <h2 class="form__title text-heading text-4xl">
                        {{ $fields['title'] }}
                    </h2>
                </div>
            @endif

            <div class="form__inputs mb-10 flex flex-col gap-y-6">
                <input
                    class="form__input input input--sharpened"
                    name="name"
                    placeholder="Имя *"
                    type="text"
                />
                <input
                    class="form__input input input--sharpened"
                    name="link"
                    placeholder="Ссылка на Ваш профиль *"
                    type="text"
                />
                <textarea
                    class="form__input input input--sharpened resize-none"
                    name="comment"
                    placeholder="Почему решили стать амбассадором Patchelogia? *"
                    rows="5"
                ></textarea>
                <input
                    class="form__input input input--sharpened"
                    name="email"
                    placeholder="Почта **"
                    type="email"
                />
                <input
                    class="form__input input input--sharpened"
                    name="phone"
                    placeholder="Телефон/Telegram **"
                    type="tel"
                    x-mask="+7 (999) 999-99-99"
                />

            </div>

            <div class="form__action flex flex-col gap-y-6">
                @if ($fields['notice'])
                    <span class="agreement__notice text-justify text-xs text-black/60">
                        {!! $fields['notice'] !!}
                    </span>
                @endif

                <div class="form__agreement agreement flex gap-x-3">
                    @php
                        $agreementId = wp_unique_id('agreement-');
                    @endphp

                    <label class="agreement__checkbox group relative flex h-4 w-4 shrink-0 cursor-pointer"
                        for="{{ $agreementId }}"
                    >
                        <input
                            class="peer"
                            hidden
                            id="{{ $agreementId }}"
                            name="agreement"
                            type="checkbox"
                        />

                        <span
                            class="absolute inset-0 rounded-sm border border-zinc-200 transition-colors group-hover:border-neutral-900 peer-checked:border-neutral-900 peer-checked:bg-neutral-900"
                        ></span>

                        <svg
                            class="relative m-auto h-2.5 w-2.5 scale-0 text-white transition-transform duration-150 peer-checked:scale-100"
                            fill="none"
                            stroke-width="3"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M5 13l4 4L19 7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </label>

                    <label class="agreement__text text-justify text-xs text-black/60" for="{{ $agreementId }}">
                        Я подтверждаю, что ознакомлен(а) и согласен(на) с
                        <a
                            class="transition-colors hover:text-neutral-900"
                            href="/public-oferta/"
                            target="_blank"
                        >
                            условиями оферты
                        </a>
                        и
                        <a
                            class="transition-colors hover:text-neutral-900"
                            href="/privacy-policy/"
                            target="_blank"
                        >
                            политики конфиденциальности
                        </a>
                        *
                    </label>
                </div>

                <button class="button hover-roll w-full" type="submit">
                    <x-hover-roll :text="$fields['button_text']" />
                </button>
            </div>
        </div>
    </form>
</section>
