{{--
  Template Name: Страница с баннером
--}}

@extends('layouts.app')

@section('content')
    <main class="template-banner min-h-screen pb-24">
        <section class="banner shading-image h-[calc(100vh-92px)] py-6 text-white"
            style="background: url({{ get_the_post_thumbnail_url() }}) center / cover no-repeat"
        >
            <div class="banner__container custom-container relative z-10 flex h-full flex-col">
                <div class="banner__holder flex h-full flex-col justify-center text-center">
                    <h2 class="banner__subtitle text-primary">
                        {{ $pageSubtitle }}
                    </h2>

                    <h1 class="banner__title text-heading sm:text-6xl md:text-8xl">
                        {{ $pageTitle }}
                    </h1>
                </div>

                @if (!empty($pageNotice))
                    <div class="banner__notice text-primary text-right text-white/50">
                        {{ $pageNotice }}
                    </div>
                @endif
            </div>
        </section>

        <div class="template-banner__container custom-sm-container">
            {{ the_content() }}
        </div>
    </main>
@endsection
