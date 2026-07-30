@extends('layouts.app')

@section('content')
    <main class="archive min-h-screen">
        <x-page-header
            :subtitle="$pageSubtitle"
            :title="$pageTitle"
            class="pt-24"
        />
    </main>
@endsection
