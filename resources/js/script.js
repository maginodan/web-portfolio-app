/* ============================================================
   THEME MANAGEMENT
============================================================ */
(function () {
    var stored = localStorage.getItem('theme');
    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    var isDark = stored ? stored === 'dark' : prefersDark;

    if (isDark) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
})();

document.addEventListener('DOMContentLoaded', function () {
    var themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }

    /* ============================================================
       MOBILE MENU
    ============================================================ */
    var menuToggle = document.getElementById('menu-toggle');
    var menuClose = document.getElementById('menu-close');
    var mobileMenu = document.getElementById('mobile-menu');
    var overlay = document.getElementById('mobile-menu-overlay');
    var panel = document.getElementById('mobile-menu-panel');
    var iconOpen = document.getElementById('menu-icon-open');
    var iconClose = document.getElementById('menu-icon-close');
    var menuCloseTimer = null;

    function openMenu() {
        if (!mobileMenu) return;

        if (menuCloseTimer) {
            clearTimeout(menuCloseTimer);
            menuCloseTimer = null;
        }

        mobileMenu.classList.remove('invisible', 'opacity-0', 'pointer-events-none');
        mobileMenu.classList.add('opacity-100', 'pointer-events-auto');

        if (panel) {
            /* force reflow so the translate-x transition actually plays */
            void panel.offsetWidth;
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
        }

        menuToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        if (iconOpen) iconOpen.classList.add('hidden');
        if (iconClose) iconClose.classList.remove('hidden');
    }

    function closeMenu() {
        if (!mobileMenu) return;

        if (panel) {
            panel.classList.add('translate-x-full');
            panel.classList.remove('translate-x-0');
        }

        mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
        mobileMenu.classList.add('opacity-0', 'pointer-events-none');

        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        if (iconOpen) iconOpen.classList.remove('hidden');
        if (iconClose) iconClose.classList.add('hidden');

        /* Wait for the opacity transition, then fully hide (removes from a11y tree / tab order) */
        if (menuCloseTimer) clearTimeout(menuCloseTimer);
        menuCloseTimer = setTimeout(function () {
            mobileMenu.classList.add('invisible');
            menuCloseTimer = null;
        }, 300);
    }

    if (menuToggle) menuToggle.addEventListener('click', openMenu);
    if (menuClose) menuClose.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);

    document.querySelectorAll('.mobile-link').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    /* Close menu when resizing to desktop */
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 768 && mobileMenu && mobileMenu.classList.contains('pointer-events-auto')) {
            closeMenu();
        }
    });

    /* ============================================================
       NAVBAR SCROLL EFFECT
    ============================================================ */
    var navbar = document.getElementById('navbar');

    function handleScroll() {
        var scroll = window.scrollY;

        if (scroll > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        /* Scroll to top button */
        var scrollTopBtn = document.getElementById('scroll-top');
        if (scrollTopBtn) {
            if (scroll > 500) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
                scrollTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'invisible');
                scrollTopBtn.classList.remove('opacity-100', 'visible');
            }
        }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });

    /* ============================================================
       SCROLL TO TOP
    ============================================================ */
    var scrollTopBtn = document.getElementById('scroll-top');
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ============================================================
       ACTIVE NAV LINK ON SCROLL
    ============================================================ */
    var sections = document.querySelectorAll('section[id]');
    var navLinks = document.querySelectorAll('.nav-link');

    function updateActiveLink() {
        var scroll = window.scrollY + 120;
        var current = '';

        sections.forEach(function (section) {
            var top = section.offsetTop;
            var height = section.offsetHeight;
            if (scroll >= top && scroll < top + height) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(function (link) {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', updateActiveLink, { passive: true });
    updateActiveLink();

    /* ============================================================
       SCROLL REVEAL ANIMATIONS
    ============================================================ */
    var revealElements = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1, rootMargin: '0px 0px -60px 0px' }
        );

        revealElements.forEach(function (el) {
            revealObserver.observe(el);
        });
    } else {
        revealElements.forEach(function (el) {
            el.classList.add('visible');
        });
    }

    /* ============================================================
       SKILL PROGRESS BAR ANIMATION
    ============================================================ */
    var skillBars = document.querySelectorAll('.skill-bar');

    if ('IntersectionObserver' in window) {
        var skillObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var bar = entry.target;
                        var width = bar.getAttribute('data-width');
                        requestAnimationFrame(function () {
                            bar.style.width = width + '%';
                        });
                        skillObserver.unobserve(bar);
                    }
                });
            },
            { threshold: 0.3 }
        );

        skillBars.forEach(function (bar) {
            skillObserver.observe(bar);
        });
    } else {
        skillBars.forEach(function (bar) {
            bar.style.width = bar.getAttribute('data-width') + '%';
        });
    }

    /* ============================================================
       QUALIFICATION TABS
    ============================================================ */
    var qualTabs = document.querySelectorAll('.qual-tab');
    var qualContents = document.querySelectorAll('.qual-content');

    qualTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = tab.getAttribute('data-target');

            qualTabs.forEach(function (t) {
                t.classList.remove('border-primary-600', 'bg-primary-600', 'text-white');
                t.classList.add('border-slate-200', 'dark:border-white/15', 'text-slate-600', 'dark:text-slate-300');
            });

            tab.classList.add('border-primary-600', 'bg-primary-600', 'text-white');
            tab.classList.remove('border-slate-200', 'dark:border-white/15', 'text-slate-600', 'dark:text-slate-300');

            qualContents.forEach(function (content) {
                content.classList.add('hidden');
            });

            var targetEl = document.querySelector(target);
            if (targetEl) {
                targetEl.classList.remove('hidden');

                /* Re-trigger reveal animations */
                var reveals = targetEl.querySelectorAll('.reveal');
                reveals.forEach(function (el) {
                    el.classList.add('visible');
                });

                /* Re-trigger skill bars if any */
                var bars = targetEl.querySelectorAll('.skill-bar');
                bars.forEach(function (bar) {
                    var width = bar.getAttribute('data-width');
                    requestAnimationFrame(function () {
                        bar.style.width = width + '%';
                    });
                });
            }
        });
    });

    /* ============================================================
       CONTACT FORM
    ============================================================ */
    var contactForm = document.getElementById('contact-form');
    var formStatus = document.getElementById('form-status');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var name = contactForm.querySelector('#name').value.trim();
            var email = contactForm.querySelector('#email').value.trim();
            var subject = contactForm.querySelector('#subject').value.trim();
            var message = contactForm.querySelector('#message').value.trim();

            if (!name || !email || !subject || !message) {
                showFormStatus('Please fill in all fields.', 'error');
                return;
            }

            /* hCaptcha verification */
            var captchaResponse = null;
            var hcaptchaInput = document.querySelector('[name="h-captcha-response"]');
            if (hcaptchaInput) {
                captchaResponse = hcaptchaInput.value;
            }

            if (!captchaResponse) {
                showFormStatus('Please complete the captcha verification.', 'error');
                return;
            }

            /* Submit placeholder — wire to a backend endpoint when ready */
            showFormStatus('Thank you, ' + name + '! Your message has been received. I will get back to you soon.', 'success');
            contactForm.reset();
            if (window.hcaptcha) {
                try { hcaptcha.reset(); } catch (err) {}
            }
        });
    }

    function showFormStatus(message, type) {
        if (!formStatus) return;
        formStatus.textContent = message;
        formStatus.classList.remove('hidden');

        if (type === 'success') {
            formStatus.className = 'text-sm px-4 py-3 rounded-xl bg-primary-500/10 text-primary-700 dark:text-primary-400 border border-primary-500/20';
        } else {
            formStatus.className = 'text-sm px-4 py-3 rounded-xl bg-red-500/10 text-red-600 dark:text-red-400 border border-red-500/20';
        }

        setTimeout(function () {
            formStatus.classList.add('hidden');
        }, 6000);
    }

    /* ============================================================
       FOOTER YEAR
    ============================================================ */
    var yearEl = document.getElementById('currentYear');
    if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
    }
});
