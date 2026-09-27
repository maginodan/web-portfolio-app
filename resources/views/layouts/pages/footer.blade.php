<!-- ============================================================
     FOOTER
============================================================ -->
<footer class="px-5 sm:px-8 lg:px-12 py-12 bg-white dark:bg-navy-900 border-t border-slate-200 dark:border-white/5">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pb-8 border-b border-slate-200 dark:border-white/10">
            <a href="/" class="flex items-center gap-2 font-semibold text-lg tracking-tight">
                
                <!-- Light Mode Logo -->
                @if (!empty($siteSetting?->logo_light) && file_exists(public_path('uploads/settings/' . $siteSetting->logo_light)))
                    <img src="{{ asset('uploads/settings/' . $siteSetting->logo_light) }}" alt="Logo" class="h-12 w-auto block dark:hidden">
                @else
                    <!-- Default SVG Fallback -->
                    <svg class="h-12 w-auto block dark:hidden" viewBox="0 0 260 80" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="80" height="80" rx="18" fill="#005eff"/>
                        <path d="M18 58V22l22 22 22-22v36" stroke="#ffffff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <text x="96" y="36" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#1e2939">Magino</text>
                        <text x="96" y="66" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#005eff">Daniel</text>
                    </svg>
                @endif

                <!-- Dark Mode Logo -->
                @if (!empty($siteSetting?->logo_dark) && file_exists(public_path('uploads/settings/' . $siteSetting->logo_dark)))
                    <img src="{{ asset('uploads/settings/' . $siteSetting->logo_dark) }}" alt="Logo" class="h-12 w-auto hidden dark:block">
                @else
                    <!-- Default SVG Fallback -->
                    <svg class="h-12 w-auto hidden dark:block" viewBox="0 0 260 80" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="80" height="80" rx="18" fill="#005eff"/>
                        <path d="M18 58V22l22 22 22-22v36" stroke="#ffffff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <text x="96" y="36" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#ffffff">Magino</text>
                        <text x="96" y="66" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#4d94ff">Daniel</text>
                    </svg>
                @endif

            </a>

            <ul class="flex items-center gap-6 text-sm font-medium">
                <li><a href="#about" class="text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">About</a></li>
                <li><a href="#projects" class="text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Projects</a></li>
                <li><a href="#services" class="text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Services</a></li>
                <li><a href="#contact" class="text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Contact</a></li>
            </ul>

            <div class="flex items-center gap-3">
                @foreach ($medias as $media)
                <a href="{{ $media->link }}" target="_blank" rel="noopener" aria-label="{{ $media->name ?? 'Social Link' }}" class="grid place-items-center w-9 h-9 rounded-full border border-slate-200 dark:border-white/10 hover:border-primary-500 dark:hover:border-primary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors [&>svg]:w-4 [&>svg]:h-4">
                    {!! $media->icon !!}
                </a>
                @endforeach
            </div>
        </div>

        <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-6">
            {{ $siteSetting->footer_text ?? 'Copyright © 2026 Magino Kent Daniel. All rights reserved.' }}
        </p>

        <p class="text-center text-xs text-slate-400 dark:text-slate-500 mt-2 flex items-center justify-center gap-3">
            <a href="{{ route('privacy.show') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Privacy Policy</a>
            <span class="text-slate-300 dark:text-slate-700">•</span>
            <a href="{{ route('terms.show') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Terms of Use</a>
        </p>
    </div>
</footer>