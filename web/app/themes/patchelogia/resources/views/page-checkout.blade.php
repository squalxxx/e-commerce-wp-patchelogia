@extends('layouts.app')

@section('content')
    <main class="page-cart min-h-screen pb-24">
        <x-page-header
            :subtitle="$pageSubtitle"
            :title="$pageTitle"
            class="pb-12 pt-24"
        />

        <div class="page-cart__container custom-container">
            {{ the_content() }}
        </div>
    </main>
@endsection
