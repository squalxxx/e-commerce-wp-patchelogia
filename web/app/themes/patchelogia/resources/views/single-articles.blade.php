@extends('layouts.app')

@section('content')
    <main class="single-articles min-h-screen pb-24">
        <x-page-header
            :title="$pageTitle"
            class="pb-12 pt-24"
            subtitle="Блог"
        />

        <div class="custom-md-container">
            <div class="single-articles__image pointer-events-none mb-12 h-96">
                <img class="h-full w-full object-cover" src="{{ get_the_post_thumbnail_url() }}">
            </div>

            <div class="single-articles__info text-primary mb-10 flex items-center justify-between gap-x-10 text-black/45">
                <span class="single-articles__date">
                    {{ $fields()['date'] }}
                </span>

                <span class="single__articles-line w-full border-t border-zinc-200"></span>

                <div class="single-articles__viewers flex items-center gap-2 text-nowrap">
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M2 12C3.8 7.8 7.5 5 12 5s8.2 2.8 10 7c-1.8 4.2-5.5 7-10 7S3.8 16.2 2 12Z"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="3"
                            stroke-width="1.5"
                        />
                    </svg>

                    {{ number_format($viewsCount(), 0, ',', ' ') }}
                </div>
            </div>

            <div class="single-articles__content page-content custom-small-container">
                {{ the_content() }}
            </div>
        </div>
    </main>
@endsection
