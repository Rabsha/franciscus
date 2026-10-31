/* ==========================================================================
   Franciscus Cornelis — interactions (jQuery 4 + GSAP 3 + Lenis)
   ========================================================================== */
(function ($) {
    'use strict';

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const $body = $('body');

    gsap.registerPlugin(ScrollTrigger);

    // Always start at the top so the intro plays from the hero.
    if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
    window.scrollTo(0, 0);

    /* ---------- Smooth scroll (Lenis) ---------- */
    let lenis = null;
    if (!reduceMotion) {
        lenis = new Lenis({ lerp: 0.09, smoothWheel: true, wheelMultiplier: 1 });
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => lenis.raf(time * 1000));
        gsap.ticker.lagSmoothing(0);
    }

    function scrollToTarget(target) {
        if (target === '#top') target = 0;
        if (lenis) {
            lenis.scrollTo(target, { duration: 1.6, easing: (t) => 1 - Math.pow(1 - t, 4) });
        } else {
            const top = target === 0 ? 0 : $(target).offset().top;
            window.scrollTo({ top, behavior: reduceMotion ? 'auto' : 'smooth' });
        }
    }

    function lockScroll(lock) {
        $body.toggleClass('is-locked', lock);
        if (lenis) lock ? lenis.stop() : lenis.start();
    }

    /* ---------- Text splitting ---------- */
    const escapeHtml = (s) => s.replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    function splitChars(el) {
        const text = el.textContent.trim();
        el.setAttribute('aria-label', text);
        el.innerHTML = [...text].map((c) => (c === ' ' ? ' ' : `<span class="char" aria-hidden="true">${escapeHtml(c)}</span>`)).join('');
    }

    // Splits into words while keeping inline tags like <em class="...">.
    function splitWords(el) {
        const parts = [];
        el.childNodes.forEach((node) => {
            const words = node.textContent.split(/\s+/).filter(Boolean);
            const tag = node.nodeType === 1 ? node.tagName.toLowerCase() : null;
            words.forEach((w) => {
                const inner = tag ? `<${tag} class="${node.className}">${escapeHtml(w)}</${tag}>` : escapeHtml(w);
                parts.push(`<span class="word"><span class="word-inner">${inner}</span></span>`);
            });
        });
        el.innerHTML = parts.join(' ');
    }

    $('.hero__line').each(function () { splitChars(this); });
    $('[data-split]').not('.hero__line').each(function () { splitWords(this); });
    $('[data-words]').each(function () { splitWords(this); });

    /* ---------- Initial states ---------- */
    if (!reduceMotion) {
        gsap.set('.hero__line .char', { yPercent: 115 });
        gsap.set('.hero__img-wrap', { clipPath: 'inset(100% 0% 0% 0%)' });
        gsap.set('.hero__img', { scale: 1.45 });
        gsap.set('.hero__badge', { scale: 0, rotate: -120 });
        gsap.set('.hero__float', { autoAlpha: 0, y: 80 });
        gsap.set('.hero-meta', { autoAlpha: 0, y: 24 });
        gsap.set('.site-header', { yPercent: -100 });
    }

    /* ---------- Preloader ---------- */
    function runPreloader() {
        const $count = $('.preloader__count span');
        const $bar = $('.preloader__bar span');
        const counter = { v: 0 };

        $body.addClass('is-loading');
        lockScroll(true);

        const countTween = gsap.to(counter, {
            v: 100,
            duration: reduceMotion ? 0.3 : 2.2,
            ease: 'power2.inOut',
            onUpdate() {
                $count.text(Math.round(counter.v));
                $bar.css('width', counter.v + '%');
            },
        });

        const pageLoaded = new Promise((resolve) => {
            if (document.readyState === 'complete') resolve();
            else window.addEventListener('load', resolve, { once: true });
        });
        const fontsReady = document.fonts ? document.fonts.ready : Promise.resolve();
        const timeout = new Promise((resolve) => setTimeout(resolve, 5000));

        Promise.race([Promise.all([countTween.then(), pageLoaded, fontsReady]), timeout]).then(() => {
            gsap.timeline({
                onComplete() {
                    $('.preloader').remove();
                    $body.removeClass('is-loading');
                    lockScroll(false);
                    ScrollTrigger.refresh();
                    lastY = window.scrollY;
                    updateHeader(window.scrollY);
                },
            })
                .to('.preloader__inner, .preloader__count', { autoAlpha: 0, y: -40, duration: 0.6, ease: 'power3.in' })
                .to('.preloader', { yPercent: -100, duration: 1.1, ease: 'expo.inOut' }, '-=0.1')
                .add(heroIntro(), '-=0.55');
        });
    }

    function heroIntro() {
        const tl = gsap.timeline();
        if (reduceMotion) return tl;
        tl.to('.hero__img-wrap', { clipPath: 'inset(0% 0% 0% 0%)', duration: 1.5, ease: 'expo.inOut' })
            .to('.hero__img', { scale: 1.15, duration: 2, ease: 'expo.out' }, '<0.2')
            .to('.hero__line .char', { yPercent: 0, duration: 1.4, ease: 'expo.out', stagger: 0.035 }, '<0.1')
            .to('.hero__badge', { scale: 1, rotate: 0, duration: 1.4, ease: 'back.out(1.6)' }, '<0.5')
            .to('.hero__float', { autoAlpha: 1, y: 0, duration: 1.4, ease: 'expo.out', stagger: 0.15 }, '<0.1')
            .to('.hero-meta', { autoAlpha: 1, y: 0, duration: 1, ease: 'power3.out', stagger: 0.08 }, '<0.2')
            .to('.site-header', { yPercent: 0, duration: 1, ease: 'expo.out', clearProps: 'transform' }, '<');
        return tl;
    }

    /* ---------- Scroll animations ---------- */
    function initScrollAnimations() {
        // Progress bar
        gsap.to('.progress span', {
            scaleX: 1, ease: 'none',
            scrollTrigger: { start: 0, end: 'max', scrub: 0.3 },
        });

        if (reduceMotion) {
            $('.about-statement .word').css('opacity', 1);
            return;
        }

        // Hero parallax on scroll
        gsap.timeline({ scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: true } })
            .to('.hero__line:first-child', { xPercent: -12 }, 0)
            .to('.hero__line:last-child', { xPercent: 12 }, 0)
            .to('.hero__figure', { yPercent: 18 }, 0)
            .to('.hero__img', { scale: 1.3 }, 0);

        $('.hero__float').each(function () {
            gsap.to(this, {
                yPercent: parseFloat(this.dataset.speed) * 100,
                ease: 'none',
                scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: true },
            });
        });

        // Generic fade-up
        $('[data-reveal]').each(function () {
            gsap.from(this, {
                y: 50, autoAlpha: 0, duration: 1.2, ease: 'expo.out',
                scrollTrigger: { trigger: this, start: 'top 88%' },
            });
        });

        // Split headings
        $('[data-split]').not('.hero__line').each(function () {
            gsap.from($(this).find('.word-inner').get(), {
                yPercent: 115, rotate: 4, duration: 1.3, ease: 'expo.out', stagger: 0.07,
                scrollTrigger: { trigger: this, start: 'top 88%' },
            });
        });

        // About statement — words light up while scrolling
        $('[data-words]').each(function () {
            gsap.to($(this).find('.word').get(), {
                opacity: 1, stagger: 0.08, ease: 'none',
                scrollTrigger: { trigger: this, start: 'top 80%', end: 'bottom 50%', scrub: true },
            });
        });

        // Image curtain reveal
        $('.reveal-img').each(function () {
            const img = $(this).find('img').get(0);
            gsap.timeline({ scrollTrigger: { trigger: this, start: 'top 85%' } })
                .from(this, { clipPath: 'inset(100% 0% 0% 0%)', duration: 1.5, ease: 'expo.inOut' })
                .from(img, { scale: 1.35, duration: 2, ease: 'expo.out' }, '<0.2');
        });

        // Inner image parallax
        $('[data-parallax-img]').each(function () {
            gsap.fromTo(this, { yPercent: -6 }, {
                yPercent: 6, ease: 'none',
                scrollTrigger: { trigger: this.parentElement, start: 'top bottom', end: 'bottom top', scrub: true },
            });
        });

        // Counters
        $('.counter').each(function () {
            const el = this;
            const obj = { v: 0 };
            gsap.to(obj, {
                v: +el.dataset.to, duration: 2, ease: 'power3.out',
                scrollTrigger: { trigger: el, start: 'top 90%' },
                onUpdate: () => { el.textContent = Math.round(obj.v); },
            });
        });

        // Gallery items
        gsap.set('.gallery-item', { autoAlpha: 0, y: 70 });
        ScrollTrigger.batch('.gallery-item', {
            start: 'top 92%',
            onEnter: (batch) => gsap.to(batch, { autoAlpha: 1, y: 0, duration: 1.2, ease: 'expo.out', stagger: 0.08, overwrite: true }),
        });

        // Quote
        gsap.timeline({ scrollTrigger: { trigger: '.quote', start: 'top bottom', end: 'bottom top', scrub: true } })
            .fromTo('.quote__bg', { scale: 1.3, yPercent: -8 }, { scale: 1, yPercent: 8, ease: 'none' });

        // Services rows
        gsap.from('.service-row', {
            y: 40, autoAlpha: 0, duration: 1, ease: 'expo.out', stagger: 0.1,
            scrollTrigger: { trigger: '.services-list', start: 'top 85%' },
        });

        // Month cards
        gsap.from('.month-card', {
            y: 40, autoAlpha: 0, duration: 1, ease: 'expo.out', stagger: 0.08,
            scrollTrigger: { trigger: '#availability', start: 'top 70%' },
        });

        // Horizontal series (desktop)
        const mm = gsap.matchMedia();
        mm.add('(min-width: 1024px)', () => {
            const track = document.querySelector('.series__track');
            const distance = () => track.scrollWidth - window.innerWidth;
            gsap.to(track, {
                x: () => -distance(),
                ease: 'none',
                scrollTrigger: {
                    trigger: '.series',
                    start: 'top top',
                    end: () => '+=' + distance(),
                    pin: '.series__pin',
                    scrub: 1,
                    invalidateOnRefresh: true,
                },
            });
        });
    }

    /* ---------- Header: hide on scroll down, active links ---------- */
    const $header = $('.site-header');
    const $wa = $('.wa-float');
    let lastY = 0;

    function updateHeader(y) {
        $header.toggleClass('is-scrolled', y > 40);
        $header.toggleClass('is-hidden', y > lastY && y > 400 && !$body.hasClass('menu-open'));
        $wa.toggleClass('is-visible', y > 600);
        lastY = y;
    }

    function initHeader() {
        ScrollTrigger.create({
            start: 0,
            end: 'max',
            onUpdate: (self) => updateHeader(self.scroll()),
        });

        $('main section[id]').each(function () {
            const id = this.id;
            ScrollTrigger.create({
                trigger: this,
                start: 'top 50%',
                end: 'bottom 50%',
                onToggle(self) {
                    if (self.isActive) {
                        $('.nav-link').removeClass('is-active');
                        $(`.nav-link[href="#${id}"]`).addClass('is-active');
                    }
                },
            });
        });
    }

    /* ---------- Navigation ---------- */
    function closeMenu() {
        $body.removeClass('menu-open');
        $('.menu-toggle').attr({ 'aria-expanded': 'false', 'aria-label': 'Open menu' });
        $('.mobile-menu').attr('aria-hidden', 'true');
        lockScroll(false);
    }

    $('.menu-toggle').on('click', function () {
        const open = !$body.hasClass('menu-open');
        if (!open) return closeMenu();
        $body.addClass('menu-open');
        $(this).attr({ 'aria-expanded': 'true', 'aria-label': 'Close menu' });
        $('.mobile-menu').attr('aria-hidden', 'false');
        lockScroll(true);
    });

    $(document).on('click', '.js-scroll', function (e) {
        const href = $(this).attr('href');
        if (!href || href.charAt(0) !== '#') return;
        e.preventDefault();
        if ($body.hasClass('menu-open')) {
            closeMenu();
            setTimeout(() => scrollToTarget(href), 350);
        } else {
            scrollToTarget(href);
        }
    });

    /* ---------- Cursor & magnetic buttons ---------- */
    function initCursor() {
        if (!finePointer || reduceMotion) return;
        const $cursor = $('.cursor');
        const dotX = gsap.quickTo('.cursor__dot', 'x', { duration: 0.1 });
        const dotY = gsap.quickTo('.cursor__dot', 'y', { duration: 0.1 });
        const ringX = gsap.quickTo('.cursor__ring', 'x', { duration: 0.45, ease: 'power3' });
        const ringY = gsap.quickTo('.cursor__ring', 'y', { duration: 0.45, ease: 'power3' });

        $(window).on('mousemove', (e) => {
            $cursor.addClass('is-active');
            dotX(e.clientX); dotY(e.clientY);
            ringX(e.clientX); ringY(e.clientY);
        });

        $(document)
            .on('mouseenter', 'a, button, label.choice, .filter-btn', () => $cursor.addClass('is-hover'))
            .on('mouseleave', 'a, button, label.choice, .filter-btn', () => $cursor.removeClass('is-hover'))
            .on('mouseenter', '[data-cursor]', function () {
                $('.cursor__label').text($(this).data('cursor'));
                $cursor.addClass('is-view');
            })
            .on('mouseleave', '[data-cursor]', () => $cursor.removeClass('is-view'))
            .on('mouseleave', () => $cursor.removeClass('is-active'));

        $('.magnetic').each(function () {
            const el = this;
            const xTo = gsap.quickTo(el, 'x', { duration: 0.6, ease: 'power3' });
            const yTo = gsap.quickTo(el, 'y', { duration: 0.6, ease: 'power3' });
            $(el)
                .on('mousemove', (e) => {
                    const r = el.getBoundingClientRect();
                    xTo((e.clientX - (r.left + r.width / 2)) * 0.3);
                    yTo((e.clientY - (r.top + r.height / 2)) * 0.3);
                })
                .on('mouseleave', () => { xTo(0); yTo(0); });
        });
    }

    /* ---------- Service hover preview ---------- */
    function initServicePreview() {
        if (!finePointer || reduceMotion) return;
        const $preview = $('.service-preview');
        const $img = $preview.find('img');
        gsap.set($preview[0], { xPercent: -50, yPercent: -50, scale: 0.7 });
        const xTo = gsap.quickTo($preview[0], 'x', { duration: 0.6, ease: 'power3' });
        const yTo = gsap.quickTo($preview[0], 'y', { duration: 0.6, ease: 'power3' });

        $('.service-row')
            .on('mouseenter', function () {
                $img.attr('src', $(this).data('img'));
                $preview.addClass('is-visible');
                gsap.to($preview[0], { scale: 1, rotate: gsap.utils.random(-6, 6), duration: 0.6, ease: 'expo.out' });
            })
            .on('mouseleave', () => {
                $preview.removeClass('is-visible');
                gsap.to($preview[0], { scale: 0.7, duration: 0.4 });
            })
            .on('mousemove', (e) => { xTo(e.clientX); yTo(e.clientY); });
    }

    /* ---------- Gallery filter ---------- */
    $('.filter-btn').on('click', function () {
        const filter = $(this).data('filter');
        $('.filter-btn').removeClass('is-active').attr('aria-selected', 'false');
        $(this).addClass('is-active').attr('aria-selected', 'true');

        const $items = $('.gallery-item');
        gsap.to($items.get(), {
            autoAlpha: 0, y: 30, duration: 0.35, ease: 'power2.in', stagger: 0.01,
            onComplete() {
                $items.each(function () {
                    $(this).toggleClass('is-hidden', filter !== 'all' && $(this).data('cat') !== filter);
                });
                gsap.fromTo($items.not('.is-hidden').get(), { autoAlpha: 0, y: 50 }, {
                    autoAlpha: 1, y: 0, duration: 0.9, ease: 'expo.out', stagger: 0.05,
                });
                ScrollTrigger.refresh();
            },
        });
    });

    /* ---------- Lightbox ---------- */
    const $lb = $('.lightbox');
    const $lbImg = $lb.find('img');
    let lbList = [];
    let lbIndex = 0;

    function showImage(i) {
        lbIndex = (i + lbList.length) % lbList.length;
        const item = lbList[lbIndex];
        $lbImg.removeClass('is-loaded');
        const pre = new Image();
        pre.onload = () => $lbImg.attr({ src: item.src, alt: item.alt }).addClass('is-loaded');
        pre.src = item.src;
        $lb.find('.lightbox__cap .font-display').text(item.title);
        $lb.find('.lightbox__count').text(`${String(lbIndex + 1).padStart(2, '0')} / ${String(lbList.length).padStart(2, '0')}`);
    }

    function openLightbox(clicked) {
        lbList = $('.gallery-item').not('.is-hidden').map(function () {
            const $img = $(this).find('img');
            return { src: $(this).find('a').attr('href'), alt: $img.attr('alt'), title: $(this).find('.gallery-cap .font-display').text(), el: this };
        }).get();
        const start = lbList.findIndex((it) => it.el === clicked);
        $lb.addClass('is-open').attr('aria-hidden', 'false');
        lockScroll(true);
        showImage(Math.max(start, 0));
        $lb.find('.lightbox__close').trigger('focus');
    }

    function closeLightbox() {
        $lb.removeClass('is-open').attr('aria-hidden', 'true');
        lockScroll(false);
    }

    $('.gallery-link').on('click', function (e) {
        e.preventDefault();
        openLightbox($(this).closest('.gallery-item')[0]);
    });
    $lb.find('.lightbox__close').on('click', closeLightbox);
    $lb.find('.lightbox__prev').on('click', () => showImage(lbIndex - 1));
    $lb.find('.lightbox__next').on('click', () => showImage(lbIndex + 1));
    $lb.on('click', function (e) { if (e.target === this) closeLightbox(); });

    $(document).on('keydown', (e) => {
        if (e.key === 'Escape') {
            if ($lb.hasClass('is-open')) closeLightbox();
            else if ($body.hasClass('menu-open')) closeMenu();
        }
        if (!$lb.hasClass('is-open')) return;
        if (e.key === 'ArrowRight') showImage(lbIndex + 1);
        if (e.key === 'ArrowLeft') showImage(lbIndex - 1);
    });

    let touchX = null;
    $lb.on('touchstart', (e) => { touchX = e.originalEvent.touches[0].clientX; })
        .on('touchend', (e) => {
            if (touchX === null) return;
            const dx = e.originalEvent.changedTouches[0].clientX - touchX;
            if (Math.abs(dx) > 50) showImage(lbIndex + (dx < 0 ? 1 : -1));
            touchX = null;
        });

    /* ---------- Contact form → WhatsApp ---------- */
    const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);
        const $status = $form.find('.form-status');
        const data = Object.fromEntries(new FormData(this).entries());
        Object.keys(data).forEach((k) => { data[k] = String(data[k]).trim(); });

        if (data.website) return; // honeypot

        const errors = {};
        if (data.name.length < 2) errors.name = 'Please enter your name.';
        if (!emailRe.test(data.email)) errors.email = 'Please enter a valid email.';
        if (data.message.length < 10) errors.message = 'Please tell a little more (min. 10 characters).';

        $form.find('.field').removeClass('has-error').find('.field-error').text('');
        $.each(errors, (field, msg) => {
            $form.find(`[name="${field}"]`).closest('.field').addClass('has-error').find('.field-error').text(msg);
        });
        if (Object.keys(errors).length) {
            $status.removeClass('is-ok').addClass('is-error').text('Please check the highlighted fields.');
            return;
        }

        const lines = [`Hi ${window.SITE.name}! Booking enquiry from your website:`, ''];
        lines.push(`*Name:* ${data.name}`);
        if (data.company) lines.push(`*Agency / Brand:* ${data.company}`);
        lines.push(`*Email:* ${data.email}`);
        lines.push(`*Project:* ${data.type}`);
        if (data.date) lines.push(`*Date:* ${data.date}`);
        lines.push('', data.message);

        const url = `https://wa.me/${window.SITE.whatsapp}?text=${encodeURIComponent(lines.join('\n'))}`;

        // Open WhatsApp straight from the click so popup blockers allow it.
        const win = window.open(url, '_blank');
        if (!win) window.location.href = url;

        // Keep a copy of the enquiry on the server.
        $.ajax({ url: 'contact.php', method: 'POST', data, dataType: 'json' }).catch(() => {});

        $status.removeClass('is-error').addClass('is-ok').text('Thank you! WhatsApp has opened with your message — just press send.');
        this.reset();
        $form.find('#f-date').attr('type', 'text');
    });

    $('#contactForm').on('input', 'input, textarea', function () {
        $(this).closest('.field').removeClass('has-error').find('.field-error').text('');
    });

    /* ---------- Boot ---------- */
    // Recalculate trigger positions as lazy images arrive.
    let refreshTimer;
    $('img[loading="lazy"]').on('load', () => {
        clearTimeout(refreshTimer);
        refreshTimer = setTimeout(() => ScrollTrigger.refresh(), 200);
    });

    initScrollAnimations();
    initHeader();
    initCursor();
    initServicePreview();
    runPreloader();
})(jQuery);
