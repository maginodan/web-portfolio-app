<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seo = \App\Models\SeoSetting::first();
    @endphp

    <!-- SEO -->
    <title>@yield('title', $seo->meta_title ?? 'John Doe — Full-Stack Web Developer')</title>
    <meta name="description" content="@yield('description', $seo->meta_description ?? 'John Doe is a full-stack web developer based in Kampala, Uganda, with extensive experience in web technologies, UI/UX design, and backend development.')">
    <meta name="author" content="{{ $seo->meta_author ?? 'John Doe' }}">
    @if (!empty($seo?->meta_keywords))
        <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif
    @if (!empty($seo?->canonical_url))
        <link rel="canonical" href="{{ $seo->canonical_url }}">
    @endif

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', $seo->meta_title ?? 'Full-Stack Web Developer')">
    <meta property="og:description" content="@yield('description', $seo->meta_description ?? 'Full-stack web developer based in Kampala, Uganda. Experienced in web technologies, UI/UX design, and backend development.')">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ !empty($seo?->og_image) ? asset('uploads/settings/' . $seo->og_image) : 'https://bolt.new/static/og_default.png' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ !empty($seo?->og_image) ? asset('uploads/settings/' . $seo->og_image) : 'https://bolt.new/static/og_default.png' }}">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $seo->meta_title ?? 'Full-Stack Web Developer')">
    <meta name="twitter:description" content="@yield('description', $seo->meta_description ?? 'Full-stack web developer based in Kampala, Uganda. Experienced in web technologies, UI/UX design, and backend development.')">
    <meta name="twitter:image" content="{{ !empty($seo?->og_image) ? asset('uploads/settings/' . $seo->og_image) : 'https://bolt.new/static/og_default.png' }}">

    @if (!empty($seo?->twitter_handle))
        <meta name="twitter:site" content="{{ $seo->twitter_handle }}">
    @endif

    <!-- Favicon -->
    @if (!empty($siteSetting?->favicon) && file_exists(public_path('uploads/settings/' . $siteSetting->favicon)))
        <link rel="icon" href="{{ asset('uploads/settings/' . $siteSetting->favicon) }}">
    @else
        <!-- Default SVG Fallback -->
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='22' fill='%230f172a'/><text x='50' y='72' font-family='monospace' font-size='56' fill='%233b82f6' text-anchor='middle'>M</text></svg>">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Vite: compiles Tailwind CSS + your JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dynamic theme color override -->
    @php
        $shades = \App\Helpers\ColorHelper::generateShades($siteSetting->primary_color ?? '#3b82f6');
        $cssVars = collect($shades)->map(fn($v, $k) => "--color-primary-{$k}: {$v};")->implode(' ');
    @endphp
    <style>:root { {{ $cssVars }} }</style>

    <!-- hCaptcha -->
    {{-- <script src="https://js.hcaptcha.com/1/api.js" async defer></script> --}}
</head>
<body class="font-sans bg-slate-50 text-slate-700 dark:bg-navy-950 dark:text-slate-300 antialiased transition-colors duration-300">

    @include('layouts.pages.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.pages.chatbot_widget')

    @include('layouts.pages.footer')

    @include('layouts.pages.cookie_consent')

    <!-- Scroll to top -->
    <button id="scroll-top" aria-label="Scroll to top" class="fixed bottom-6 right-6 grid place-items-center w-11 h-11 rounded-full bg-primary-600 text-white shadow-lg opacity-0 invisible transition-all duration-300 hover:scale-110 hover:bg-primary-700 z-40">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

</body>
</html>