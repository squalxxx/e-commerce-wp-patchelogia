@extends('layouts.app')

@section('content')
    <main class="page-ambassadorship min-h-screen">
        <x-page-header
            :subtitle="$pageSubtitle"
            :title="$pageTitle"
            class="pb-12 pt-24"
        />

        <div class="page-ambassadorship__container custom-sm-container">
            {{ the_content() }}
        </div>
    </main>
@endsection
