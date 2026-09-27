<!-- resources/views/layouts/chatbot/chatbot_widget_styles.blade.php -->
<style>
#cb-root {
  position: fixed;
  z-index: 99999;
  bottom: 92px; /* was 28px — lifted clear of the scroll-to-top button */
  right: 28px;
}

.cb-popup {
  position: fixed;
  bottom: 160px; /* was 96px — shifted up by the same 64px as #cb-root */
  right: 28px;
  width: 400px;
  height: 600px;
  max-height: calc(100vh - 204px); /* was 140px, +64px to match */
  border-radius: 1.25rem;
  opacity: 0;
  pointer-events: none;
  transform: scale(0.94) translateY(14px);
  transform-origin: bottom right;
  transition: opacity 0.25s cubic-bezier(0.4,0,0.2,1), transform 0.25s cubic-bezier(0.4,0,0.2,1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  overscroll-behavior: contain;
}
.cb-popup.active {
  opacity: 1;
  pointer-events: auto;
  transform: scale(1) translateY(0);
}

#cb-toggler {
  cursor: pointer;
}
#cb-toggler.active { transform: rotate(90deg); }
#cb-toggler.active .cb-icon-open { opacity: 0; }
#cb-toggler.active .cb-icon-close { opacity: 1; }

#cb-new-chat-modal.active { opacity: 1; pointer-events: auto; }

.cb-body { scrollbar-width: thin; }
.cb-body::-webkit-scrollbar { width: 6px; }
.cb-body::-webkit-scrollbar-thumb { background: rgba(148,163,184,0.4); border-radius: 10px; }

.cb-input-wrapper:focus-within {
  border-color: var(--tw-ring-color, #2563eb);
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.cb-message-input:not(:placeholder-shown) ~ #cb-send-message {
  display: flex !important;
  align-items: center;
  justify-content: center;
}

.cb-thinking { display: flex; gap: 6px; padding: 6px 2px; }
.cb-thinking .cb-dot {
  width: 7px; height: 7px; border-radius: 9999px;
  animation: cbDotPulse 1.5s ease-in-out infinite both;
}
.cb-thinking .cb-dot:nth-child(2) { animation-delay: 0.2s; }
.cb-thinking .cb-dot:nth-child(3) { animation-delay: 0.4s; }
@keyframes cbDotPulse { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }

/* Teaser */
.cb-teaser {
  position: absolute;
  bottom: 78px; /* stays relative to #cb-root, which itself moved up */
  right: 2px;
  width: 260px;
  border-radius: 1rem;
  padding: 16px 20px;
  opacity: 0;
  transform: translateY(10px) scale(0.96);
  transform-origin: bottom right;
  pointer-events: none;
  transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
  cursor: pointer;
}
.cb-teaser.show { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }

@media (max-width: 520px) {
  .cb-popup { width: calc(100vw - 20px); right: 10px; bottom: 152px; height: calc(100vh - 192px); }
  .cb-teaser { width: calc(100vw - 80px); right: 0; }
}
</style>