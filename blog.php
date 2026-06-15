<?php
$pageTitle = 'Signage SG Blog | Signage Strategy, Compliance and Build Insights';
$navPage = 'blog';
$metaDescription = 'Read Signage SG insights on signage planning, compliance, fabrication timing, material choices, and rollout coordination for commercial projects in Singapore.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/blog';
$ogType = 'article';
$ogImage = 'assets/images/logo.png';
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'Blog',
    'name' => 'Signage SG Blog',
    'description' => $metaDescription,
    'url' => $siteBaseUrl . '/blog',
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Signage SG',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $siteBaseUrl . '/assets/images/logo.png'
        ]
    ],
    'inLanguage' => 'en-SG',
    'about' => [
        ['@type' => 'Thing', 'name' => 'Signage fabrication'],
        ['@type' => 'Thing', 'name' => 'Commercial signage compliance'],
        ['@type' => 'Thing', 'name' => 'Retail signage planning']
    ]
];
$extraHead = <<<'HTML'
    <style>
        .blog-hero {
            position: relative;
            padding-top: 150px;
            padding-bottom: 96px;
            overflow: hidden;
            border-bottom: 1px solid var(--color-pure-black);
            background:
                linear-gradient(135deg, rgba(0, 0, 0, 0.03) 0%, rgba(0, 0, 0, 0) 52%),
                var(--color-pure-white);
        }

        .blog-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: 0.9;
            pointer-events: none;
        }

        .blog-hero-diagonal {
            position: absolute;
            top: -18%;
            right: -12%;
            width: 34rem;
            height: 34rem;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.07), rgba(0, 0, 0, 0));
            transform: rotate(18deg);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .blog-label {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            border: 1px solid var(--color-pure-black);
            padding: 0.6rem 1rem;
            background: rgba(255, 255, 255, 0.96);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .blog-page-title {
            max-width: 12ch;
            font-size: clamp(2.8rem, 5vw, 4.75rem);
            line-height: 0.98;
        }

        .blog-page-copy {
            max-width: 42rem;
            font-size: 1.05rem;
            line-height: 1.9;
            color: var(--color-dark-gray);
        }

        .blog-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .blog-stat-card,
        .blog-feature-card,
        .blog-article-card,
        .blog-cta-panel,
        .blog-topic-card {
            background: var(--color-pure-white);
            border: 1px solid var(--color-pure-black);
        }

        .blog-stat-card {
            padding: 1.4rem;
        }

        .blog-stat-card strong {
            display: block;
            font-size: 1.9rem;
            font-family: 'Space Grotesk', sans-serif;
        }

        .blog-section {
            padding: 5.5rem 0;
        }

        .blog-section-alt {
            background: var(--color-light-gray);
            border-top: 1px solid var(--color-subtle-border);
            border-bottom: 1px solid var(--color-subtle-border);
        }

        .blog-section-kicker {
            display: inline-block;
            margin-bottom: 1rem;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--color-dark-gray);
        }

        .blog-feature-card,
        .blog-topic-card,
        .blog-article-card,
        .blog-cta-panel {
            padding: 1.75rem;
            height: 100%;
        }

        .blog-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--color-dark-gray);
        }

        .blog-card-title {
            font-size: 1.4rem;
            line-height: 1.2;
            margin-bottom: 0.85rem;
        }

        .blog-card-copy {
            color: var(--color-dark-gray);
            line-height: 1.8;
            margin-bottom: 1.25rem;
        }

        .blog-topic-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .blog-topic-list li {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.9rem 0;
            border-top: 1px solid var(--color-subtle-border);
            font-size: 0.95rem;
        }

        .blog-topic-list li:first-child {
            border-top: 0;
            padding-top: 0;
        }

        .blog-topic-list span:last-child {
            color: var(--color-dark-gray);
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.14em;
            font-weight: 700;
            white-space: nowrap;
        }

        .blog-cta-panel {
            position: relative;
            overflow: hidden;
        }

        .blog-cta-panel::after {
            content: "";
            position: absolute;
            width: 14rem;
            height: 14rem;
            right: -5rem;
            bottom: -5rem;
            border: 1px solid rgba(0, 0, 0, 0.12);
            transform: rotate(24deg);
        }

        @media (max-width: 991.98px) {
            .blog-stat-grid {
                grid-template-columns: 1fr;
            }

            .blog-hero {
                padding-top: 132px;
                padding-bottom: 72px;
            }
        }
    </style>
HTML;
require __DIR__ . '/includes/header.php';
?>

    <header class="blog-hero">
        <div class="blog-hero-diagonal" aria-hidden="true"></div>
        <div class="container position-relative" style="z-index: 1;">
            <div class="row g-5 align-items-end">
                <div class="col-lg-7">
                    <div class="blog-label mb-4">
                        <span class="d-inline-block bg-black rounded-circle" style="width: 8px; height: 8px;"></span>
                        Signage SG Journal
                    </div>
                    <h1 class="blog-page-title mb-4">Field notes for smarter signage decisions.</h1>
                    <p class="blog-page-copy mb-4">
                        Practical articles on fabrication planning, authority submissions, retail rollouts, and material choices for teams delivering signage in Singapore and Johor Bahru.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#latest-articles" class="btn-wb-solid">Read Latest Posts</a>
                        <a href="index.php#quote-form" class="btn-wb-outline">Discuss A Project</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="blog-stat-grid">
                        <div class="blog-stat-card">
                            <strong>4</strong>
                            <span class="text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.14em; font-weight: 700;">Fresh articles</span>
                        </div>
                        <div class="blog-stat-card">
                            <strong>7 min</strong>
                            <span class="text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.14em; font-weight: 700;">Average read</span>
                        </div>
                        <div class="blog-stat-card">
                            <strong>SG + JB</strong>
                            <span class="text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.14em; font-weight: 700;">Regional coverage</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section class="blog-section">
            <div class="container">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-7">
                        <article class="blog-feature-card">
                            <div class="blog-card-meta">
                                <span>Featured</span>
                                <span>Johor Bahru</span>
                                <span>6 min read</span>
                            </div>
                            <h2 class="blog-card-title">3D illuminated signboard vs lightbox: which one is right for your business in Johor Bahru?</h2>
                            <p class="blog-card-copy">
                                A practical comparison of brand impact, price range, visibility, mall requirements, and when each signboard format makes more sense for JB businesses.
                            </p>
                            <a href="blog/3d-signboard-vs-lightbox-jb" class="btn-wb-outline">Read The Full Guide</a>
                        </article>
                    </div>
                    <div class="col-lg-5">
                        <aside class="blog-topic-card">
                            <span class="blog-section-kicker">Popular topics</span>
                            <h2 class="h3 mb-4">What clients usually ask before a rollout.</h2>
                            <ul class="blog-topic-list">
                                <li><span>Material selection for indoor vs outdoor signage</span><span>Build guide</span></li>
                                <li><span>Choosing between illuminated 3D letters and lightboxes</span><span>Design</span></li>
                                <li><span>Planning access, lifts, and installation windows</span><span>Execution</span></li>
                                <li><span>Preparing documentation for landlords and MCSTs</span><span>Compliance</span></li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </section>

        <section id="latest-articles" class="blog-section blog-section-alt">
            <div class="container">
                <span class="blog-section-kicker">Latest articles</span>
                <div class="row g-4">
                    <div class="col-md-6 col-xl-4">
                        <article class="blog-article-card">
                            <div class="blog-card-meta">
                                <span>Johor Bahru</span>
                                <span>6 min read</span>
                            </div>
                            <h2 class="blog-card-title">3D illuminated signboard vs lightbox for JB businesses.</h2>
                            <p class="blog-card-copy">
                                Compare 3D channel letters and lightboxes across price, visual impact, mall fit-out requirements, and practical SME use cases in Johor Bahru.
                            </p>
                            <a href="blog/3d-signboard-vs-lightbox-jb" class="btn-wb-outline">Read Article</a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <article class="blog-article-card">
                            <div class="blog-card-meta">
                                <span>Retail</span>
                                <span>4 min read</span>
                            </div>
                            <h2 class="blog-card-title">5 details that make shopfront signage feel premium.</h2>
                            <p class="blog-card-copy">
                                Small decisions in returns, illumination, paint finish, and mounting alignment often decide whether a sign looks temporary or investment-grade.
                            </p>
                            <a href="index.php#signboard-showcase" class="btn-wb-outline">View Related Work</a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <article class="blog-article-card">
                            <div class="blog-card-meta">
                                <span>Engineering</span>
                                <span>7 min read</span>
                            </div>
                            <h2 class="blog-card-title">When fabrication drawings should be frozen before production.</h2>
                            <p class="blog-card-copy">
                                A clear drawing freeze avoids rework on letter depths, fixing positions, cable routes, and structural backing plates once materials have been cut.
                            </p>
                            <a href="index.php#estimator" class="btn-wb-outline">Estimate A Project</a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <article class="blog-article-card">
                            <div class="blog-card-meta">
                                <span>Project management</span>
                                <span>5 min read</span>
                            </div>
                            <h2 class="blog-card-title">What to confirm before a night installation at a live site.</h2>
                            <p class="blog-card-copy">
                                Access permits, loading bay windows, safety barriers, and power isolation all need a clean handoff plan when signage is installed after operating hours.
                            </p>
                            <a href="index.php#location-map" class="btn-wb-outline">Talk To The Team</a>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="blog-section">
            <div class="container">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-8">
                        <div class="blog-cta-panel">
                            <span class="blog-section-kicker">Editorial direction</span>
                            <h2 class="mb-3">This page gives Signage SG a place to publish insights, case notes, and compliance guidance.</h2>
                            <p class="blog-card-copy mb-4">
                                It is set up as a reusable landing page now, and can be extended later with individual article pages or a CMS-backed feed if you want real publishing workflow.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="index.php#quote-form" class="btn-wb-solid">Request A Quote</a>
                                <a href="https://wa.me/6582861600" class="btn-wb-outline" target="_blank" rel="noopener noreferrer">Chat On WhatsApp</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-topic-card">
                            <span class="blog-section-kicker">Suggested next posts</span>
                            <ul class="blog-topic-list">
                                <li><span>Signage budgeting for multi-branch rollouts</span><span>Strategy</span></li>
                                <li><span>Comparing acrylic, stainless steel, and powder-coated finishes</span><span>Materials</span></li>
                                <li><span>Preparing handover photos and maintenance notes</span><span>Operations</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/includes/footer.php'; ?>