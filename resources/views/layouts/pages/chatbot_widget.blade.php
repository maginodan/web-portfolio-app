<!-- resources/views/layouts/pages/chatbot_widget.blade.php -->
<div id="cb-root">
  <!-- Teaser bubble -->
  <div class="cb-teaser bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 shadow-xl shadow-slate-900/10 dark:shadow-black/30" id="cb-teaser">
    <button class="absolute top-2 right-2.5 text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 text-base leading-none p-1" id="cb-teaser-close" aria-label="Dismiss">&times;</button>
    <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300 pr-4" id="cb-teaser-text">👋 Hi! Have a question? Chat with me.</p>
  </div>

  <!-- Toggle button -->
  <button id="cb-toggler" aria-label="Open Chatbot" class="relative w-14 h-14 rounded-full bg-primary-600 hover:bg-primary-700 shadow-lg shadow-primary-600/30 grid place-items-center text-white transition-all duration-200 hover:-translate-y-0.5">
    <svg class="cb-icon-open w-7 h-7 absolute transition-opacity duration-200" viewBox="0 0 100 100" fill="currentColor">
      <circle cx="50" cy="12" r="5"/>
      <line x1="50" y1="17" x2="50" y2="27" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
      <rect x="18" y="27" width="64" height="52" rx="16"/>
      <rect x="6" y="42" width="10" height="20" rx="5"/>
      <rect x="84" y="42" width="10" height="20" rx="5"/>
      <rect class="fill-primary-600" x="28" y="38" width="44" height="30" rx="10"/>
      <circle cx="40" cy="53" r="5"/>
      <circle cx="60" cy="53" r="5"/>
      <path d="M40 62 Q50 68 60 62" stroke="currentColor" stroke-width="3.5" fill="none" stroke-linecap="round"/>
    </svg>
    <svg class="cb-icon-close w-6 h-6 absolute opacity-0 transition-opacity duration-200" viewBox="0 0 24 24" fill="currentColor">
      <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
    </svg>
    <div class="hidden absolute -top-1 -right-1 w-5 h-5 rounded-full bg-red-500 text-white text-xs font-semibold grid place-items-center border-2 border-white dark:border-navy-900" id="cb-badge">1</div>
  </button>

  <!-- Chat popup -->
  <div class="cb-popup bg-white dark:bg-navy-900 border border-slate-200 dark:border-white/10 shadow-2xl shadow-slate-900/20 dark:shadow-black/40" id="cb-popup" data-lenis-prevent>

    <!-- New chat confirm modal -->
    <div class="absolute inset-0 rounded-2xl bg-slate-900/45 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200" id="cb-new-chat-modal">
      <div class="bg-white dark:bg-navy-900 rounded-2xl p-6 w-[85%] max-w-xs shadow-2xl border border-slate-200 dark:border-white/10">
        <h3 class="font-semibold text-slate-800 dark:text-white mb-2">Start New Chat</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Are you sure you want to start a new chat? Your current conversation will be cleared.</p>
        <div class="flex gap-2.5 justify-end mt-5">
          <button class="px-4 py-2 rounded-lg text-sm font-medium bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/15 transition-colors" id="cb-cancel-new-chat">Cancel</button>
          <button class="px-4 py-2 rounded-lg text-sm font-medium bg-primary-600 hover:bg-primary-700 text-white transition-colors" id="cb-confirm-new-chat">New Chat</button>
        </div>
      </div>
    </div>

    <!-- Header -->
    <div class="flex items-center justify-between px-5 py-4 bg-primary-600 shrink-0">
      <h2 class="text-white font-semibold text-lg tracking-tight">{{ $about->name ?? 'Assistant' }}</h2>
      <div class="flex gap-2">
        <button id="cb-new-chat-btn" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 text-white grid place-items-center transition-colors" title="New Chat">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/></svg>
        </button>
        <button id="cb-download-chat-btn" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 text-white grid place-items-center transition-colors" title="Download Chat">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
        </button>
        <button id="cb-close-chat" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 text-white grid place-items-center transition-colors" title="Close Chat">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
        </button>
      </div>
    </div>

    <!-- Messages -->
    <div class="cb-body flex-1 min-h-0 overflow-y-auto px-5 py-6 flex flex-col gap-4 bg-slate-50 dark:bg-navy-950/40" id="cb-body" data-lenis-prevent></div>

    <!-- Input -->
    <div class="px-4 pb-5 pt-3 bg-white dark:bg-navy-900 border-t border-slate-100 dark:border-white/5 shrink-0">
      <form id="cb-form" class="cb-form">
        <div class="cb-input-wrapper flex items-center bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-full transition-all duration-200">
          <input type="text" class="cb-message-input w-full h-12 bg-transparent border-none outline-none px-5 text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500" placeholder="Ask about skills, projects, or experience..." autocomplete="off" />
          <button type="submit" id="cb-send-message" class="hidden w-9 h-9 rounded-full bg-primary-600 hover:bg-primary-700 text-white grid place-items-center mr-1.5 transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
          </button>
        </div>
        <p class="text-xs text-slate-400 dark:text-slate-500 text-center mt-2.5">AI can make mistakes. Verify important details.</p>
      </form>
    </div>
  </div>
</div>

@include('layouts.chatbot.chatbot_widget_styles')
@include('layouts.chatbot.chatbot_widget_scripts')