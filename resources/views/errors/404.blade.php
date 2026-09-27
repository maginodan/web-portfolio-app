@extends('layouts.pages.base')
@section('content')

    <!-- ============================================================
         404 — NOT FOUND
    ============================================================ -->
    <section class="relative min-h-[calc(100vh-160px)] flex items-center px-5 sm:px-8 lg:px-12 py-20 hero-gradient overflow-hidden">

        <!-- Decorative background glow, consistent with hero section -->
        <div class="hidden lg:block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-primary-500/10 blur-3xl -z-10"></div>

        <div class="max-w-3xl mx-auto w-full text-center reveal">

            <!-- Badge, same style as availability pill -->
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-700 dark:text-primary-300 text-xs sm:text-sm font-medium mb-6">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Error 404
            </span>

            <!-- Big code -->
            <h1 class="text-7xl sm:text-8xl lg:text-9xl font-bold text-slate-900 dark:text-white leading-none tracking-tight">
                4<span class="text-primary-600 dark:text-primary-400">0</span>4
            </h1>

            <h2 class="mt-6 text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white">
                This page went off the grid.
            </h2>

            <p class="mt-4 max-w-lg mx-auto text-base sm:text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                The page you're looking for doesn't exist, may have been moved, or the link might be broken.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-2.5 sm:py-3 rounded-full bg-primary-600 text-white font-medium hover:bg-primary-700 transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-primary-600/20 text-sm sm:text-base">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Back to Home
                </a>
                <a href="{{ url('/#contact') }}" class="inline-flex items-center gap-2 px-6 py-2.5 sm:py-3 rounded-full border border-slate-300 dark:border-white/20 hover:bg-white dark:hover:bg-white/5 font-medium transition-all duration-200 hover:-translate-y-0.5 text-sm sm:text-base">
                    Contact Me
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>

            

        </div>
    </section>

@endsection