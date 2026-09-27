<script>
const HAS_PROVIDER = @json($hasEnabledProvider ?? false);
const CATEGORIES = @json($categories ?? []);
const SETTINGS = @json($settings ?? null);
const CHATBOT_CHAT_URL = '{{ route('chatbot.chat') }}';
const isEnabled = (SETTINGS?.enabled !== undefined ? SETTINGS.enabled : true) && HAS_PROVIDER;

let history = [];
let isOpen = false;
let userScrolledUp = false;
let autoScrolling = false;

const toggler = document.getElementById('cb-toggler');
const popup = document.getElementById('cb-popup');
const chatBody = document.getElementById('cb-body');
const form = document.getElementById('cb-form');
const input = document.querySelector('.cb-message-input');
const sendBtn = document.getElementById('cb-send-message');
const badge = document.getElementById('cb-badge');
const teaser = document.getElementById('cb-teaser');
const teaserClose = document.getElementById('cb-teaser-close');
const teaserText = document.getElementById('cb-teaser-text');
const newChatModal = document.getElementById('cb-new-chat-modal');

function applyDisabledState(text) {
    if (form) { form.style.opacity = '0.6'; form.style.pointerEvents = 'none'; }
    if (input) { input.disabled = true; input.placeholder = text; }
    if (sendBtn) sendBtn.disabled = true;
}

function clearDisabledState() {
    if (form) { form.style.opacity = ''; form.style.pointerEvents = ''; }
    if (input) { input.disabled = false; input.placeholder = placeholder(); }
    if (sendBtn) sendBtn.disabled = false;
}

function welcome() {
    return SETTINGS?.welcome_message || 'Hello! How can I help you?';
}

function placeholder() {
    if (!isEnabled) return HAS_PROVIDER ? 'Chat offline' : 'No AI services available';
    if (CATEGORIES?.length) return `Ask about ${CATEGORIES.slice(0, 3).join(', ')}...`;
    return 'Ask me anything...';
}

function timestamp() {
    const d = new Date();
    return `(${d.toLocaleDateString('en-GB')} ${d.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false })})`;
}

function linkify(text) {
    if (!text) return text;
    let result = text;
    result = result.replace(/\[([^\]]+)\]\((https?:\/\/[^\s)]+)\)/g, (m, label, url) => url);
    result = result.replace(/(https?:\/\/[^\s<\]\)]+)/g, url => {
        const clean = url.replace(/[.,!?;:]+$/, '');
        let display = clean.replace(/^https?:\/\/(www\.)?/, '').replace(/\/$/, '');
        if (display.length > 40) display = display.substring(0, 40) + '...';
        return `<a href="${clean}" target="_blank" rel="noopener noreferrer" class="text-primary-600 dark:text-primary-400 underline decoration-primary-300 dark:decoration-primary-700 hover:decoration-primary-600">${display}</a>`;
    });
    result = result.replace(/(^|\s)(www\.[^\s<\]\)]+)/g, (m, prefix, url) => {
        const clean = url.replace(/[.,!?;:]+$/, '');
        return `${prefix}<a href="https://${clean}" target="_blank" rel="noopener noreferrer" class="text-primary-600 dark:text-primary-400 underline decoration-primary-300 dark:decoration-primary-700 hover:decoration-primary-600">${clean}</a>`;
    });
    result = result.replace(/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/g, email =>
        `<a href="mailto:${email}" class="text-primary-600 dark:text-primary-400 underline decoration-primary-300 dark:decoration-primary-700 hover:decoration-primary-600">${email}</a>`
    );
    return result;
}

function scrollToBottom() {
    autoScrolling = true;
    chatBody.scrollTop = chatBody.scrollHeight;
    requestAnimationFrame(() => { autoScrolling = false; });
}

chatBody.addEventListener('scroll', () => {
    if (autoScrolling) return;
    const distanceFromBottom = chatBody.scrollHeight - chatBody.scrollTop - chatBody.clientHeight;
    userScrolledUp = distanceFromBottom > 20;
});

/**
 * FIX: every message wrapper now gets an explicit, unambiguous class
 * ("cb-user-message" or "cb-bot-message") — same pattern as the mgd- script.
 * This is what lastBot() below relies on instead of guessing via :not().
 */
function addMsg(text, role, error = false, thinking = false) {
    const div = document.createElement('div');
    const roleClass = role === 'user' ? 'cb-user-message' : 'cb-bot-message';
    div.className = `cb-message flex gap-2.5 ${roleClass} ${role === 'user' ? 'flex-col items-end' : ''}`;

    if (role === 'model') {
        const img = document.createElement('img');
        img.src = "{{ asset('uploads/avatar.png') }}";
        img.alt = 'Assistant';
        img.className = 'w-8 h-8 rounded-full object-cover self-end mb-0.5 border-2 border-white dark:border-navy-900 shadow-sm';
        div.appendChild(img);
    }

    const p = document.createElement('p');
    p.className = 'cb-message-text';

    const bubbleBase = 'px-4 py-3 max-w-[80%] text-sm leading-relaxed rounded-2xl whitespace-pre-line break-words';
    if (role === 'user') {
        p.className += ` ${bubbleBase} bg-primary-600 text-white rounded-br-sm shadow-sm shadow-primary-600/20`;
    } else {
        p.className += ` ${bubbleBase} bg-primary-500/10 text-slate-800 dark:text-slate-100 rounded-bl-sm ${error ? '!bg-red-50 dark:!bg-red-500/10 !text-red-600 dark:!text-red-400' : ''}`;
    }

    if (thinking) {
        p.innerHTML = `<div class="cb-thinking"><div class="cb-dot bg-primary-500"></div><div class="cb-dot bg-primary-500"></div><div class="cb-dot bg-primary-500"></div></div>`;
    } else if (error) {
        p.textContent = text;
    } else if (role === 'model') {
        p.innerHTML = linkify(text);
    } else {
        p.textContent = text;
    }

    div.appendChild(p);
    chatBody.appendChild(div);
    scrollToBottom();
    return div;
}

async function typeMsg(el, text) {
    const p = el.querySelector('.cb-message-text');
    if (!p) return; // safety guard — never throw even if markup ever changes
    const hasLink = /(https?:\/\/|www\.|@)/.test(text);

    if (hasLink) {
        p.innerHTML = linkify(text);
        if (!userScrolledUp) scrollToBottom();
        return;
    }

    p.textContent = '';
    for (const c of text) {
        p.textContent += c;
        if (!userScrolledUp) scrollToBottom();
        await new Promise(r => setTimeout(r, Math.random() * 30 + 10));
    }
}

/**
 * FIX: mirrors the mgd- script exactly — select by the explicit bot-message
 * class instead of "any div that isn't flex-col", which previously matched
 * the nested .cb-dot thinking-indicator divs and returned the wrong element.
 */
function lastBot() {
    return chatBody.querySelector('.cb-bot-message:last-child');
}

function resetChat() {
    userScrolledUp = false;

    if (!HAS_PROVIDER) {
        chatBody.innerHTML = '';
        addMsg('⚠️ No AI services available. Please check configuration.', 'model', true);
        applyDisabledState('No AI services available');
        return;
    }

    if (!isEnabled) {
        chatBody.innerHTML = '';
        addMsg("I'm currently offline. Please check back later.", 'model');
        applyDisabledState('Chat offline');
        return;
    }

    clearDisabledState();
    chatBody.innerHTML = '';
    addMsg(welcome(), 'model');

    history = [];
    scrollToBottom();
}

async function callAPI(msgs) {
    userScrolledUp = false;
    scrollToBottom();

    if (!isEnabled) {
        const el = lastBot();
        if (el) {
            const p = el.querySelector('.cb-message-text');
            if (p) p.textContent = HAS_PROVIDER
                ? "I'm currently offline. Please check back later."
                : 'No AI services available. Please try again later.';
        }
        return;
    }

    try {
        const res = await fetch(CHATBOT_CHAT_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ messages: msgs })
        });

        const json = await res.json();
        if (!json.success) throw new Error(json.message || 'Request failed');

        const text = String(json.reply || '').replace(/\*\*(.*?)\*\*/g, '$1').trim();
        const el = lastBot();
        if (el) await typeMsg(el, text);

        history.push({ role: 'assistant', content: text });
    } catch (e) {
        console.warn('Chat request failed:', e.message);
        const el = lastBot();
        if (el) {
            const p = el.querySelector('.cb-message-text');
            if (p) p.textContent = 'All services are currently unavailable. Please try again later.';
        }
        history.pop();
    }
}

function showTeaser() {
    if (!teaser || !isEnabled || isOpen) return;
    if (teaserText) teaserText.textContent = SETTINGS?.welcome_message || "👋 Hi! Have a question? Chat with me.";
    teaser.classList.add('show');
    if (badge) badge.classList.remove('hidden');
}

function hideTeaser() {
    if (teaser) teaser.classList.remove('show');
}

if (teaserClose) {
    teaserClose.addEventListener('click', e => { e.stopPropagation(); hideTeaser(); });
}

if (teaser) {
    teaser.addEventListener('click', () => {
        hideTeaser();
        if (!isOpen) toggler.click();
    });
}

if (isEnabled) setTimeout(showTeaser, 4000);

toggler.addEventListener('click', () => {
    isOpen = !isOpen;
    toggler.classList.toggle('active', isOpen);
    popup.classList.toggle('active', isOpen);
    if (isOpen && badge) badge.classList.add('hidden');
    if (isOpen) hideTeaser();
});

function closeChat() {
    isOpen = false;
    toggler.classList.remove('active');
    popup.classList.remove('active');
}

document.getElementById('cb-close-chat').addEventListener('click', closeChat);

document.getElementById('cb-new-chat-btn').addEventListener('click', () => {
    if (!isEnabled) { resetChat(); return; }
    newChatModal.classList.add('active');
});

document.getElementById('cb-cancel-new-chat').addEventListener('click', () => {
    newChatModal.classList.remove('active');
});

document.getElementById('cb-confirm-new-chat').addEventListener('click', () => {
    resetChat();
    newChatModal.classList.remove('active');
});

document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;
    if (newChatModal.classList.contains('active')) {
        newChatModal.classList.remove('active');
    } else if (isOpen) {
        closeChat();
    }
});

document.getElementById('cb-download-chat-btn').addEventListener('click', () => {
    let t = '';
    chatBody.querySelectorAll('.cb-message').forEach(m => {
        const u = m.classList.contains('cb-user-message');
        const p = m.querySelector('.cb-message-text');
        if (!p) return;
        const content = p.textContent || p.innerText;
        t += `[${u ? 'User' : 'Assistant'}]\n${content}\n${timestamp()}\n\n`;
    });

    const b = new Blob([t], { type: 'text/plain' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(b);
    a.download = `Chat_${new Date().toISOString().slice(0, 10)}.txt`;
    a.click();
    URL.revokeObjectURL(a.href);
});

form.addEventListener('submit', async e => {
    e.preventDefault();

    if (!isEnabled) {
        addMsg(
            HAS_PROVIDER ? "I'm currently offline. Please check back later." : 'No AI services available. Please try again later.',
            'model', true
        );
        return;
    }

    const text = input.value.trim();
    if (!text) return;

    input.disabled = true;
    addMsg(text, 'user');
    input.value = '';
    addMsg('', 'model', false, true);

    userScrolledUp = false;
    scrollToBottom();

    const msgs = [...history, { role: 'user', content: text }];
    history.push({ role: 'user', content: text });

    await callAPI(msgs);

    input.disabled = false;
    input.focus();
});

resetChat();
</script>