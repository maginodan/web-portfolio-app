@extends('layouts.pages.base')
@section('content')
        <!-- ============================================================
             HERO
        ============================================================ -->
        <section id="home" class="relative px-5 sm:px-8 lg:px-12 pt-28 pb-16 lg:pt-32 lg:pb-20 hero-gradient">
            <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-10 lg:gap-14 items-center">
                <!-- LEFT: text content -->
                @foreach ($abouts as $about)
                <div class="reveal order-2 lg:order-1">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-700 dark:text-primary-300 text-xs sm:text-sm font-medium mb-5">
                        <span class="relative flex size-3.5 items-center justify-center">
                            <span class="absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75 animate-ping duration-300"></span>
                            <span class="relative inline-flex size-2 rounded-full bg-primary-600"></span>
                        </span>
                        {{ $about->availability_text }}
                    </span>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white leading-[1.15] tracking-tight">
                        {{ $about->greeting }} {{ $about->name }}<br>
                        @php $roleParts = explode(' ', $about->role, 2); @endphp
                        <span class="text-primary-600 dark:text-primary-400">{{ $roleParts[0] }}</span> {{ $roleParts[1] ?? '' }}
                    </h1>

                    <p class="mt-4 max-w-lg text-base sm:text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ $about->description }}
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-3 sm:gap-4">
                        <a href="#contact" class="inline-flex items-center gap-2 px-6 py-2.5 sm:py-3 rounded-full bg-primary-600 text-white font-medium hover:bg-primary-700 transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-primary-600/20 text-sm sm:text-base">
                            Contact Me
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a href="{{ asset('uploads/cv/' . $about->cv) }}" download class="inline-flex items-center gap-2 px-6 py-2.5 sm:py-3 rounded-full border border-slate-300 dark:border-white/20 hover:bg-white dark:hover:bg-white/5 font-medium transition-all duration-200 hover:-translate-y-0.5 text-sm sm:text-base">
                            My Resume
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    <div class="mt-7 flex items-center gap-4">
                        <span class="text-xs text-slate-500 dark:text-slate-500 uppercase tracking-wider font-medium">Follow</span>
                        <div class="h-px w-6 bg-slate-300 dark:bg-white/15"></div>
                        <div class="flex items-center gap-2.5">
                            @foreach ($medias as $media)
                            <a href="{{ $media->link }}" target="_blank" rel="noopener" aria-label="GitHub" class="grid place-items-center w-9 h-9 rounded-full border border-slate-200 dark:border-white/10 hover:border-primary-500 dark:hover:border-primary-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200">
                                {!! $media->icon !!}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- RIGHT: developer image -->
                <div class="reveal order-1 lg:order-2 flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-sm lg:max-w-md group">

                        <!-- Soft glow behind image — desktop only, static (no animation cost) -->
                        <div class="hidden lg:block absolute -inset-4 rounded-3xl bg-primary-500/20 blur-2xl -z-10"></div>

                        <!-- Image card -->
                        <div class="relative rounded-2xl overflow-hidden border border-slate-200 dark:border-white/10 shadow-xl shadow-slate-900/10 dark:shadow-black/30 transition-transform duration-500 ease-out lg:group-hover:-translate-y-1">
                            <img src="{{ asset('uploads/images/' . $about->home_image) }}" alt="{{ $about->name }}" class="w-full aspect-[4/5] object-cover" loading="eager">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/15 via-transparent to-transparent"></div>
                        </div>

                        <!-- Small experience badge -->
                        <div class="absolute -bottom-3 -left-3 sm:-left-5 bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 shadow-lg flex items-center gap-2.5">
                            <span class="grid place-items-center w-8 h-8 rounded-lg bg-primary-500/10 text-primary-600 dark:text-primary-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            @if ($counters->first())
                            <div class="text-left">
                                <p class="text-sm font-bold text-slate-800 dark:text-white leading-none">{{ $counters->first()->number }}</p>
                                <p class="text-[0.65rem] text-slate-500 dark:text-slate-400 mt-0.5">{!! str_replace('<br>', ' ', $counters->first()->label) !!}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================
             ABOUT
        ============================================================ -->
        <section id="about" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-16 lg:py-20">
            <div class="max-w-7xl mx-auto">
                <div class="reveal mb-10">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">Introduction</span>
                    <h2 class="mt-2 text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white">About Me</h2>
                </div>
                 @foreach ($abouts as $about)
                <div class="grid lg:grid-cols-2 gap-10 lg:gap-14 items-center">
                    <!-- LEFT: about image -->
                    <div class="reveal order-2 lg:order-1">
                        <img src="{{ asset('uploads/images/' . $about->banner_image) }}" alt="{{ $about->name }}" loading="lazy" class="w-full aspect-[4/3] object-cover rounded-2xl border border-slate-200 dark:border-white/10 shadow-lg shadow-slate-900/10 dark:shadow-black/20">
                    </div>

                    <!-- RIGHT: about content -->
                    <div class="reveal order-1 lg:order-2">
                        <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            {{ $about->summary }}
                        </p>

                        <!-- Stat cards -->
                        <div class="grid grid-cols-3 gap-3 sm:gap-4 mb-6">
                            @foreach ($counters as $counter)
                            <div class="border border-slate-200 dark:border-white/10 rounded-xl p-4 text-center hover:border-primary-400 dark:hover:border-primary-500 hover:shadow-md transition-all duration-300">
                                <p class="text-2xl sm:text-3xl font-bold text-primary-600 dark:text-primary-400">{{ $counter->number }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{!! $counter->label !!}</p>
                            </div>
                            @endforeach
                        </div>

                        <!-- Quick info row -->
                        <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-slate-600 dark:text-slate-400 mb-6">

                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($about->address) }}"
                            target="_blank" rel="noopener"
                            class="inline-flex items-center gap-1.5 hover:text-primary-500">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $about->address }}
                            </a>

                            <a href="mailto:{{ $about->email }}" class="inline-flex items-center gap-1.5 hover:text-primary-500">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M22 6l-10 7L2 6h20M2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $about->email }}
                            </a>

                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $about->phone) }}"
                            class="inline-flex items-center gap-1.5 hover:text-primary-500">
                                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.36 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ $about->phone }}
                            </a>

                        </div>

                        <a href="#contact" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-primary-600 text-white font-medium hover:bg-primary-700 transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-primary-600/20 text-sm">
                            Get in touch
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================
             SKILLS — PROGRESS BARS
        ============================================================ -->
        <section id="skills" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-24 bg-white dark:bg-navy-900 border-y border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">My technical level</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">Skills</h2>
                </div>

                <div class="grid sm:grid-cols-2 gap-8">
                    @foreach ($services as $service)
                    <div class="reveal skill-category border border-slate-200 dark:border-white/10 rounded-2xl p-6 sm:p-8 bg-slate-50 dark:bg-transparent">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="grid place-items-center w-11 h-11 rounded-xl bg-primary-500/10 text-primary-600 dark:text-primary-400">
                                
                                {!! $service->icon !!}
                            </span>
                            <div>
                                <h3 class="font-semibold text-slate-800 dark:text-white">{{ $service->name }}</h3>
                                {{-- <p class="text-xs text-slate-500 dark:text-slate-400">{{ $service->description }}</p> --}}
                            </div>
                        </div>
                        <div class="space-y-5">
                            @foreach ($service->skills as $skill)
                            <div class="skill-item">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $skill->name }}</span>
                                    <span class="text-xs font-mono text-slate-500 dark:text-slate-400 skill-percent" data-percent="{{ $skill->proficiency }}">{{ $skill->proficiency }}%</span>
                                </div>
                                <div class="h-2 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                                    <div class="skill-bar h-full rounded-full bg-gradient-to-r from-primary-500 to-primary-600" data-width="{{ $skill->proficiency }}" style="width:0%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============================================================
             EXPERIENCE — ALTERNATING TIMELINE
        ============================================================ -->
        <section id="experience" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-24">
            <div class="max-w-7xl mx-auto">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">My personal journey</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">Qualification</h2>
                </div>

                <!-- Tabs -->
                <div class="reveal flex justify-center gap-3 mb-12">
                    <button data-target="#education" class="qual-tab inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-medium text-sm border transition-all duration-200 border-primary-600 bg-primary-600 text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 12v5c3 3 9 3 12 0v-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Education
                    </button>
                    <button data-target="#work" class="qual-tab inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-medium text-sm border transition-all duration-200 border-slate-200 dark:border-white/15 text-slate-600 dark:text-slate-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Work
                    </button>
                </div>

                <!-- ============================================================
                     EDUCATION TIMELINE
                ============================================================ -->
                <div id="education" class="qual-content">
                    <div class="timeline-container relative max-w-4xl mx-auto">
                        <!-- Center timeline line (desktop) -->
                        <div class="timeline-line hidden md:block absolute left-1/2 top-0 bottom-0 w-px -translate-x-1/2 bg-gradient-to-b from-primary-500 via-primary-400 to-primary-600"></div>
                        <!-- Left timeline line (mobile) -->
                        <div class="md:hidden absolute left-5 top-0 bottom-0 w-px bg-primary-400/40"></div>

                        @foreach ($educations as $education)
                            <div class="timeline-item reveal {{ $loop->last ? '' : 'mb-10 md:mb-12' }}">
                                <div class="md:grid md:grid-cols-2 md:gap-12 items-center">
                                    @if ($loop->odd)
                                        {{-- LEFT --}}
                                        <div class="md:text-right md:pr-12">
                                            <div class="timeline-card bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 rounded-xl p-6 hover:border-primary-400 dark:hover:border-primary-500/50 hover:shadow-lg transition-all duration-300 md:ml-auto">
                                                <div class="flex items-center gap-2 mb-2 md:justify-end">
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        {{ $education->period }}
                                                    </span>
                                                </div>
                                                <h3 class="font-semibold text-slate-800 dark:text-white">{{ $education->degree }}</h3>
                                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $education->institution }}</p>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">{{ $education->description }}</p>
                                            </div>
                                        </div>
                                        <div class="hidden md:block"></div>
                                    @else
                                        {{-- RIGHT --}}
                                        <div class="hidden md:block"></div>
                                        <div class="md:pl-12">
                                            <div class="timeline-card bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 rounded-xl p-6 hover:border-primary-400 dark:hover:border-primary-500/50 hover:shadow-lg transition-all duration-300">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        {{ $education->period }}
                                                    </span>
                                                </div>
                                                <h3 class="font-semibold text-slate-800 dark:text-white">{{ $education->degree }}</h3>
                                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $education->institution }}</p>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">{{ $education->description }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- Timeline dot -->
                                <div class="timeline-dot absolute left-5 md:left-1/2 top-6 -translate-x-1/2 w-4 h-4 rounded-full border-2 border-primary-500 bg-white dark:bg-navy-950 z-10"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ============================================================
                     WORK EXPERIENCE TIMELINE
                ============================================================ -->
                <div id="work" class="qual-content hidden">
                    <div class="timeline-container relative max-w-4xl mx-auto">
                        <div class="timeline-line hidden md:block absolute left-1/2 top-0 bottom-0 w-px -translate-x-1/2 bg-gradient-to-b from-primary-500 via-primary-400 to-primary-600"></div>
                        <div class="md:hidden absolute left-5 top-0 bottom-0 w-px bg-primary-400/40"></div>

                        @foreach ($experiences as $experience)
                            <div class="timeline-item reveal {{ $loop->last ? '' : 'mb-10 md:mb-12' }}">
                                <div class="md:grid md:grid-cols-2 md:gap-12 items-center">
                                    @if ($loop->odd)
                                        {{-- LEFT --}}
                                        <div class="md:text-right md:pr-12">
                                            <div class="timeline-card bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 rounded-xl p-6 hover:border-primary-400 dark:hover:border-primary-500/50 hover:shadow-lg transition-all duration-300 md:ml-auto">
                                                <div class="flex items-center gap-2 mb-2 md:justify-end">
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        {{ $experience->period }}
                                                    </span>
                                                </div>
                                                <h3 class="font-semibold text-slate-800 dark:text-white">{{ $experience->position }}</h3>
                                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $experience->company }}</p>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">{{ $experience->description }}</p>
                                            </div>
                                        </div>
                                        <div class="hidden md:block"></div>
                                    @else
                                        {{-- RIGHT --}}
                                        <div class="hidden md:block"></div>
                                        <div class="md:pl-12">
                                            <div class="timeline-card bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 rounded-xl p-6 hover:border-primary-400 dark:hover:border-primary-500/50 hover:shadow-lg transition-all duration-300">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        {{ $experience->period }}
                                                    </span>
                                                </div>
                                                <h3 class="font-semibold text-slate-800 dark:text-white">{{ $experience->position }}</h3>
                                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $experience->company }}</p>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-3 leading-relaxed">{{ $experience->description }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="timeline-dot absolute left-5 md:left-1/2 top-6 -translate-x-1/2 w-4 h-4 rounded-full border-2 border-primary-500 bg-white dark:bg-navy-950 z-10"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
             PROJECTS
        ============================================================ -->
        <section id="projects" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-24 bg-white dark:bg-navy-900 border-y border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">Most recent work</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">Portfolio</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-slate-600 dark:text-slate-400">A selection of projects showcasing my work across web development and design.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Project 1 -->
                    @foreach ($projects as $project)
                    <article class="reveal group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-navy-800 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('uploads/images/' . $project->image) }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-navy-900/80 via-navy-900/20 to-transparent"></div>
                            @if ($project->category)
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-medium bg-primary-600/90 text-white backdrop-blur-sm">{{ $project->category }}</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-lg text-slate-800 dark:text-white mb-2">{{ $project->title }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">{{ $project->description }}</p>

                            @if ($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach (explode(',', $project->technologies) as $tech)
                                <span class="text-xs px-2.5 py-1 rounded-full bg-slate-200 dark:bg-white/5 text-slate-600 dark:text-slate-300">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                            @endif

                            @if ($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 dark:text-primary-400 hover:gap-3 transition-all">
                                View Demo
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 17L17 7M7 7h10v10" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            @endif
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============================================================
             CERTIFICATES
        ============================================================ -->
        <section id="certificates" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-24">
            <div class="max-w-7xl mx-auto">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">By Programming Hub</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">My Certificates</h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($certificates as $certificate)
                        <div class="reveal group border border-slate-200 dark:border-white/10 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-white dark:bg-navy-900">

                            <div class="aspect-video overflow-hidden {{ $certificate->image ? '' : 'bg-gradient-to-br from-primary-500/15 to-primary-800/10 grid place-items-center p-6' }}">
                                @if ($certificate->image)
                                    <img src="{{ asset('uploads/images/' . $certificate->image) }}" alt="{{ $certificate->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <svg class="w-16 h-16 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke-linecap="round" stroke-linejoin="round"/>
                                   </svg>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="font-semibold text-slate-800 dark:text-white">{{ $certificate->title }}</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 mb-3">{{ $certificate->description }}</p>

                                @if ($certificate->pdf)
                                    <a href="{{ asset('uploads/certificates/' . $certificate->pdf) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 dark:text-primary-400 hover:gap-3 transition-all">
                                        Preview
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M13 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-sm text-slate-400 dark:text-slate-600 cursor-not-allowed">
                                        No PDF available
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============================================================
             TESTIMONIALS
        ============================================================ -->
        <section id="testimonials" class="scroll-mt-20 py-24 bg-white dark:bg-navy-900 border-y border-slate-200 dark:border-white/5 overflow-hidden">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">What clients say</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">Testimonials</h2>
                </div>
            </div>

            @if ($testimonials->count() > 0)
                @php
                    $half = ceil($testimonials->count() / 2);
                    $row1Testimonials = $testimonials->slice(0, $half);
                    $row2Testimonials = $testimonials->slice($half);
                    // fall back to using the full set on both rows if the second half is empty
                    if ($row2Testimonials->isEmpty()) {
                        $row2Testimonials = $row1Testimonials;
                    }
                @endphp

                <div class="reveal testimonial-marquee-row w-full overflow-hidden relative mb-6">
                    <div class="absolute left-0 top-0 h-full w-16 sm:w-32 z-10 pointer-events-none bg-gradient-to-r from-white dark:from-navy-900 to-transparent"></div>

                    <div class="testimonial-track flex gap-6 w-max">
                        @foreach ([1, 2] as $repeat)
                            @foreach ($row1Testimonials as $testimonial)
                                @include('includes.testimonial-card', ['testimonial' => $testimonial])
                            @endforeach
                        @endforeach
                    </div>

                    <div class="absolute right-0 top-0 h-full w-16 sm:w-32 z-10 pointer-events-none bg-gradient-to-l from-white dark:from-navy-900 to-transparent"></div>
                </div>

                <div class="reveal testimonial-marquee-row w-full overflow-hidden relative">
                    <div class="absolute left-0 top-0 h-full w-16 sm:w-32 z-10 pointer-events-none bg-gradient-to-r from-white dark:from-navy-900 to-transparent"></div>

                    <div class="testimonial-track testimonial-track-reverse flex gap-6 w-max">
                        @foreach ([1, 2] as $repeat)
                            @foreach ($row2Testimonials as $testimonial)
                                @include('includes.testimonial-card', ['testimonial' => $testimonial])
                            @endforeach
                        @endforeach
                    </div>

                    <div class="absolute right-0 top-0 h-full w-16 sm:w-32 z-10 pointer-events-none bg-gradient-to-l from-white dark:from-navy-900 to-transparent"></div>
                </div>
            @endif
        </section>

        <!-- ============================================================
             SERVICES
        ============================================================ -->
        <section id="services" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-24 bg-white dark:bg-navy-900 border-y border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">Services I offer</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">Services</h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Service 1: UI/UX -->
                    @foreach ($services as $service)
                    <div class="reveal group border border-slate-200 dark:border-white/10 rounded-2xl p-8 hover:shadow-xl hover:border-primary-400 dark:hover:border-primary-500/40 transition-all duration-300 hover:-translate-y-1">
                        <span class="grid place-items-center w-14 h-14 rounded-2xl bg-primary-500/10 text-primary-600 dark:text-primary-400 mb-5">
                            {!! $service->icon !!}
                        </span>
                        <h3 class="font-semibold text-lg text-slate-800 dark:text-white mb-3">{{ $service->name }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $service->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============================================================
            CONTACT
        ============================================================ -->
        <section id="contact" class="scroll-mt-20 px-5 sm:px-8 lg:px-12 py-24">
            <div class="max-w-7xl mx-auto">
                <div class="reveal text-center mb-16">
                    <span class="text-sm font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">Get in touch</span>
                    <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 dark:text-white">Contact Me</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-slate-600 dark:text-slate-400">I'd love to hear from you! If you have any questions or project inquiries, please use the form below.</p>
                </div>

                <div class="grid lg:grid-cols-5 gap-12">
                    <!-- Contact info -->
                    <div class="reveal lg:col-span-2 space-y-4">
                        @foreach ($abouts as $about)
                        <a href="tel:{{ preg_replace('/\s+/', '', $about->phone) }}" class="flex items-center gap-4 p-5 rounded-2xl border border-slate-200 dark:border-white/10 hover:border-primary-400 dark:hover:border-primary-500/40 transition-colors">
                            <span class="grid place-items-center w-12 h-12 rounded-xl bg-primary-500/10 text-primary-600 dark:text-primary-400 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.36 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.34 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <div>
                                <h3 class="font-semibold text-slate-800 dark:text-white">Call Me</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $about->phone }}</p>
                            </div>
                        </a>

                        <a href="mailto:{{ $about->email }}" class="flex items-center gap-4 p-5 rounded-2xl border border-slate-200 dark:border-white/10 hover:border-primary-400 dark:hover:border-primary-500/40 transition-colors">
                            <span class="grid place-items-center w-12 h-12 rounded-xl bg-primary-500/10 text-primary-600 dark:text-primary-400 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="M22 6l-10 7L2 6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="font-semibold text-slate-800 dark:text-white">Email</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $about->email }}</p>
                            </div>
                        </a>

                        <div class="flex items-center gap-4 p-5 rounded-2xl border border-slate-200 dark:border-white/10 hover:border-primary-400 dark:hover:border-primary-500/40 transition-colors">
                            <span class="grid place-items-center w-12 h-12 rounded-xl bg-primary-500/10 text-primary-600 dark:text-primary-400 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <div>
                                <h3 class="font-semibold text-slate-800 dark:text-white">Location</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $about->address }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Contact form -->
                    <div class="reveal lg:col-span-3">

                        <form id="contact-form" method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                            @csrf

                            <div class="grid sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Name</label>
                                    <input type="text" id="name" name="name" required placeholder="Enter your name" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-navy-900 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 outline-none transition-all">
                                    <p class="field-error mt-1 text-sm text-red-500 hidden"></p>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email</label>
                                    <input type="email" id="email" name="email" required placeholder="Enter your email" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-navy-900 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 outline-none transition-all">
                                    <p class="field-error mt-1 text-sm text-red-500 hidden"></p>
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Subject</label>
                                <input type="text" id="subject" name="subject" required placeholder="Enter project subject" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-navy-900 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 outline-none transition-all">
                                <p class="field-error mt-1 text-sm text-red-500 hidden"></p>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Message</label>
                                <textarea id="description" name="description" rows="5" required placeholder="Enter your message" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-navy-900 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500 outline-none transition-all resize-none"></textarea>
                                <p class="field-error mt-1 text-sm text-red-500 hidden"></p>
                            </div>

                            <!-- hCaptcha Container -->
                            @if($siteSetting?->hcaptcha_enabled && $siteSetting?->hcaptcha_site_key)
                                <div>
                                    <div class="h-captcha" data-sitekey="{{ $siteSetting->hcaptcha_site_key }}"></div>
                                    <p id="hcaptcha-error" class="field-error mt-1 text-sm text-red-500 hidden"></p>
                                </div>

                                <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
                            @endif

                            <button type="submit" id="contact-submit-btn" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-primary-600 text-white font-medium hover:bg-primary-700 transition-all duration-200 hover:-translate-y-0.5 shadow-lg shadow-primary-600/20 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0 min-w-[170px]">
                                <svg id="contact-spinner" class="hidden animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                <span id="contact-btn-text">Send Message</span>
                                <svg id="contact-send-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </form>
                    </div>

                    <!-- Toast container -->
                    <div id="toast-container" class="fixed top-6 right-6 z-50 flex flex-col gap-3 w-[calc(100%-3rem)] sm:w-96"></div>

                    <script>
                        document.getElementById('contact-form').addEventListener('submit', function (e) {
                            e.preventDefault();

                            const form = this;
                            const btn = document.getElementById('contact-submit-btn');
                            const spinner = document.getElementById('contact-spinner');
                            const btnText = document.getElementById('contact-btn-text');
                            const sendIcon = document.getElementById('contact-send-icon');

                            // clear old field errors
                            form.querySelectorAll('.field-error').forEach(el => {
                                el.textContent = '';
                                el.classList.add('hidden');
                            });

                            // show spinner
                            btn.disabled = true;
                            spinner.classList.remove('hidden');
                            sendIcon.classList.add('hidden');
                            btnText.textContent = 'Sending...';

                            fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: new FormData(form),
                            })
                            .then(async (response) => {
                                const data = await response.json();

                                if (response.ok && data.success) {
                                    if (data.demo) {
                                        showToast('info', 'Demo Mode', data.message);
                                    } else {
                                        showToast('success', 'Message Sent', data.message);
                                    }
                                    form.reset();
                                    if (typeof hcaptcha !== 'undefined') {
                                        hcaptcha.reset();
                                    }
                                } else if (response.status === 422 && data.errors) {
                                    // show field-level validation errors
                                    Object.keys(data.errors).forEach(field => {
                                        if (field === 'h-captcha-response') {
                                            const hcaptchaErr = document.getElementById('hcaptcha-error');
                                            if (hcaptchaErr) {
                                                hcaptchaErr.textContent = data.errors[field][0];
                                                hcaptchaErr.classList.remove('hidden');
                                            }
                                        } else {
                                            const input = form.querySelector(`[name="${field}"]`);
                                            if (input) {
                                                const errorEl = input.parentElement.querySelector('.field-error');
                                                if (errorEl) {
                                                    errorEl.textContent = data.errors[field][0];
                                                    errorEl.classList.remove('hidden');
                                                }
                                            }
                                        }
                                    });

                                    if (typeof hcaptcha !== 'undefined') {
                                        hcaptcha.reset();
                                    }

                                    showToast('error', 'Please check your input', 'Some fields need your attention.');
                                } else {
                                    if (typeof hcaptcha !== 'undefined') {
                                        hcaptcha.reset();
                                    }
                                    showToast('error', 'Something went wrong', 'Please try again in a moment.');
                                }
                            })
                            .catch(() => {
                                if (typeof hcaptcha !== 'undefined') {
                                    hcaptcha.reset();
                                }
                                showToast('error', 'Network Error', 'Could not send your message. Check your connection.');
                            })
                            .finally(() => {
                                btn.disabled = false;
                                spinner.classList.add('hidden');
                                sendIcon.classList.remove('hidden');
                                btnText.textContent = 'Send Message';
                            });
                        });

                        function showToast(type, title, message) {
                            const container = document.getElementById('toast-container');

                            const colors = {
                                success: 'bg-green-50 dark:bg-green-500/10 border-green-200 dark:border-green-500/30 text-green-700 dark:text-green-400',
                                error: 'bg-red-50 dark:bg-red-500/10 border-red-200 dark:border-red-500/30 text-red-700 dark:text-red-400',
                                info: 'bg-blue-100 dark:bg-blue-500/15 border-blue-300 dark:border-blue-500/40 text-blue-800 dark:text-blue-300',
                            };

                            const icons = {
                                success: '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                error: '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                info: '<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                            };

                            const toast = document.createElement('div');
                            toast.className = `flex items-start gap-3 p-4 rounded-xl border shadow-lg backdrop-blur-sm transition-all duration-300 opacity-0 translate-x-4 ${colors[type]}`;
                            toast.innerHTML = `
                                ${icons[type]}
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-sm">${title}</p>
                                    <p class="text-sm mt-0.5 opacity-90">${message}</p>
                                </div>
                                <button class="shrink-0 opacity-60 hover:opacity-100" onclick="this.parentElement.remove()">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </button>
                            `;

                            container.appendChild(toast);

                            requestAnimationFrame(() => {
                                toast.classList.remove('opacity-0', 'translate-x-4');
                            });

                            setTimeout(() => {
                                toast.classList.add('opacity-0', 'translate-x-4');
                                setTimeout(() => toast.remove(), 300);
                            }, 5000);
                        }
                    </script>
                </div>
            </div>
        </section>

@endsection   

    
