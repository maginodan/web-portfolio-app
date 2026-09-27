<!-- ============================================================
     NAVIGATION
============================================================ -->
<header class="fixed top-0 inset-x-0 z-50 transition-all duration-300" id="navbar">
    <nav class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-4 flex items-center justify-between">
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

        <!-- Desktop nav -->
        <ul class="hidden md:flex items-center gap-1 bg-white/70 dark:bg-white/5 backdrop-blur-md border border-slate-200/60 dark:border-white/10 rounded-full px-2 py-1.5 text-sm font-medium">
            <li><a href="/" class="nav-link block px-4 py-2 rounded-full transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-white/10">Home</a></li>
            <li><a href="#about" class="nav-link block px-4 py-2 rounded-full transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-white/10">About</a></li>
            <li><a href="#skills" class="nav-link block px-4 py-2 rounded-full transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-white/10">Skills</a></li>
            <li><a href="#experience" class="nav-link block px-4 py-2 rounded-full transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-white/10">Experience</a></li>
            <li><a href="#projects" class="nav-link block px-4 py-2 rounded-full transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-white/10">Projects</a></li>
            <li><a href="#contact" class="nav-link block px-4 py-2 rounded-full transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-white/10">Contact</a></li>
        </ul>

        <div class="flex items-center gap-3">
            <!-- Theme toggle -->
            <button id="theme-toggle" aria-label="Toggle theme" class="grid place-items-center w-10 h-10 rounded-full border border-slate-200 dark:border-white/15 bg-white/60 dark:bg-white/5 backdrop-blur-md hover:bg-slate-100 dark:hover:bg-white/10 transition-colors duration-200">
                <svg class="w-5 h-5 hidden dark:block text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" stroke-linecap="round"/></svg>
                <svg class="w-5 h-5 block dark:hidden text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>

            <!-- Mobile menu button -->
            <button id="menu-toggle" aria-label="Open menu" aria-expanded="false" class="md:hidden grid place-items-center w-10 h-10 rounded-full border border-slate-200 dark:border-white/15 bg-white/60 dark:bg-white/5 backdrop-blur-md transition-colors">
                <svg id="menu-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round"/></svg>
                <svg id="menu-icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 6l12 12M6 18L18 6" stroke-linecap="round"/></svg>
            </button>
        </div>
    </nav>
</header>





    <!-- ============================================================
         MOBILE MENU DRAWER — top-level overlay, independent of navbar
    ============================================================ -->
        <div id="mobile-menu" class="md:hidden fixed inset-0 z-[60] invisible opacity-0 transition-all duration-300">
            <!-- Solid backdrop -->
            <div id="mobile-menu-overlay" class="absolute inset-0 bg-slate-900/60 dark:bg-black/70"></div>
            <!-- Solid drawer panel -->
            <div id="mobile-menu-panel" class="absolute right-0 top-0 bottom-0 w-72 bg-white dark:bg-navy-900 border-l border-slate-200 dark:border-white/10 shadow-2xl pt-0 px-0 pb-0 flex flex-col translate-x-full transition-transform duration-300 z-10">
                <!-- Drawer header -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200 dark:border-white/10">
                    <a href="/" class="mobile-link flex items-center gap-2 font-semibold text-base text-slate-800 dark:text-white">

                        <!-- Light Mode Logo -->
                        @if (!empty($siteSetting?->logo_light) && file_exists(public_path('uploads/settings/' . $siteSetting->logo_light)))
                            <img src="{{ asset('uploads/settings/' . $siteSetting->logo_light) }}" alt="Logo" class="h-8 w-auto block dark:hidden">
                        @else
                            <!-- Default SVG Fallback -->
                            <svg class="h-8 w-auto block dark:hidden" viewBox="0 0 260 80" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0" y="0" width="80" height="80" rx="18" fill="#005eff"/>
                                <path d="M18 58V22l22 22 22-22v36" stroke="#ffffff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                                <text x="96" y="36" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#1e2939">Magino</text>
                                <text x="96" y="66" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#005eff">Daniel</text>
                            </svg>
                        @endif

                        <!-- Dark Mode Logo -->
                        @if (!empty($siteSetting?->logo_dark) && file_exists(public_path('uploads/settings/' . $siteSetting->logo_dark)))
                            <img src="{{ asset('uploads/settings/' . $siteSetting->logo_dark) }}" alt="Logo" class="h-8 w-auto hidden dark:block">
                        @else
                            <!-- Default SVG Fallback -->
                            <svg class="h-8 w-auto hidden dark:block" viewBox="0 0 260 80" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0" y="0" width="80" height="80" rx="18" fill="#005eff"/>
                                <path d="M18 58V22l22 22 22-22v36" stroke="#ffffff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                                <text x="96" y="36" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#ffffff">Magino</text>
                                <text x="96" y="66" font-family="Arial, Helvetica, sans-serif" font-weight="800" font-size="28" letter-spacing="-0.3" fill="#4d94ff">Daniel</text>
                            </svg>
                        @endif

                    </a>
                    <button id="menu-close" aria-label="Close menu" class="grid place-items-center w-9 h-9 rounded-full hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 6l12 12M6 18L18 6" stroke-linecap="round"/></svg>
                    </button>
                </div>
                <!-- Navigation links -->
                <nav class="flex flex-col px-3 py-4 gap-0.5 flex-1 overflow-y-auto">
                    <a href="/" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Home
                    </a>
                    <a href="#about" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM2 21a10 10 0 0 1 20 0" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        About
                    </a>
                    <a href="#skills" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 17l6-6-6-6M12 19h8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Skills
                    </a>
                    <a href="#experience" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Experience
                    </a>
                    <a href="#projects" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Projects
                    </a>
                    <a href="#certificates" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Certificates
                    </a>
                    <a href="#testimonials" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2" /><path d="M22 6l-10 7L2 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Testimonials
                    </a>
                    <a href="#contact" class="mobile-link flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2" /><path d="M22 6l-10 7L2 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Contact
                    </a>
                </nav>
                <!-- Drawer footer: social links -->
                <div class="px-6 py-4 border-t border-slate-200 dark:border-white/10 flex items-center gap-3">
                    @foreach ($medias as $media)
                    <a href="{{ $media->link }}" target="_blank" rel="noopener" aria-label="{{ $media->name ?? 'Social Link' }}" class="grid place-items-center w-9 h-9 rounded-full border border-slate-200 dark:border-white/10 hover:border-primary-500 dark:hover:border-primary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                        {!! $media->icon !!}
                    </a>
                    
                    @endforeach
                </div>
            </div>
        </div>