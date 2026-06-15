<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signage SG Blog | Signage Strategy, Compliance and Build Insights</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/style.css">
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
</head>
<body class="d-flex flex-column h-full">

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php#hero">
                <img src="assets/images/logo.png" alt="Signage SG logo" style="width: 76px; height: auto;" class="flex-shrink-0">
                <div>
                    <span class="d-block h4 mb-0 fw-bold tracking-widest text-black display-font" style="letter-spacing: 1px;">SIGNAGE SG</span>
                    <span class="d-block text-uppercase text-muted" style="font-size: 0.55rem; letter-spacing: 3px; font-weight: 700;">ARCHITECTURAL SIGN CRAFTS</span>
                </div>
            </a>

            <button class="navbar-toggler border-1 border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mobile-nav-quote d-lg-none w-100 mt-3">
                <a href="index.php#quote-form" class="btn-wb-solid btn-nav-quote w-100 text-center">Get Quote</a>
            </div>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1 gap-lg-4">
                    <li class="nav-item"><a class="nav-link" href="index.php#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#estimator">Cost Calculator</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#location-map">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 navbar-cta-group">
                    <a href="https://wa.me/6582861600" class="text-black text-decoration-none d-none d-xl-inline-block fw-bold text-nowrap" style="font-size: 0.85rem;" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-phone me-1"></i>+65 8286 1600
                    </a>
                    <a href="index.php#quote-form" class="btn-wb-solid btn-nav-quote d-none d-lg-inline-flex">Get Quote</a>
                </div>
            </div>
        </div>
    </nav>

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
                        Practical articles on fabrication planning, authority submissions, retail rollouts, and material choices for teams delivering signage in Singapore.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#latest-articles" class="btn-wb-solid">Read Latest Posts</a>
                        <a href="index.php#quote-form" class="btn-wb-outline">Discuss A Project</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="blog-stat-grid">
                        <div class="blog-stat-card">
                            <strong>3</strong>
                            <span class="text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.14em; font-weight: 700;">Fresh articles</span>
                        </div>
                        <div class="blog-stat-card">
                            <strong>8 min</strong>
                            <span class="text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.14em; font-weight: 700;">Average read</span>
                        </div>
                        <div class="blog-stat-card">
                            <strong>100%</strong>
                            <span class="text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.14em; font-weight: 700;">Singapore-focused</span>
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
                                <span>Permits</span>
                                <span>6 min read</span>
                            </div>
                            <h2 class="blog-card-title">How to scope signage early enough to avoid approval delays.</h2>
                            <p class="blog-card-copy">
                                Most delays happen before fabrication starts. This guide breaks down what landlords, mall management teams, and local submission workflows usually need so design teams can lock sizes, power loads, and fixing details earlier.
                            </p>
                            <a href="index.php#compliance" class="btn-wb-outline">See Compliance Capabilities</a>
                        </article>
                    </div>
                    <div class="col-lg-5">
                        <aside class="blog-topic-card">
                            <span class="blog-section-kicker">Popular topics</span>
                            <h2 class="h3 mb-4">What clients usually ask before a rollout.</h2>
                            <ul class="blog-topic-list">
                                <li><span>Material selection for indoor vs outdoor signage</span><span>Build guide</span></li>
                                <li><span>Choosing between halo-lit letters and lightboxes</span><span>Design</span></li>
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

    <footer class="mt-auto py-5 bg-black text-white">
        <div class="container py-3">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="footer-logo-badge flex-shrink-0">
                            <img src="assets/images/logo.png" alt="Signage SG logo" class="footer-logo-image">
                        </span>
                        <div>
                            <span class="d-block h5 mb-0 fw-bold tracking-widest text-white display-font" style="letter-spacing: 1px;">SIGNAGE SG</span>
                            <span class="d-block text-uppercase text-muted" style="font-size: 0.55rem; letter-spacing: 2px; font-weight: 700;">Singapore</span>
                        </div>
                    </div>
                    <p class="text-light-gray mb-4" style="font-size: 0.9rem; line-height: 1.7; font-weight: 300;">
                        Precision engineering and aesthetic excellence in architectural signage systems. Fully accredited with bizSAFE Star and BCA standards for secure site handovers.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white hover-opacity" style="font-size: 1.2rem;"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" class="text-white hover-opacity" style="font-size: 1.2rem;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-white hover-opacity" style="font-size: 1.2rem;"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-white hover-opacity" style="font-size: 1.2rem;"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <h5 class="text-white mb-4 tracking-wider text-uppercase font-monospace" style="font-size: 0.85rem;">PRODUCTION WORKSHOP</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 text-light-gray" style="font-size: 0.9rem;">
                        <li class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-location-dot mt-1 text-white"></i>
                            <div>
                                <strong>Signage SG Private Limited</strong><br>
                                601 Ang Mo Kio Avenue 5,<br>
                                560601, Singapore
                            </div>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-clock text-white"></i>
                            <span>Mon - Fri: 9.00 a.m. - 6.00 p.m.; Sat - Sun: Closed</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-phone text-white"></i>
                            <a href="https://wa.me/6582861600" class="text-light-gray text-decoration-none hover-underline" target="_blank" rel="noopener noreferrer">+65 8286 1600 (Gan)</a>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-envelope text-white"></i>
                            <a href="mailto:antadv.gan@gmail.com" class="text-light-gray text-decoration-none hover-underline">antadv.gan@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-4">
                    <h5 class="text-white mb-4 tracking-wider text-uppercase font-monospace" style="font-size: 0.85rem;">LOCAL REGULATORY COMPLIANCE</h5>
                    <div class="d-flex flex-column gap-2 text-light-gray" style="font-size: 0.8rem;">
                        <div class="border border-white p-2 text-white font-monospace d-flex justify-content-between align-items-center" style="opacity: 0.8;">
                            <span>BCA REGISTERED KEY:</span>
                            <span class="fw-bold">CR11 (L1)</span>
                        </div>
                        <div class="border border-white p-2 text-white font-monospace d-flex justify-content-between align-items-center" style="opacity: 0.8;">
                            <span>SAFETY COMPLIANCE:</span>
                            <span class="fw-bold text-uppercase">bizSAFE STAR</span>
                        </div>
                        <div class="border border-white p-2 text-white font-monospace d-flex justify-content-between align-items-center" style="opacity: 0.8;">
                            <span>ISO PROTOCOL:</span>
                            <span class="fw-bold">ISO 45001:2018</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top border-technical-subtle mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center text-white" style="font-size: 0.8rem;">
                <p class="mb-2 mb-md-0">&copy; 2026 Signage SG. All Rights Reserved.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white text-decoration-none hover-white">Terms of Fabrication</a>
                    <span>|</span>
                    <a href="#" class="text-white text-decoration-none hover-white">PDPA Privacy Protocol</a>
                </div>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6582861600" class="floating-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Chat with Signage SG on WhatsApp">
        <span class="floating-whatsapp-icon" aria-hidden="true">
            <i class="fa-brands fa-whatsapp"></i>
        </span>
        <span class="floating-whatsapp-label">WhatsApp Us</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>