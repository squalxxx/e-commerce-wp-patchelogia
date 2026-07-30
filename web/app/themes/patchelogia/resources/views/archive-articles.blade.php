@extends('layouts.app')

@section('content')
    <main class="archive-articles min-h-screen pb-24">
        <x-page-header :title="$pageTitle" class="pb-12 pt-24" />

        <div class="custom-container">
            @if (!empty($articles))
                <ul class="archive-articles__items mb-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($articles as $article)
                        <x-article-card :article="$article" :wide="$loop->last && $loop->count % 2" />
                    @endforeach
                </ul>
            @else
                <span>Статей не найдено...</span>
            @endif
        </div>
    </main>
@endsection
