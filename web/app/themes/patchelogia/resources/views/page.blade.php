@extends('layouts.app')

@section('content')
    <main class="page min-h-screen pb-24">
        <x-page-header
            :subtitle="$pageSubtitle"
            :title="$pageTitle"
            class="pb-12 pt-24"
        />

        {{ the_content() }}
    </main>
@endsection
