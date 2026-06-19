<?php
$pageTitle = 'Signboard and Signage Products in Singapore | Signage SG';
$navPage = 'products';
$metaDescription = 'Explore custom signboard and signage products in Singapore, including 3D lighted signboards, front-lit, back-lit, whole-lit, lightbox, LED neon, stickers, and decals.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/signboard-and-signage-products-in-singapore-sg';
$ogImage = 'assets/images/products/aluminium-3d-box-up-signboard.jpeg';
$assetBase = '../assets';
$homePagePath = '../index.php';
$blogPath = '../blog';
$productPath = '.';
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'Signboard and Signage Products in Singapore',
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
        'itemListElement' => [
            ['@type' => 'Service', 'name' => '3D signboard fabrication'],
            ['@type' => 'Service', 'name' => '3D signboard with lighting'],
            ['@type' => 'Service', 'name' => 'Back-lit signboard fabrication'],
            ['@type' => 'Service', 'name' => 'Whole-lit signboard fabrication'],
            ['@type' => 'Service', 'name' => 'Punch-hole signboard fabrication'],
            ['@type' => 'Service', 'name' => 'Aluminium casing lightbox fabrication'],
            ['@type' => 'Service', 'name' => 'LED neon signage'],
            ['@type' => 'Service', 'name' => 'Soft fabric lightbox signage'],
            ['@type' => 'Service', 'name' => 'Glass window sticker installation'],
            ['@type' => 'Service', 'name' => 'Vehicle sticker production']
        ]
    ]
];
$extraHead = <<<'HTML'
    <style>
        .product-hero {
            position: relative;
            padding: 150px 0 84px;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
            overflow: hidden;
        }

        .product-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.035) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .product-kicker {
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

        .product-title {
            max-width: 12ch;
            font-size: clamp(2.65rem, 5vw, 4.75rem);
            line-height: 0.98;
        }

        .product-lead,
        .product-copy {
            color: var(--color-dark-gray);
            line-height: 1.85;
        }

        .product-hero-photo,
        .product-card,
        .process-card,
        .category-group-card,
        .definition-panel {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .product-hero-photo {
            position: relative;
            aspect-ratio: 4 / 5;
            overflow: hidden;
        }

        .product-hero-photo img,
        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-hero-label {
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

        .product-section {
            padding: 4.5rem 0;
            border-bottom: 1px solid var(--color-pure-black);
        }

        .product-section-heading {
            max-width: 52rem;
            margin-bottom: 2rem;
        }

        .category-group-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .category-group-card {
            padding: 1.35rem;
            min-height: 100%;
        }

        .category-group-title {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .category-group-title h3 {
            margin-bottom: 0;
            font-size: 1.08rem;
            line-height: 1.2;
        }

        .category-count {
            flex-shrink: 0;
            min-width: 2.2rem;
            padding: 0.25rem 0.4rem;
            border: 1px solid var(--color-pure-black);
            text-align: center;
            font-family: monospace;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .category-sub-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .category-sub-list li {
            padding: 0.45rem 0.6rem;
            background: var(--color-light-gray);
            border: 1px solid var(--color-subtle-border);
            color: var(--color-dark-gray);
            font-size: 0.78rem;
            line-height: 1.25;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .product-card-media {
            aspect-ratio: 4 / 3;
            border-bottom: 1px solid var(--color-pure-black);
            overflow: hidden;
            background: var(--color-light-gray);
        }

        .product-card-body {
            padding: 1.35rem;
        }

        .product-card h3,
        .process-card h3 {
            font-size: 1.18rem;
            line-height: 1.2;
        }

        .product-tag {
            display: inline-block;
            margin-bottom: 0.85rem;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--color-dark-gray);
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
        }

        .process-card {
            padding: 1.25rem;
        }

        .process-step {
            display: inline-flex;
            width: 2.2rem;
            height: 2.2rem;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            background: var(--color-pure-black);
            color: var(--color-pure-white);
            font-weight: 700;
            font-family: monospace;
        }

        .definition-panel {
            padding: 1.75rem;
        }

        .definition-panel strong {
            color: var(--color-pure-black);
        }

        @media (max-width: 991.98px) {
            .product-hero {
                padding-top: 132px;
                padding-bottom: 60px;
            }

            .product-grid,
            .category-group-grid,
            .process-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .product-grid,
            .category-group-grid,
            .process-grid {
                grid-template-columns: 1fr;
            }

            .product-section {
                padding: 3.25rem 0;
            }
        }
    </style>
HTML;
require __DIR__ . '/../includes/header.php';
?>

    <header class="product-hero">
        <div class="container position-relative z-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="product-kicker">Singapore Signage Products</span>
                    <h1 class="product-title mt-4 mb-4">Signboard And Signage Products</h1>
                    <p class="product-lead fs-5 mb-4">
                        Brighten up your business with custom signboards, 3D lighted lettering, lightboxes, stickers, decals, and printed brand materials that grab attention by day and night.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="../index.php#quote-form" class="btn-wb-solid">Request Product Quote</a>
                        <a href="#product-range" class="btn-wb-outline">View Products</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="product-hero-photo mb-0">
                        <img src="../assets/images/products/foamboard-signage-singapore.jpeg" alt="Foamboard signage product manufactured in Singapore">
                        <figcaption class="product-hero-label">Custom signage, signboard and display fabrication</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section id="product-menu-structure" class="product-section bg-light">
            <div class="container">
                <div class="product-section-heading">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Menu Structure</span>
                    <h2 class="display-5 text-black mt-2 mb-3">Products Rearranged By Parent And Subcategory</h2>
                    <p class="product-copy mb-0">
                        The source menu groups products into these parent categories, with each card showing the subcategories customers would expect to browse under that heading.
                    </p>
                </div>

                <div class="category-group-grid">
                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>3D Signboard With Lighting</h3>
                            <span class="category-count">05</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Front-lit Signboard</li>
                            <li>Back-lit Signboard</li>
                            <li>Whole-lit Signboard</li>
                            <li>Punch Hole Signboard</li>
                            <li>Light Bulb Signboard</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>3D Signboard With Non-Lighting</h3>
                            <span class="category-count">03</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Foamboard 3D Wording</li>
                            <li>Aluminium Box-Up 3D Wording</li>
                            <li>Acrylic 3D Wording</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Lightbox</h3>
                            <span class="category-count">04</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Normal Lightbox</li>
                            <li>Aluminium Casing Lightbox</li>
                            <li>Soft Fabric Lightbox</li>
                            <li>Crystal Wording Lightbox</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>2D Signboard</h3>
                            <span class="category-count">03</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Normal Signboard</li>
                            <li>Aluminium Strip Signboard Base</li>
                            <li>Banner Signboard</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Indoor Signage</h3>
                            <span class="category-count">05</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Foamboard 3D Wording Signage</li>
                            <li>Stainless Steel 3D Wording Signage</li>
                            <li>Acrylic 3D Wording</li>
                            <li>Acrylic Signage</li>
                            <li>Foamboard Signage</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>LED Displays</h3>
                            <span class="category-count">03</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>LED Banner and Signage</li>
                            <li>LED Neon Signage</li>
                            <li>Pylon and Directional Signage</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Billboard</h3>
                            <span class="category-count">03</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Billboard</li>
                            <li>Hoarding</li>
                            <li>Construction Board</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Road Sign</h3>
                            <span class="category-count">02</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Roadsign Safety Signage</li>
                            <li>Directional Roadsign</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Printing Services</h3>
                            <span class="category-count">04</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Label Sticker</li>
                            <li>Glass Window Sticker</li>
                            <li>Wall Sticker</li>
                            <li>Vehicle Sticker Wrapping</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Exhibition Booth</h3>
                            <span class="category-count">05</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>PVC Table Booth</li>
                            <li>Backdrop</li>
                            <li>Jumbo Banner</li>
                            <li>Pop-Up Backdrop Display System</li>
                            <li>Pop-Up Promotion Counter</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Display Set</h3>
                            <span class="category-count">08</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Banner</li>
                            <li>Normal Roll-Up Bunting</li>
                            <li>Deluxe Roll-Up Bunting</li>
                            <li>Tripod/Round Plate Bunting</li>
                            <li>Human Stand</li>
                            <li>Easel Stand / Wood Stand</li>
                            <li>X-Stand</li>
                            <li>Door Bunting</li>
                        </ul>
                    </article>

                    <article class="category-group-card">
                        <div class="category-group-title">
                            <h3>Marketing Essential</h3>
                            <span class="category-count">02</span>
                        </div>
                        <ul class="category-sub-list">
                            <li>Namecard</li>
                            <li>Leaflet</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section id="product-range" class="product-section">
            <div class="container">
                <div class="product-section-heading">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Featured Product Cards</span>
                    <h2 class="display-5 text-black mt-2 mb-3">Visual Examples From Core Signage Categories</h2>
                    <p class="product-copy mb-0">
                        From 3D signs to LED displays, every product can be adapted by size, shape, material, lighting, finish, and mounting method to suit your brand and installation site.
                    </p>
                </div>

                <div class="product-grid">
                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/aluminium-3d-box-up-signboard.jpeg" alt="Aluminium 3D box-up signboard in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Dimensional Signage</span>
                            <h3>3D Box-Up Signboards</h3>
                            <p class="product-copy mb-0">Raised aluminium or stainless steel letters and logos for shopfronts, office entrances, and brand walls that need a premium physical presence.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/front-lit-3d-signboard.jpeg" alt="Front-lit 3D signboard manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Illuminated Signage</span>
                            <h3>Front-Lit Signboards</h3>
                            <p class="product-copy mb-0">Eye-catching illuminated signboards built to improve night visibility and make storefront branding easier to spot from a distance.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/back-lit-signboard.jpeg" alt="Back-lit signboard manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Illuminated Signage</span>
                            <h3>Back-Lit Signboards</h3>
                            <p class="product-copy mb-0">Halo-style illuminated lettering and panels that create a clean glow behind the signage for premium night-time visibility.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/whole-lit-signboard.jpeg" alt="Whole-lit signboard manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Illuminated Signage</span>
                            <h3>Whole-Lit Signboards</h3>
                            <p class="product-copy mb-0">Fully illuminated sign faces for storefronts and brand panels where bright, even visibility is the main requirement.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/led-neon-signage-pink.jpg" alt="Pink LED neon signage in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">LED Display</span>
                            <h3>LED Neon Signage</h3>
                            <p class="product-copy mb-0">Flexible LED neon signs for retail displays, cafes, photo walls, event branding, and decorative statement pieces.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/soft-fabric-lightbox.jpeg" alt="Soft fabric lightbox signage manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Lightbox</span>
                            <h3>Soft Fabric Lightboxes</h3>
                            <p class="product-copy mb-0">Large-format lightbox systems with replaceable fabric graphics for malls, showrooms, exhibitions, and promotional campaigns.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/sided-lightbox-signboard.jpeg" alt="Sided lightbox signboard manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Lightbox</span>
                            <h3>Sided Lightboxes</h3>
                            <p class="product-copy mb-0">Projecting or sided lightbox signboards for corridors, shopfronts, and walk-by visibility from multiple directions.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/aluminium-casing-lightbox.jpeg" alt="Aluminium casing lightbox manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Lightbox</span>
                            <h3>Aluminium Casing Lightboxes</h3>
                            <p class="product-copy mb-0">Durable framed lightbox systems with aluminium casing for cleaner edges, stronger structure, and long-term shopfront use.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/crystal-wording-lightbox.jpeg" alt="Crystal wording lightbox manufactured in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Lightbox</span>
                            <h3>Crystal Wording Lightboxes</h3>
                            <p class="product-copy mb-0">Polished acrylic or crystal-effect wording paired with lighting for refined indoor brand walls and reception signage.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/punch-hole-signboard.jpeg" alt="Punch hole signboard manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Specialty Signboard</span>
                            <h3>Punch-Hole Signboards</h3>
                            <p class="product-copy mb-0">Perforated or punch-hole signboards that combine texture, light control, and a distinctive fabrication detail.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/light-bulb-signboard.jpeg" alt="Light bulb signboard manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Specialty Lighting</span>
                            <h3>Light Bulb Signboards</h3>
                            <p class="product-copy mb-0">Retro-style bulb signage for feature walls, entertainment venues, events, and high-impact decorative branding.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/aluminium-strip-signboard-base.jpeg" alt="Aluminium strip signboard base manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Signboard Base</span>
                            <h3>Aluminium Strip Signboard Bases</h3>
                            <p class="product-copy mb-0">Structured aluminium strip bases used as the foundation for durable exterior signboards and layered signage builds.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/2d-signboard.jpeg" alt="2D signboard maker in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Flat Signage</span>
                            <h3>2D Signboards</h3>
                            <p class="product-copy mb-0">Clean flat signboards for budget-conscious projects, directional signs, wall-mounted panels, and simple business identification.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/glass-window-sticker.jpeg" alt="Glass window sticker installed in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Window Graphics</span>
                            <h3>Glass Window Stickers</h3>
                            <p class="product-copy mb-0">Vibrant printed graphics, frosted decals, and privacy films that turn windows and glass partitions into branded communication surfaces.</p>
                        </div>
                    </article>

                    <article class="product-card">
                        <div class="product-card-media">
                            <img src="../assets/images/products/vehicle-sticker-singapore.jpeg" alt="Vehicle sticker manufacturer in Singapore">
                        </div>
                        <div class="product-card-body">
                            <span class="product-tag">Mobile Branding</span>
                            <h3>Vehicle Stickers</h3>
                            <p class="product-copy mb-0">Custom vehicle decals and fleet graphics that carry your brand across Singapore with durable print and clean installation.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="product-section bg-light">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">What We Build</span>
                        <h2 class="display-5 text-black mt-2 mb-3">Signboards, Signage And Printed Brand Essentials</h2>
                    </div>
                    <div class="col-lg-7">
                        <div class="definition-panel">
                            <p class="product-copy"><strong>Signboards</strong> display important business information and are commonly installed outside shops, restaurants, offices, and commercial spaces so customers can recognize the business quickly.</p>
                            <p class="product-copy"><strong>Signage</strong> is the broader family of signs and displays used for communication, wayfinding, service information, promotion, and brand expression.</p>
                            <p class="product-copy mb-0">We can customize the size, shape, material, finish, lighting, print, and installation method so the finished product fits your site and visual direction.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-section">
            <div class="container">
                <div class="product-section-heading">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Process</span>
                    <h2 class="display-5 text-black mt-2 mb-3">How We Bring A Signage Project From Idea To Installation</h2>
                </div>

                <div class="process-grid">
                    <article class="process-card">
                        <span class="process-step">01</span>
                        <h3>Consult</h3>
                        <p class="product-copy mb-0">We start by understanding your needs, site conditions, brand direction, and budget before recommending the right signage type.</p>
                    </article>
                    <article class="process-card">
                        <span class="process-step">02</span>
                        <h3>Design</h3>
                        <p class="product-copy mb-0">The design is refined for visibility, brand fit, sizing, materials, and clear communication before production begins.</p>
                    </article>
                    <article class="process-card">
                        <span class="process-step">03</span>
                        <h3>Production</h3>
                        <p class="product-copy mb-0">Our fabrication team produces the signage with attention to finish, lighting, print quality, and project timing.</p>
                    </article>
                    <article class="process-card">
                        <span class="process-step">04</span>
                        <h3>Install Or Ship</h3>
                        <p class="product-copy mb-0">Once ready, we coordinate delivery or installation so the product is properly placed and ready to make an impact.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="product-section bg-black text-white">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="text-uppercase fw-bold text-white-50" style="font-size: 0.78rem; letter-spacing: 2px;">Ready To Start</span>
                        <h2 class="display-5 text-white mt-2 mb-3">Tell Us What You Need To Brand, Display Or Install.</h2>
                        <p class="mb-0 text-light-gray" style="line-height: 1.8;">Share your reference photo, dimensions, target location, and preferred material. We will help match the product type to your site and business goal.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="../index.php#quote-form" class="btn-wb-outline text-white border-white">Get Quote</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
