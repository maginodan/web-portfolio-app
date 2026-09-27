@extends('layouts.pages.base')

@section('title', $page->meta_title ?: ($page->title . ' — Magino Daniel'))
@section('description', $page->meta_description ?: ('Read the ' . strtolower($page->title) . ' for this website.'))

@section('content')

    <!-- ============================================================
         LEGAL PAGE
    ============================================================ -->
    <section class="scroll-mt-20 px-5 sm:px-8 lg:px-12 pt-32 pb-24 min-h-screen">
        <div class="max-w-3xl mx-auto">

            <div class="reveal mb-10">
                <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">Legal</span>
                <h1 class="mt-2 text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white">{{ $page->title }}</h1>
                <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Last updated {{ $page->updated_at->format('F j, Y') }}</p>
            </div>

            <div class="reveal prose-content text-base text-slate-600 dark:text-slate-300 leading-relaxed space-y-5">
                @foreach (explode("\n", $page->content) as $paragraph)
                    @if (trim($paragraph) !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>

            <div class="reveal mt-12">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-primary-600 text-white font-medium hover:bg-primary-700 transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-primary-600/20 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Back to Home
                </a>
            </div>

        </div>
    </section>

@endsection