<div class="testimonial-card shrink-0 w-80 border border-slate-200 dark:border-white/10 rounded-2xl p-6 bg-white dark:bg-navy-950 hover:shadow-lg hover:border-primary-400 dark:hover:border-primary-500/40 transition-all duration-300">
    <div class="flex items-center gap-3 mb-4">
        <img
            src="{{ $testimonial->image ? asset('uploads/images/' . $testimonial->image) : asset('images/avatar.png') }}"
            alt="{{ $testimonial->name }}"
            class="w-11 h-11 rounded-full object-cover border border-slate-200 dark:border-white/10">
        <div>
            <p class="font-semibold text-sm text-slate-800 dark:text-white">{{ $testimonial->name }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $testimonial->function }}</p>
        </div>
    </div>

    <div class="flex items-center gap-0.5 mb-3">
        @for ($i = 1; $i <= 5; $i++)
            <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'text-primary-500' : 'text-slate-200 dark:text-white/10' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 0 0 .95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 0 0-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.539 1.118l-3.367-2.447a1 1 0 0 0-1.176 0l-3.367 2.447c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 0 0-.363-1.118L2.063 9.385c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 0 0 .95-.69z"/>
            </svg>
        @endfor
    </div>

    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
        {{ $testimonial->testimony }}
    </p>
</div>