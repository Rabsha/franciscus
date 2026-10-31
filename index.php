<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/icons.php';
$img = 'assets/img/';
$nav = ['about' => 'About', 'portfolio' => 'Portfolio', 'series' => 'Series', 'availability' => 'Availability', 'contact' => 'Contact'];
$filters = ['all' => 'All', 'editorial' => 'Editorial', 'fashion' => 'Fashion', 'portrait' => 'Portrait', 'swim' => 'Swim'];
$statusLabel = ['available' => 'Available', 'limited' => 'Limited', 'booked' => 'Booked'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($site['name']) ?> — <?= e($site['role']) ?> · <?= e($site['base']) ?></title>
    <meta name="description" content="Official portfolio of <?= e($site['name']) ?>, a Dutch fashion and editorial model based in <?= e($site['base']) ?>. Available for editorial, commercial, campaign and runway bookings.">
    <meta property="og:title" content="<?= e($site['name']) ?> — Model">
    <meta property="og:description" content="Editorial, commercial and runway model based in <?= e($site['base']) ?>.">
    <meta property="og:image" content="<?= $img ?>fc-02.jpg">
    <meta name="theme-color" content="#0c0b0a">
    <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter+Tight:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="<?= $img ?>fc-02.jpg">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4.1.11"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-ink: #0c0b0a;
            --color-coal: #161412;
            --color-ash: #24211d;
            --color-bone: #efe8dc;
            --color-mute: #8d867b;
            --color-sand: #c9a46c;
            --font-display: "Instrument Serif", Georgia, serif;
            --font-sans: "Inter Tight", system-ui, sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lenis@1.3.4/dist/lenis.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <noscript><style>.preloader{display:none}.cursor{display:none}</style></noscript>
</head>
<body class="bg-ink text-bone font-sans antialiased">

<!-- Preloader -->
<div class="preloader" aria-hidden="true">
    <div class="preloader__inner">
        <div class="preloader__logo"><?= logo_mark('w-20 h-20 md:w-24 md:h-24') ?></div>
        <div class="preloader__name font-display">Franciscus Cornelis</div>
    </div>
    <div class="preloader__count font-display"><span>0</span>%</div>
    <div class="preloader__bar"><span></span></div>
</div>

<!-- Cursor -->
<div class="cursor" aria-hidden="true"><div class="cursor__dot"></div><div class="cursor__ring"><span class="cursor__label">View</span></div></div>
<div class="grain" aria-hidden="true"></div>
<div class="progress" aria-hidden="true"><span></span></div>

<!-- Header -->
<header class="site-header fixed inset-x-0 top-0 z-50">
    <div class="mx-auto flex max-w-[1600px] items-center justify-between px-5 py-4 md:px-10 md:py-6">
        <a href="#top" class="js-scroll flex items-center gap-3 text-bone" aria-label="<?= e($site['name']) ?> — home">
            <?= logo_mark('w-10 h-10 md:w-11 md:h-11') ?>
            <span class="hidden sm:flex flex-col leading-none">
                <span class="font-display text-xl tracking-wide"><?= e($site['name']) ?></span>
                <span class="mt-1 text-[10px] uppercase tracking-[0.35em] text-mute"><?= e($site['role']) ?> · NL</span>
            </span>
        </a>
        <nav class="hidden lg:block" aria-label="Main">
            <ul class="flex items-center gap-9 text-[13px] uppercase tracking-[0.2em]">
                <?php foreach ($nav as $id => $label): ?>
                    <li><a href="#<?= $id ?>" class="js-scroll nav-link"><?= $label ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="flex items-center gap-3">
            <a href="#contact" class="js-scroll btn-pill magnetic hidden md:inline-flex"><span>Book now</span><?= icon('arrow', 'w-4 h-4') ?></a>
            <button class="menu-toggle lg:hidden" aria-label="Open menu" aria-expanded="false"><span></span><span></span></button>
        </div>
    </div>
</header>

<!-- Mobile menu -->
<div class="mobile-menu" aria-hidden="true">
    <nav class="flex h-full flex-col justify-between px-6 pb-10 pt-28">
        <ul class="space-y-2">
            <?php $n = 1; foreach ($nav as $id => $label): ?>
                <li class="overflow-hidden"><a href="#<?= $id ?>" class="js-scroll mobile-link font-display text-[13vw] leading-[1.05] sm:text-7xl"><sup class="mr-3 font-sans text-xs text-sand">0<?= $n++ ?></sup><?= $label ?></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="flex items-end justify-between text-sm text-mute">
            <div>
                <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="block text-bone"><?= e($site['phone']) ?></a>
                <span><?= e($site['base']) ?></span>
            </div>
            <div class="flex gap-3">
                <?php foreach ($socials as $s): ?>
                    <a href="<?= e($s['url']) ?>" target="_blank" rel="noopener" class="social-icon" aria-label="<?= e($s['name']) ?>"><?= icon($s['icon']) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>
</div>

<main id="top">

    <!-- HERO -->
    <section class="hero relative flex min-h-[100svh] flex-col overflow-hidden px-5 pb-6 pt-28 md:px-10 md:pt-32">
        <div class="hero__glow" aria-hidden="true"></div>

        <div class="relative z-10 flex items-start justify-between text-[11px] uppercase tracking-[0.3em] text-mute">
            <span class="hero-meta">(Portfolio — <?= date('Y') ?>)</span>
            <span class="hero-meta hidden md:block">52.37° N, 4.90° E</span>
        </div>

        <div class="relative flex flex-1 items-center justify-center py-8">
            <h1 class="hero__title font-display pointer-events-none relative z-20 w-full text-center leading-[0.82]">
                <span class="hero__line block" data-split><?= e($site['first']) ?></span>
                <span class="hero__line block italic text-sand md:pl-[22vw]" data-split><?= e($site['last']) ?></span>
            </h1>

            <figure class="hero__figure absolute z-10">
                <div class="hero__img-wrap">
                    <img src="<?= $img ?>fc-02.jpg" alt="<?= e($site['name']) ?> — black and white editorial portrait" class="hero__img" fetchpriority="high">
                </div>
                <div class="hero__badge" aria-hidden="true">
                    <svg viewBox="0 0 200 200" class="badge-text">
                        <defs><path id="circle" d="M100,100 m-78,0 a78,78 0 1,1 156,0 a78,78 0 1,1 -156,0"/></defs>
                        <text><textPath href="#circle">FRANCISCUS CORNELIS • MODEL • HOLLAND • </textPath></text>
                    </svg>
                    <span class="hero__badge-center"><?= logo_mark('w-12 h-12') ?></span>
                </div>
            </figure>

            <img src="<?= $img ?>fc-31.jpg" alt="" aria-hidden="true" class="hero__float hero__float--a" data-speed="-0.25">
            <img src="<?= $img ?>fc-14.jpg" alt="" aria-hidden="true" class="hero__float hero__float--b" data-speed="0.35">
        </div>

        <div class="relative z-10 grid grid-cols-2 items-end gap-4 md:grid-cols-3">
            <p class="hero-meta max-w-xs text-sm leading-relaxed text-bone/70">
                Dutch fashion &amp; editorial model.<br>Based in <?= e($site['base']) ?> — working worldwide.
            </p>
            <a href="#about" class="js-scroll hero-meta scroll-cue hidden justify-self-center md:flex" aria-label="Scroll down">
                <span class="text-[10px] uppercase tracking-[0.35em] text-mute">Scroll</span><span class="scroll-cue__line"></span>
            </a>
            <div class="hero-meta justify-self-end text-right">
                <span class="status-pill"><span class="pulse"></span>Available for bookings</span>
            </div>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee border-y border-white/10 py-5 md:py-7" aria-hidden="true">
        <div class="marquee__track font-display text-4xl md:text-6xl">
            <?php for ($i = 0; $i < 2; $i++): ?>
                <span>Editorial</span><span class="star">✦</span><span class="italic text-sand">Commercial</span><span class="star">✦</span>
                <span>Campaign</span><span class="star">✦</span><span class="italic text-sand">Runway</span><span class="star">✦</span>
                <span>Swim &amp; Fit</span><span class="star">✦</span><span class="italic text-sand">Lookbook</span><span class="star">✦</span>
            <?php endfor; ?>
        </div>
    </div>

    <!-- ABOUT -->
    <section id="about" class="relative px-5 py-24 md:px-10 md:py-40">
        <div class="mx-auto grid max-w-[1600px] gap-14 lg:grid-cols-12 lg:gap-10">
            <div class="lg:col-span-5">
                <div class="about-images relative">
                    <div class="reveal-img aspect-[4/5] w-[82%] overflow-hidden rounded-sm">
                        <img src="<?= $img ?>fc-13.jpg" alt="<?= e($site['first']) ?> smiling, black and white portrait" loading="lazy" class="h-full w-full object-cover" data-parallax-img>
                    </div>
                    <div class="reveal-img absolute -bottom-10 right-0 aspect-[3/4] w-[46%] overflow-hidden rounded-sm border-[6px] border-ink md:-bottom-16">
                        <img src="<?= $img ?>fc-23.jpg" alt="<?= e($site['first']) ?> studio portrait" loading="lazy" class="h-full w-full object-cover" data-parallax-img>
                    </div>
                    <span class="vertical-label hidden md:block">Est. Holland — Model since 2021</span>
                </div>
            </div>

            <div class="lg:col-span-7 lg:pl-10">
                <p class="eyebrow" data-reveal><span>(01)</span> About</p>
                <h2 class="about-statement font-display mt-6 text-[9vw] leading-[1.02] sm:text-5xl md:text-6xl xl:text-7xl" data-words>
                    A face from the Dutch coast with a quiet intensity — moving easily between <em class="text-sand">raw editorial</em> and clean commercial work.
                </h2>
                <div class="mt-10 grid gap-8 text-[15px] leading-relaxed text-bone/70 md:grid-cols-2" data-reveal>
                    <p><?= e($site['first']) ?> grew up between the dunes and the city, and it shows in his work: relaxed, natural and always present in front of the lens. He has worked with photographers, stylists and brands across the Netherlands and Europe.</p>
                    <p>Comfortable on set, quick to take direction and easy to collaborate with, he brings energy to editorials, campaigns, lookbooks and runway. Open for international bookings and travel.</p>
                </div>

                <div class="mt-14" data-reveal>
                    <div class="mb-5 flex items-center justify-between">
                        <h3 class="text-[11px] uppercase tracking-[0.35em] text-mute">Comp card</h3>
                        <span class="text-[11px] uppercase tracking-[0.35em] text-mute">Metric</span>
                    </div>
                    <dl class="comp-grid grid grid-cols-2 sm:grid-cols-4">
                        <?php foreach ($measurements as $k => $v): ?>
                            <div class="comp-cell"><dt><?= e($k) ?></dt><dd class="font-display"><?= e($v) ?></dd></div>
                        <?php endforeach; ?>
                    </dl>
                </div>

                <div class="mt-12 flex flex-wrap gap-4" data-reveal>
                    <a href="#contact" class="js-scroll btn-solid magnetic"><span>Book <?= e($site['first']) ?></span><?= icon('arrow', 'w-4 h-4') ?></a>
                    <a href="<?= e($socials[0]['url']) ?>" target="_blank" rel="noopener" class="btn-pill magnetic"><?= icon('instagram', 'w-4 h-4') ?><span>Instagram</span></a>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-28 grid max-w-[1600px] grid-cols-2 gap-px overflow-hidden rounded-sm border border-white/10 bg-white/10 md:mt-40 md:grid-cols-4">
            <?php foreach ([['50', '+', 'Shoots & editorials'], ['24', '+', 'Brands worked with'], ['6', '', 'Countries'], ['5', '', 'Years experience']] as $st): ?>
                <div class="stat bg-ink p-6 md:p-10">
                    <div class="font-display text-5xl md:text-7xl"><span class="counter" data-to="<?= $st[0] ?>">0</span><span class="text-sand"><?= $st[1] ?></span></div>
                    <p class="mt-2 text-[11px] uppercase tracking-[0.3em] text-mute"><?= $st[2] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- PORTFOLIO -->
    <section id="portfolio" class="bg-coal px-5 py-24 md:px-10 md:py-36">
        <div class="mx-auto max-w-[1600px]">
            <div class="flex flex-col justify-between gap-8 md:flex-row md:items-end">
                <div>
                    <p class="eyebrow" data-reveal><span>(02)</span> Portfolio</p>
                    <h2 class="section-title font-display mt-5" data-split>Selected <em class="text-sand">work</em></h2>
                </div>
                <div class="filters flex flex-wrap gap-2" role="tablist" aria-label="Filter portfolio" data-reveal>
                    <?php foreach ($filters as $key => $label): ?>
                        <button class="filter-btn<?= $key === 'all' ? ' is-active' : '' ?>" data-filter="<?= $key ?>" role="tab" aria-selected="<?= $key === 'all' ? 'true' : 'false' ?>"><?= $label ?></button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="gallery mt-14 columns-2 gap-3 md:columns-3 md:gap-5 xl:columns-4">
                <?php foreach ($gallery as $i => $g): $dim = @getimagesize(__DIR__ . '/' . $img . $g['src']); ?>
                    <figure class="gallery-item mb-3 break-inside-avoid md:mb-5" data-cat="<?= $g['cat'] ?>" data-index="<?= $i ?>">
                        <a href="<?= $img . $g['src'] ?>" class="gallery-link block overflow-hidden rounded-sm" data-cursor="View" aria-label="Open <?= e($g['title']) ?>">
                            <img src="<?= $img . $g['src'] ?>" alt="<?= e($site['name']) ?> — <?= e($g['title']) ?>" <?= $dim ? $dim[3] : '' ?> loading="lazy" class="h-auto w-full">
                            <figcaption class="gallery-cap">
                                <span class="font-display text-xl md:text-2xl"><?= e($g['title']) ?></span>
                                <span class="text-[10px] uppercase tracking-[0.3em] text-bone/70"><?= ucfirst($g['cat']) ?></span>
                            </figcaption>
                        </a>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SERIES (horizontal) -->
    <section id="series" class="series relative overflow-hidden">
        <div class="series__pin flex min-h-[100svh] flex-col justify-center py-24">
            <div class="mb-10 flex items-end justify-between px-5 md:px-10">
                <div>
                    <p class="eyebrow"><span>(03)</span> Series</p>
                    <h2 class="section-title font-display mt-5">Stories in <em class="text-sand">frames</em></h2>
                </div>
                <p class="hidden max-w-xs text-sm text-mute md:block">A selection of recent shoots — from windswept dunes to the studio floor.</p>
            </div>
            <div class="series__track flex gap-4 px-5 md:gap-8 md:px-10">
                <?php foreach ($series as $s): ?>
                    <article class="series-card group">
                        <div class="series-card__img overflow-hidden rounded-sm">
                            <img src="<?= $img . $s['img'] ?>" alt="<?= e($s['title']) ?> series" loading="lazy">
                        </div>
                        <div class="mt-4 flex flex-col gap-1 sm:flex-row sm:items-baseline sm:justify-between sm:gap-4">
                            <h3 class="font-display text-2xl md:text-4xl"><span class="mr-3 align-top font-sans text-xs text-sand"><?= $s['no'] ?></span><?= e($s['title']) ?></h3>
                            <span class="shrink-0 text-[10px] uppercase tracking-[0.25em] text-mute"><?= e($s['meta']) ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
                <div class="series-end flex shrink-0 flex-col justify-center pr-5 md:pr-10">
                    <p class="font-display text-4xl md:text-6xl">More on<br><em class="text-sand">Instagram</em></p>
                    <a href="<?= e($socials[0]['url']) ?>" target="_blank" rel="noopener" class="btn-pill magnetic mt-6 self-start"><?= icon('instagram', 'w-4 h-4') ?><span>@franciscusbalemans</span></a>
                </div>
            </div>
        </div>
    </section>

    <!-- QUOTE -->
    <section class="quote relative flex min-h-[90svh] items-center justify-center overflow-hidden px-5">
        <img src="<?= $img ?>fc-09.jpg" alt="" aria-hidden="true" class="quote__bg absolute inset-0 h-full w-full object-cover" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink/40 to-ink"></div>
        <blockquote class="relative z-10 text-center">
            <p class="font-display text-[14vw] leading-[0.9] md:text-[9vw]" data-split>Presence</p>
            <p class="font-display text-[14vw] italic leading-[0.9] text-sand md:text-[9vw]" data-split>over pose.</p>
            <footer class="mt-8 text-[11px] uppercase tracking-[0.4em] text-bone/60" data-reveal>— <?= e($site['name']) ?></footer>
        </blockquote>
    </section>

    <!-- SERVICES -->
    <section id="services" class="px-5 py-24 md:px-10 md:py-36">
        <div class="mx-auto max-w-[1600px]">
            <div class="mb-14 flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <p class="eyebrow" data-reveal><span>(04)</span> Expertise</p>
                    <h2 class="section-title font-display mt-5" data-split>What I <em class="text-sand">do</em></h2>
                </div>
                <p class="max-w-sm text-sm text-mute" data-reveal>From concept editorials to commercial campaigns — every booking gets the same focus and professionalism.</p>
            </div>
            <ul class="services-list border-t border-white/10">
                <?php foreach ($services as $i => $s): ?>
                    <li class="service-row" data-img="<?= $img . $s['img'] ?>">
                        <a href="#contact" class="js-scroll grid grid-cols-[auto_1fr] items-center gap-5 py-7 md:grid-cols-[80px_1fr_1fr_auto] md:gap-8 md:py-10">
                            <span class="text-xs text-sand">0<?= $i + 1 ?></span>
                            <span class="service-title font-display text-4xl md:text-7xl"><?= e($s['title']) ?></span>
                            <span class="col-span-2 text-sm text-mute md:col-span-1"><?= e($s['desc']) ?></span>
                            <span class="service-arrow hidden md:flex"><?= icon('arrow', 'w-5 h-5') ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="service-preview" aria-hidden="true"><img src="" alt=""></div>
    </section>

    <!-- AVAILABILITY -->
    <section id="availability" class="bg-coal px-5 py-24 md:px-10 md:py-36">
        <div class="mx-auto grid max-w-[1600px] gap-14 lg:grid-cols-12">
            <div class="lg:col-span-7">
                <p class="eyebrow" data-reveal><span>(05)</span> Availability</p>
                <h2 class="section-title font-display mt-5" data-split>Open for <em class="text-sand">bookings</em></h2>
                <p class="mt-6 max-w-lg text-[15px] leading-relaxed text-bone/70" data-reveal>Check the upcoming months below. Dates fill up quickly during fashion weeks — send an option request early and it will be confirmed within 24 hours.</p>

                <div class="mt-12 grid grid-cols-2 gap-3 sm:grid-cols-3">
                    <?php foreach ($availability as $a): ?>
                        <div class="month-card is-<?= $a['status'] ?>">
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] uppercase tracking-[0.3em] text-mute"><?= $a['year'] ?></span>
                                <span class="dot"></span>
                            </div>
                            <div class="mt-6 font-display text-4xl md:text-5xl"><?= $a['month'] ?></div>
                            <div class="month-status mt-1 text-[11px] uppercase tracking-[0.25em]"><?= $statusLabel[$a['status']] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 flex flex-wrap gap-5 text-[11px] uppercase tracking-[0.25em] text-mute" data-reveal>
                    <span class="legend is-available"><span class="dot"></span>Available</span>
                    <span class="legend is-limited"><span class="dot"></span>Limited</span>
                    <span class="legend is-booked"><span class="dot"></span>Booked</span>
                </div>

                <div class="mt-12" data-reveal>
                    <h3 class="mb-4 text-[11px] uppercase tracking-[0.35em] text-mute">Works in</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($locations as $l): ?>
                            <span class="chip"><?= icon('pin', 'w-3.5 h-3.5') ?><?= e($l) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5">
                <div class="reveal-img relative aspect-[4/5] overflow-hidden rounded-sm">
                    <img src="<?= $img ?>fc-29.jpg" alt="<?= e($site['first']) ?> laughing in a trench coat" loading="lazy" class="h-full w-full object-cover" data-parallax-img>
                    <div class="absolute inset-x-4 bottom-4 flex items-center justify-between rounded-sm bg-ink/70 p-4 backdrop-blur-md md:inset-x-6 md:bottom-6">
                        <div>
                            <p class="text-[10px] uppercase tracking-[0.3em] text-mute">Current status</p>
                            <p class="mt-1 font-display text-2xl">Available now</p>
                        </div>
                        <span class="pulse pulse--lg"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="relative overflow-hidden px-5 py-24 md:px-10 md:py-36">
        <div class="mx-auto max-w-[1600px]">
            <p class="eyebrow" data-reveal><span>(06)</span> Contact</p>
            <h2 class="contact-title font-display mt-5" data-split>Let’s create</h2>
            <h2 class="contact-title font-display italic text-sand md:pl-[12vw]" data-split>something.</h2>

            <div class="mt-16 grid gap-14 lg:grid-cols-12 lg:gap-20">
                <form id="contactForm" class="lg:col-span-7" novalidate data-reveal>
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
                    <div class="grid gap-x-8 gap-y-2 md:grid-cols-2">
                        <div class="field"><input id="f-name" name="name" type="text" placeholder=" " required autocomplete="name"><label for="f-name">Your name *</label><span class="field-error"></span></div>
                        <div class="field"><input id="f-company" name="company" type="text" placeholder=" " autocomplete="organization"><label for="f-company">Agency / Brand</label></div>
                        <div class="field"><input id="f-email" name="email" type="email" placeholder=" " required autocomplete="email"><label for="f-email">Email *</label><span class="field-error"></span></div>
                        <div class="field"><input id="f-date" name="date" type="text" placeholder=" " onfocus="this.type='date'" onblur="if(!this.value)this.type='text'"><label for="f-date">Shoot date</label></div>
                    </div>
                    <fieldset class="mt-8">
                        <legend class="mb-4 text-[11px] uppercase tracking-[0.3em] text-mute">Project type</legend>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach (['Editorial', 'Commercial', 'Campaign', 'Runway', 'Swim & Fit', 'Other'] as $i => $t): ?>
                                <label class="choice"><input type="radio" name="type" value="<?= e($t) ?>"<?= $i === 0 ? ' checked' : '' ?>><span><?= e($t) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>
                    <div class="field mt-6"><textarea id="f-message" name="message" rows="4" placeholder=" " required></textarea><label for="f-message">Tell me about the project *</label><span class="field-error"></span></div>

                    <div class="mt-10 flex flex-wrap items-center gap-6">
                        <button type="submit" class="btn-solid btn-lg magnetic"><?= icon('whatsapp', 'w-5 h-5') ?><span>Send via WhatsApp</span></button>
                        <p class="max-w-xs text-xs leading-relaxed text-mute">Your message opens in WhatsApp, ready to send to <span class="whitespace-nowrap"><?= e($site['phone']) ?></span>.</p>
                    </div>
                    <p class="form-status mt-6 text-sm" role="status" aria-live="polite"></p>
                </form>

                <aside class="space-y-10 lg:col-span-5" data-reveal>
                    <div class="contact-card">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-mute">Direct bookings</p>
                        <a href="tel:<?= e(str_replace(' ', '', $site['phone'])) ?>" class="contact-big font-display"><?= e($site['phone']) ?></a>
                        <a href="https://wa.me/<?= e($site['whatsapp']) ?>" target="_blank" rel="noopener" class="mt-5 inline-flex items-center gap-2 text-sm text-sand hover:text-bone"><?= icon('whatsapp', 'w-4 h-4') ?> Chat on WhatsApp</a>
                    </div>
                    <div class="contact-card">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-mute">Email</p>
                        <a href="mailto:<?= e($site['email']) ?>" class="contact-big font-display break-words text-[clamp(1.35rem,2.3vw,2.25rem)]"><?= e($site['email']) ?></a>
                    </div>
                    <div class="contact-card">
                        <p class="text-[11px] uppercase tracking-[0.3em] text-mute">Based in</p>
                        <p class="contact-big font-display"><?= e($site['base']) ?></p>
                    </div>
                    <div class="flex gap-3">
                        <?php foreach ($socials as $s): ?>
                            <a href="<?= e($s['url']) ?>" target="_blank" rel="noopener" class="social-icon social-icon--lg magnetic" aria-label="<?= e($s['name']) ?>"><?= icon($s['icon']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>

<!-- FOOTER -->
<footer class="border-t border-white/10 px-5 pt-16 md:px-10">
    <div class="mx-auto max-w-[1600px]">
        <div class="flex flex-col justify-between gap-10 md:flex-row md:items-start">
            <div class="flex items-center gap-4">
                <?= logo_mark('w-14 h-14') ?>
                <div>
                    <p class="font-display text-2xl"><?= e($site['name']) ?></p>
                    <p class="text-[11px] uppercase tracking-[0.3em] text-mute"><?= e($site['role']) ?> — <?= e($site['base']) ?></p>
                </div>
            </div>
            <ul class="grid grid-cols-2 gap-x-12 gap-y-3 text-sm text-bone/70">
                <?php foreach ($nav as $id => $label): ?>
                    <li><a href="#<?= $id ?>" class="js-scroll nav-link"><?= $label ?></a></li>
                <?php endforeach; ?>
                <li><a href="<?= e($socials[0]['url']) ?>" target="_blank" rel="noopener" class="nav-link">Instagram</a></li>
            </ul>
            <a href="#top" class="js-scroll to-top magnetic" aria-label="Back to top"><?= icon('arrow-up', 'w-5 h-5') ?></a>
        </div>
        <p class="footer-name font-display mt-16 select-none text-center leading-[0.8]" aria-hidden="true">Franciscus<em class="text-sand">.</em></p>
        <div class="flex flex-col items-center justify-between gap-3 border-t border-white/10 pb-24 pt-6 text-center text-[11px] uppercase tracking-[0.25em] text-mute md:flex-row md:pb-6 md:pr-20 md:text-left">
            <span>© <?= date('Y') ?> <?= e($site['name']) ?>. All rights reserved.</span>
            <span>Photography © respective photographers</span>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp -->
<a href="https://wa.me/<?= e($site['whatsapp']) ?>" target="_blank" rel="noopener" class="wa-float" aria-label="Chat on WhatsApp"><?= icon('whatsapp', 'w-6 h-6') ?></a>

<!-- Lightbox -->
<div class="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer" aria-hidden="true">
    <button class="lightbox__close" aria-label="Close"><?= icon('close', 'w-6 h-6') ?></button>
    <button class="lightbox__nav lightbox__prev" aria-label="Previous image"><?= icon('prev', 'w-6 h-6') ?></button>
    <figure class="lightbox__figure">
        <img src="" alt="">
        <figcaption class="lightbox__cap"><span class="font-display text-2xl"></span><span class="lightbox__count text-[11px] uppercase tracking-[0.3em] text-mute"></span></figcaption>
    </figure>
    <button class="lightbox__nav lightbox__next" aria-label="Next image"><?= icon('next', 'w-6 h-6') ?></button>
</div>

<script>window.SITE = <?= json_encode(['whatsapp' => $site['whatsapp'], 'name' => $site['first']]) ?>;</script>
<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.3.4/dist/lenis.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
