<?php
$pageTitle = 'Industry Signage Solutions Singapore | F&B, Retail, Office, Clinic | Signage SG';
$navPage = 'industries';
$metaDescription = 'Choose complete signage solutions by industry in Singapore, including F&B restaurant signage, retail shopfront signs, office branding, clinic wayfinding, and industrial safety signage.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/industry-solutions';
$ogImage = 'assets/images/lightbox/lightbox-ang-mo-kio-menu.jpg';
$assetBase = '../assets';
$homePagePath = '../index.php';
$blogPath = '../blog';
$productPath = '../products';
$industryPath = '.';

$fnbPackages = [
    [
        'title' => 'Exterior Signage',
        'subtitle' => 'Shopfront signboards for visibility and customer attraction.',
        'items' => ['3D Box-Up Letter Sign', 'LED Channel Letter Sign', 'Lightbox Sign', 'Shopfront Fascia Sign', 'Illuminated Signboard'],
        'examples' => ['Restaurant front signage', 'Cafe signboards', 'Food court outlet signage']
    ],
    [
        'title' => 'Food Promotion & Display Signage',
        'subtitle' => 'Menu, meal, and beverage displays that support daily promotions.',
        'items' => ['Fabric Lightbox', 'Menu Lightbox', 'Food Display Lightbox', 'Promotional Posters', 'Digital Displays'],
        'examples' => ['Food image lightboxes', 'Promotional meal displays', 'Beverage advertising displays']
    ],
    [
        'title' => 'Interior Branding',
        'subtitle' => 'Brand features that make the outlet memorable inside.',
        'items' => ['Neon Signs', 'LED Neon Flex Signs', 'Acrylic Logo Signs', 'Feature Wall Signage', 'Decorative Branding Elements'],
        'examples' => ['Instagrammable neon walls', 'Brand logo feature walls', 'Custom slogan signage']
    ],
    [
        'title' => 'Counter & Cashier Signage',
        'subtitle' => 'Front-counter details that improve ordering flow and presentation.',
        'items' => ['Acrylic Counter Logo', 'Cashier Signs', 'QR Ordering Signs', 'Countertop Displays'],
        'examples' => ['Reception logo displays', 'Cashier identification signs', 'Ordering instructions']
    ],
    [
        'title' => 'Hanging Signage & Wayfinding',
        'subtitle' => 'Clear navigation for dining areas, service counters, and facilities.',
        'items' => ['Hanging Signs', 'Directional Signs', 'Toilet Signs', 'Room Identification Signs'],
        'examples' => ['Ceiling-mounted signs', 'Directional wayfinding systems', 'Area identification signage']
    ],
    [
        'title' => 'Wall Graphics & Stickers',
        'subtitle' => 'Environmental graphics for atmosphere, privacy, and promotions.',
        'items' => ['Vinyl Wall Stickers', 'Wall Murals', 'Frosted Glass Stickers', 'Window Graphics', 'Custom Decorative Graphics'],
        'examples' => ['Brand story walls', 'Decorative graphics', 'Promotional window stickers']
    ],
];

$industries = [
    [
        'name' => 'F&B / Restaurant',
        'anchor' => 'fnb-recommendations',
        'summary' => 'Complete signage packages for restaurants, cafes, food courts, bakeries, and beverage outlets.',
        'bestFor' => 'Attracting walk-in customers, showing menus clearly, and creating a branded dining atmosphere.',
        'services' => ['Shopfront Signboards', 'Menu Lightboxes', 'Interior Neon Signs', 'Counter Displays', 'Wayfinding', 'Wall Graphics'],
        'recommended' => ['Front-lit Signboard', 'Soft Fabric Lightbox', 'LED Neon Signage', 'Wall Sticker']
    ],
    [
        'name' => 'Retail',
        'anchor' => 'retail-solutions',
        'summary' => 'Visibility, promotions, and display signage for boutiques, malls, and product-led stores.',
        'bestFor' => 'Making the storefront easy to notice, promoting offers, and supporting product displays.',
        'services' => ['Shopfront Signboards', 'Promotional Lightboxes', 'Window Displays', 'Product Display Signage'],
        'recommended' => ['Front-lit Signboard', 'Glass Window Sticker', 'Normal Lightbox', 'Acrylic Signage']
    ],
    [
        'name' => 'Office',
        'anchor' => 'office-solutions',
        'summary' => 'Professional brand presentation and navigation for corporate workspaces.',
        'bestFor' => 'Presenting the company clearly at reception and helping visitors move through the workplace.',
        'services' => ['Reception Logo Signs', 'Directory Signs', 'Meeting Room Signs', 'Frosted Glass Stickers', 'Wayfinding Systems'],
        'recommended' => ['Stainless Steel 3D Wording Signage', 'Acrylic Signage', 'Glass Window Sticker', 'Directional Roadsign']
    ],
    [
        'name' => 'Healthcare & Clinic',
        'anchor' => 'clinic-solutions',
        'summary' => 'Clear, reassuring signage systems for clinics, dental practices, and wellness centres.',
        'bestFor' => 'Reducing visitor confusion with clean reception, room, safety, and directional signage.',
        'services' => ['Reception Signs', 'Room Identification Signs', 'Directional Signage', 'Informational Signage'],
        'recommended' => ['Acrylic Signage', 'Foamboard Signage', 'Directional Roadsign', 'Label Sticker']
    ],
    [
        'name' => 'Industrial & Warehouse',
        'anchor' => 'industrial-solutions',
        'summary' => 'Durable identification, safety, and directional signage for operational sites.',
        'bestFor' => 'Improving site identification, safety communication, loading flow, and operational wayfinding.',
        'services' => ['Factory Signboards', 'Safety Signage', 'Directional Signs', 'Warehouse Identification Signs'],
        'recommended' => ['Roadsign Safety Signage', 'Directional Roadsign', 'Construction Board', 'Normal Signboard']
    ],
];

$planningSteps = [
    [
        'title' => 'Share Your Site',
        'copy' => 'Send photos, floor plans, frontage size, brand files, and opening timeline so we understand the actual location.'
    ],
    [
        'title' => 'Choose The Right Mix',
        'copy' => 'We match your industry need to suitable sign types, materials, lighting, display areas, and installation approach.'
    ],
    [
        'title' => 'Confirm Design & Quote',
        'copy' => 'You review the proposed signage scope, dimensions, finishing, artwork direction, and quotation before fabrication.'
    ],
    [
        'title' => 'Fabricate & Install',
        'copy' => 'Our team coordinates production, site preparation, installation, and practical finishing details.'
    ],
];

$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'Industry Signage Solutions Singapore',
    'description' => $metaDescription,
    'url' => $siteBaseUrl . $canonicalPath,
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Signage SG',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $siteBaseUrl . '/assets/images/logo.png'
        ]
    ],
    'mainEntity' => [
        '@type' => 'ItemList',
        'itemListElement' => array_map(function ($industry, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $industry['name'],
                'description' => $industry['summary']
            ];
        }, $industries, array_keys($industries))
    ]
];

$extraHead = <<<'HTML'
    <style>
        .industry-hero {
            position: relative;
            padding: 150px 0 84px;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
            overflow: hidden;
        }

        .industry-hero::before,
        .industry-section-grid::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.035) 1px, transparent 1px);
            background-size: 52px 52px;
            pointer-events: none;
        }

        .industry-hero .container,
        .industry-section-grid .container {
            position: relative;
            z-index: 1;
        }

        .industry-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid var(--color-pure-black);
            padding: 0.45rem 0.8rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            background: var(--color-light-gray);
        }

        .industry-title {
            max-width: 13ch;
            font-size: clamp(2.65rem, 5vw, 4.75rem);
            line-height: 0.98;
        }

        .industry-lead,
        .industry-copy {
            color: var(--color-dark-gray);
            line-height: 1.85;
        }

        .industry-hero-photo,
        .industry-card,
        .industry-package-card,
        .industry-recommendation-card,
        .industry-start-panel,
        .industry-flow-step {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .industry-hero-photo {
            position: relative;
            aspect-ratio: 4 / 5;
            overflow: hidden;
        }

        .industry-hero-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .industry-photo-label {
            position: absolute;
            left: 1rem;
            bottom: 1rem;
            max-width: calc(100% - 2rem);
            padding: 0.65rem 0.8rem;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid var(--color-pure-black);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .industry-section,
        .industry-section-grid {
            position: relative;
            padding: 4.5rem 0;
            border-bottom: 1px solid var(--color-pure-black);
        }

        .industry-section-heading {
            max-width: 54rem;
            margin-bottom: 2rem;
        }

        .industry-card-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 1rem;
        }

        .industry-recommendation-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .industry-card {
            display: flex;
            flex-direction: column;
            min-height: 100%;
            padding: 1.25rem;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
            transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
        }

        .industry-card:hover,
        .industry-card:focus-within {
            border-color: #25d366;
            transform: translateY(-8px);
            box-shadow: 0 22px 44px rgba(0, 0, 0, 0.12);
        }

        .industry-card h3,
        .industry-package-card h3,
        .industry-recommendation-card h3,
        .industry-flow-step h3 {
            font-size: 1.12rem;
            line-height: 1.2;
        }

        .industry-chip-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0;
            margin: auto 0 0;
            list-style: none;
        }

        .industry-chip-list li {
            padding: 0.42rem 0.55rem;
            background: var(--color-light-gray);
            border: 1px solid var(--color-subtle-border);
            color: var(--color-dark-gray);
            font-size: 0.76rem;
            line-height: 1.25;
        }

        .industry-card-actions {
            display: grid;
            gap: 0.65rem;
            margin-top: 1rem;
        }

        .industry-card-whatsapp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.78rem 0.9rem;
            border: 1px solid #1fb457;
            border-radius: 0;
            background: #25d366;
            color: var(--color-pure-white);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            line-height: 1.2;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            transition: transform 0.25s ease, background-color 0.25s ease, box-shadow 0.25s ease;
        }

        .industry-card-whatsapp:hover,
        .industry-card-whatsapp:focus {
            background: #1fb457;
            color: var(--color-pure-white);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(10, 64, 31, 0.22);
        }

        .industry-card-whatsapp i {
            font-size: 1.05rem;
        }

        .industry-card-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.78rem 0.9rem;
            border: 1px solid var(--color-pure-black);
            color: var(--color-pure-black);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            line-height: 1.2;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease;
        }

        .industry-card-link:hover,
        .industry-card-link:focus {
            background: var(--color-pure-black);
            color: var(--color-pure-white);
            transform: translateY(-2px);
        }

        @media (prefers-reduced-motion: reduce) {
            .industry-card,
            .industry-card-link,
            .industry-card-whatsapp {
                transition: none;
            }

            .industry-card:hover,
            .industry-card:focus-within,
            .industry-card-link:hover,
            .industry-card-link:focus,
            .industry-card-whatsapp:hover,
            .industry-card-whatsapp:focus {
                transform: none;
            }
        }

        .industry-start-panel {
            padding: 1.4rem;
            background: var(--color-light-gray);
        }

        .industry-start-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .industry-start-item {
            padding: 1rem;
            background: var(--color-pure-white);
            border: 1px solid var(--color-subtle-border);
        }

        .industry-start-item strong {
            display: block;
            margin-bottom: 0.35rem;
            color: var(--color-pure-black);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.95rem;
        }

        .industry-recommendation-card {
            padding: 1.35rem;
        }

        .industry-recommendation-label {
            display: inline-block;
            margin-bottom: 0.8rem;
            color: var(--color-dark-gray);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .industry-recommendation-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.55rem;
            padding: 0;
            margin: 1rem 0 0;
            list-style: none;
        }

        .industry-recommendation-list li {
            padding: 0.65rem 0.75rem;
            background: var(--color-light-gray);
            border: 1px solid var(--color-subtle-border);
            color: var(--color-near-black);
            font-size: 0.86rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .industry-package-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .industry-package-card {
            min-height: 100%;
            padding: 1.35rem;
        }

        .industry-package-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.4rem;
            height: 2.4rem;
            margin-bottom: 1rem;
            background: var(--color-pure-black);
            color: var(--color-pure-white);
            font-family: monospace;
            font-weight: 700;
        }

        .industry-package-list {
            padding-left: 1.1rem;
            margin-bottom: 1.1rem;
            color: var(--color-near-black);
            line-height: 1.75;
        }

        .industry-example-list {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
            padding: 0;
            margin: 0;
            list-style: none;
            color: var(--color-dark-gray);
            font-size: 0.88rem;
        }

        .industry-example-list li::before {
            content: "Example: ";
            color: var(--color-pure-black);
            font-weight: 700;
        }

        .industry-flow {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
        }

        .industry-flow-step {
            padding: 1.2rem;
        }

        .industry-flow-step span {
            display: block;
            margin-bottom: 0.75rem;
            color: var(--color-dark-gray);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        @media (max-width: 1199.98px) {
            .industry-card-grid,
            .industry-flow {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 991.98px) {
            .industry-hero {
                padding: 130px 0 64px;
            }

            .industry-package-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .industry-recommendation-grid,
            .industry-start-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767.98px) {
            .industry-card-grid,
            .industry-package-grid,
            .industry-recommendation-list,
            .industry-flow {
                grid-template-columns: 1fr;
            }
        }
    </style>
HTML;

require __DIR__ . '/../includes/header.php';
?>

    <header class="industry-hero">
        <div class="container">
            <div class="row align-items-center justify-content-between g-5">
                <div class="col-lg-7">
                    <span class="industry-kicker">Industry Solutions</span>
                    <h1 class="industry-title display-font text-uppercase mt-4 mb-4">Complete Signage Packages By Business Type</h1>
                    <p class="industry-lead lead mb-4">
                        Select your industry and see the signage system that fits the way your business attracts customers, guides visitors, and presents its brand.
                    </p>
                    <p class="industry-copy mb-5">
                        Signage SG supports end-to-end branding and signage work, from shopfront visibility and interior brand features to wayfinding, wall graphics, display signage, and installation coordination.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#industry-solutions" class="btn-wb-solid">Choose My Industry</a>
                        <a href="https://wa.me/6582861600?text=<?php echo rawurlencode('Hi Signage SG, I need help choosing signage for my business.'); ?>" class="btn-wb-outline" target="_blank" rel="noopener noreferrer">Ask For Recommendation</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="industry-hero-photo mb-0">
                        <img src="../assets/images/lightbox/lightbox-ang-mo-kio-menu.jpg" alt="Menu lightbox signage for a food outlet in Singapore">
                        <figcaption class="industry-photo-label">F&B menu and promotion display signage</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section id="industry-solutions" class="industry-section">
            <div class="container">
                <div class="industry-section-heading">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Choose Your Industry</span>
                    <h2 class="display-5 text-black mt-2 mb-3">From Individual Products To Complete Business Signage Systems</h2>
                    <p class="industry-copy mb-0">
                        Instead of starting with materials alone, begin with your environment: restaurant, retail store, office, clinic, factory, or warehouse. Each industry needs a different blend of visibility, customer guidance, brand experience, and practical compliance.
                    </p>
                </div>

                <div class="industry-card-grid">
<?php foreach ($industries as $industry): ?>
                    <article class="industry-card">
                        <h3 class="mb-3"><?php echo htmlspecialchars($industry['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="industry-copy mb-4"><?php echo htmlspecialchars($industry['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <ul class="industry-chip-list">
<?php foreach ($industry['services'] as $service): ?>
                            <li><?php echo htmlspecialchars($service, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
                        </ul>
                        <div class="industry-card-actions">
                            <a href="#<?php echo htmlspecialchars($industry['anchor'], ENT_QUOTES, 'UTF-8'); ?>" class="industry-card-link">View Ideas</a>
                            <a href="https://wa.me/6582861600?text=<?php echo rawurlencode('Hi Signage SG, I would like to discuss signage solutions for ' . $industry['name'] . '.'); ?>" class="industry-card-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp about <?php echo htmlspecialchars($industry['name'], ENT_QUOTES, 'UTF-8'); ?> signage">
                                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                                WhatsApp
                            </a>
                        </div>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="industry-recommendations" class="industry-section">
            <div class="container">
                <div class="row align-items-end justify-content-between g-4 mb-4">
                    <div class="col-lg-8">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Recommended Starting Points</span>
                        <h2 class="display-5 text-black mt-2 mb-3">Not Sure Which Signage Type Fits Your Business?</h2>
                        <p class="industry-copy mb-0">
                            Use your business type as the first filter. These recommendations give you a practical starting point before comparing materials, lighting, size, and installation details.
                        </p>
                    </div>
                    <div class="col-lg-auto">
                        <a href="../products" class="btn-wb-outline">Browse Products</a>
                    </div>
                </div>

                <div class="industry-start-panel mb-4">
                    <div class="industry-start-grid">
                        <div class="industry-start-item">
                            <strong>If you know your business type</strong>
                            <p class="industry-copy mb-0">Start with the industry cards below and shortlist the signage mix that fits your space.</p>
                        </div>
                        <div class="industry-start-item">
                            <strong>If you know the exact sign type</strong>
                            <p class="industry-copy mb-0">Go straight to Products to compare lightboxes, 3D letters, stickers, road signs, and display sets.</p>
                        </div>
                        <div class="industry-start-item">
                            <strong>If you only have a site photo</strong>
                            <p class="industry-copy mb-0">WhatsApp us the photo and we can suggest suitable signage options for quotation.</p>
                        </div>
                    </div>
                </div>

                <div class="industry-recommendation-grid">
<?php foreach ($industries as $industry): ?>
                    <article id="<?php echo htmlspecialchars($industry['anchor'], ENT_QUOTES, 'UTF-8'); ?>" class="industry-recommendation-card">
                        <span class="industry-recommendation-label"><?php echo htmlspecialchars($industry['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <h3 class="mb-2">Best for</h3>
                        <p class="industry-copy mb-3"><?php echo htmlspecialchars($industry['bestFor'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <h3 class="mb-2">Recommended signage</h3>
                        <ul class="industry-recommendation-list">
<?php foreach ($industry['recommended'] as $item): ?>
                            <li><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
                        </ul>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="fnb-solutions" class="industry-section-grid bg-light">
            <div class="container">
                <div class="row align-items-end justify-content-between g-4 mb-4 mb-lg-5">
                    <div class="col-lg-8">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">F&B / Restaurant Signage Solutions</span>
                        <h2 class="display-5 text-black mt-2 mb-3">Complete Signage Package For Restaurants, Cafes, Food Courts, Bakeries, And Beverage Outlets</h2>
                        <p class="industry-copy mb-0">
                            A practical F&B signage plan combines outside visibility, menu promotion, brand atmosphere, counter clarity, customer navigation, and decorative graphics into one consistent system.
                        </p>
                    </div>
                    <div class="col-lg-auto">
                        <a href="../index.php#quote-form" class="btn-wb-solid">Plan My Outlet Signage</a>
                    </div>
                </div>

                <div class="industry-package-grid">
<?php foreach ($fnbPackages as $index => $package): ?>
                    <article class="industry-package-card">
                        <span class="industry-package-number"><?php echo str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT); ?></span>
                        <h3 class="mb-2"><?php echo htmlspecialchars($package['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="industry-copy mb-3"><?php echo htmlspecialchars($package['subtitle'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <ul class="industry-package-list">
<?php foreach ($package['items'] as $item): ?>
                            <li><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
                        </ul>
                        <ul class="industry-example-list">
<?php foreach ($package['examples'] as $example): ?>
                            <li><?php echo htmlspecialchars($example, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
                        </ul>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="solution-flow" class="industry-section">
            <div class="container">
                <div class="industry-section-heading">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">How We Plan Your Signage</span>
                    <h2 class="display-5 text-black mt-2 mb-3">From Site Photos To Fabrication And Installation</h2>
                    <p class="industry-copy mb-0">
                        A clearer signage plan starts with your location, not only a product name. This process helps us recommend the right mix for visibility, customer flow, brand fit, and budget.
                    </p>
                </div>

                <div class="industry-flow">
<?php foreach ($planningSteps as $index => $step): ?>
                    <article class="industry-flow-step">
                        <span>Step <?php echo str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT); ?></span>
                        <h3><?php echo htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="industry-copy mb-0"><?php echo htmlspecialchars($step['copy'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="industry-section bg-black text-white">
            <div class="container">
                <div class="row align-items-center justify-content-between g-4">
                    <div class="col-lg-8">
                        <span class="text-uppercase fw-bold text-white-50" style="font-size: 0.78rem; letter-spacing: 2px;">End-To-End Signage Partner</span>
                        <h2 class="display-5 text-white mt-2 mb-3">Need A Complete Signage Plan For Your Business?</h2>
                        <p class="text-light-gray mb-0" style="line-height: 1.85;">
                            Share your industry, unit type, site photos, brand direction, and opening timeline. We can recommend the signage mix that fits your visibility, customer flow, and budget.
                        </p>
                    </div>
                    <div class="col-lg-auto">
                        <a href="../index.php#quote-form" class="btn-wb-outline bg-white">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
