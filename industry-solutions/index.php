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
$productPath = '../signboard-and-signage-products-in-singapore-sg';
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
        'summary' => 'Complete signage packages for restaurants, cafes, food courts, bakeries, and beverage outlets.',
        'services' => ['Shopfront Signboards', 'Menu Lightboxes', 'Interior Neon Signs', 'Counter Displays', 'Wayfinding', 'Wall Graphics']
    ],
    [
        'name' => 'Retail',
        'summary' => 'Visibility, promotions, and display signage for boutiques, malls, and product-led stores.',
        'services' => ['Shopfront Signboards', 'Promotional Lightboxes', 'Window Displays', 'Product Display Signage']
    ],
    [
        'name' => 'Office',
        'summary' => 'Professional brand presentation and navigation for corporate workspaces.',
        'services' => ['Reception Logo Signs', 'Directory Signs', 'Meeting Room Signs', 'Frosted Glass Stickers', 'Wayfinding Systems']
    ],
    [
        'name' => 'Healthcare & Clinic',
        'summary' => 'Clear, reassuring signage systems for clinics, dental practices, and wellness centres.',
        'services' => ['Reception Signs', 'Room Identification Signs', 'Directional Signage', 'Informational Signage']
    ],
    [
        'name' => 'Industrial & Warehouse',
        'summary' => 'Durable identification, safety, and directional signage for operational sites.',
        'services' => ['Factory Signboards', 'Safety Signage', 'Directional Signs', 'Warehouse Identification Signs']
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

        .industry-card {
            display: flex;
            flex-direction: column;
            min-height: 100%;
            padding: 1.25rem;
        }

        .industry-card h3,
        .industry-package-card h3,
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
            grid-template-columns: repeat(5, minmax(0, 1fr));
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
        }

        @media (max-width: 767.98px) {
            .industry-card-grid,
            .industry-package-grid,
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
                        <a href="#fnb-solutions" class="btn-wb-solid">View F&B Package</a>
                        <a href="../index.php#quote-form" class="btn-wb-outline">Request Consultation</a>
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
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Preferred Website Flow</span>
                    <h2 class="display-5 text-black mt-2 mb-3">A Customer-Focused Path From Industry Need To Enquiry</h2>
                </div>

                <div class="industry-flow">
                    <article class="industry-flow-step">
                        <span>Step 01</span>
                        <h3>Home</h3>
                        <p class="industry-copy mb-0">Introduce Signage SG as an end-to-end signage and branding partner.</p>
                    </article>
                    <article class="industry-flow-step">
                        <span>Step 02</span>
                        <h3>Industry Solutions</h3>
                        <p class="industry-copy mb-0">Let visitors choose F&B, Retail, Office, Clinic, or Industrial requirements.</p>
                    </article>
                    <article class="industry-flow-step">
                        <span>Step 03</span>
                        <h3>Signage Categories</h3>
                        <p class="industry-copy mb-0">Connect each package to actual products, materials, and fabrication options.</p>
                    </article>
                    <article class="industry-flow-step">
                        <span>Step 04</span>
                        <h3>Portfolio</h3>
                        <p class="industry-copy mb-0">Show relevant installed work so customers can picture the final result.</p>
                    </article>
                    <article class="industry-flow-step">
                        <span>Step 05</span>
                        <h3>Contact Us</h3>
                        <p class="industry-copy mb-0">Convert interest into a site discussion, quote, or WhatsApp enquiry.</p>
                    </article>
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
