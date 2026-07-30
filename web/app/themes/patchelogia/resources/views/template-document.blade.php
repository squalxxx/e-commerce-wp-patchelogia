{{--
  Template Name: Страница документа
--}}

@extends('layouts.app')

@section('content')
    <main class="template-document pb-24">
        <x-page-header
            :subtitle="$pageSubtitle"
            :title="$pageTitle"
            class="pb-12 pt-24"
        />

        <div class="template-document__container custom-sm-container">
            <div class="template-document__content page-content rounded-2xl border border-zinc-200 p-6 md:p-10">
                {{ the_content() }}
            </div>
        </div>
    </main>
@endsection
