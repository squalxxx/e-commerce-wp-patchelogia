<div
    @ajax-form:message.window="show($event)"
    class="notification z-900 pointer-events-none fixed inset-x-0 bottom-4 flex justify-end px-4"
    x-data="notification"
>
    <div
        class="notification__holder pointer-events-auto w-full max-w-md"
        x-cloak
        x-show="visible"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter="transition ease-out duration-300"
        x-transition:leave-end="opacity-0 -translate-y-4"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
    >
        <div :class="success
            ?
            'border-green-200 bg-green-50 text-green-700' :
            'border-red-200 bg-red-50 text-red-700'"
            class="flex items-center gap-2 rounded-lg border px-4 py-3 text-sm shadow-lg"
        >
            <svg
                class="h-4 w-4 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                x-show="success"
            >
                <path
                    d="M5 13l4 4L19 7"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                />
            </svg>

            <svg
                class="h-4 w-4 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                x-show="!success"
            >
                <path
                    d="M6 18L18 6M6 6l12 12"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                />
            </svg>

            <span class="notification__message flex-1" x-text="message"></span>

            <button
                @click="hide()"
                aria-label="Закрыть"
                class="notification__close shrink-0 cursor-pointer opacity-60 transition-opacity hover:opacity-100"
                type="button"
            >
                &times;
            </button>
        </div>
    </div>
</div>
