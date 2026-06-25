<?php
$pageTitle = '3D Signboard Back-lit Signboard in Singapore | Signage SG';
$navPage = 'products';
$metaDescription = 'View back-lit 3D signboard examples in Singapore, including halo-lit lettering, LED modules, illuminated sign faces, and shopfront signboard projects.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/3d-signboard-back-lit-signboard';
$ogImage = 'assets/images/back-lit-signboard/10-1636f324-7a2d-4750-bb6a-d57844bee52c.jpeg';
$assetBase = '../assets';
$homePagePath = '../index.php';
$blogPath = '../blog';
$productPath = '../signboard-and-signage-products-in-singapore-sg';
$industryPath = '../industry-solutions';
require __DIR__ . '/../includes/product-catalog.php';
require __DIR__ . '/../includes/back-lit-signboard-gallery.php';

$backLitHeroImage = $backLitGalleryItems[0]['image'] ?? '10-1636f324-7a2d-4750-bb6a-d57844bee52c.jpeg';
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => '3D Signboard Back-lit Signboard',
    'description' => $metaDescription,
    'url' => $siteBaseUrl . $canonicalPath,
    'mainEntity' => [
        '@type' => 'ItemList',
        'numberOfItems' => count($backLitGalleryItems),
        'itemListElement' => array_map(
            fn ($item, $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['title'],
                'image' => $siteBaseUrl . '/assets/images/back-lit-signboard/' . $item['image'],
            ],
            $backLitGalleryItems,
            array_keys($backLitGalleryItems)
        ),
    ],
];
$extraHead = <<<'HTML'
    <style>
        .back-lit-hero {
            position: relative;
            padding: 150px 0 72px;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
            overflow: hidden;
        }

        .back-lit-hero::before,
        .back-lit-gallery-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.035) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .back-lit-kicker {
            display: inline-flex;
            border: 1px solid var(--color-pure-black);
            padding: 0.45rem 0.8rem;
            background: var(--color-light-gray);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .back-lit-title {
            max-width: 11ch;
            font-size: clamp(2.65rem, 5vw, 4.9rem);
            line-height: 0.98;
        }

        .back-lit-copy {
            color: var(--color-dark-gray);
            line-height: 1.85;
        }

        .back-lit-hero-photo,
        .back-lit-stat,
        .back-lit-card {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .back-lit-hero-photo {
            aspect-ratio: 4 / 5;
            overflow: hidden;
        }

        .back-lit-hero-photo img,
        .back-lit-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .back-lit-section {
            padding: 4.5rem 0;
            border-bottom: 1px solid var(--color-pure-black);
        }

        .back-lit-gallery-section {
            position: relative;
            overflow: hidden;
        }

        .back-lit-gallery-section .container {
            position: relative;
            z-index: 1;
        }

        .back-lit-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .back-lit-stat {
            padding: 1.2rem;
        }

        .back-lit-stat strong {
            display: block;
            margin-bottom: 0.35rem;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            line-height: 1;
        }

        .back-lit-gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.4rem;
        }

        .back-lit-card {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .back-lit-card-media {
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-light-gray);
        }

        .back-lit-card-body {
            padding: 1.2rem;
        }

        .back-lit-card h3 {
            font-size: 1.05rem;
            line-height: 1.25;
        }

        @media (max-width: 991.98px) {
            .back-lit-gallery-grid,
            .back-lit-stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .back-lit-hero {
                padding-top: 132px;
            }

            .back-lit-gallery-grid,
            .back-lit-stat-grid {
                grid-template-columns: 1fr;
            }

            .back-lit-section {
                padding: 3.25rem 0;
            }
        }
    </style>
HTML;
require __DIR__ . '/../includes/header.php';
?>

    <header class="back-lit-hero">
        <div class="container position-relative z-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="back-lit-kicker">3D Signboard With Lighting</span>
                    <h1 class="back-lit-title mt-4 mb-4">Back-lit Signboard</h1>
                    <p class="back-lit-copy fs-5 mb-4">
                        Browse downloaded Back-lit Signboard examples from the source page, including halo-lit signage, illuminated lettering, and premium brand walls with rear-glow lighting.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#back-lit-gallery" class="btn-wb-solid">View Gallery</a>
                        <a href="../index.php#quote-form" class="btn-wb-outline">Request Quote</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="back-lit-hero-photo mb-0">
                        <img src="../assets/images/back-lit-signboard/<?php echo htmlspecialchars($backLitHeroImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Back-lit signboard example in Singapore">
                    </figure>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section class="back-lit-section bg-light">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Downloaded Items</span>
                        <h2 class="display-5 text-black mt-2 mb-3">Back-lit Project Gallery</h2>
                        <p class="back-lit-copy mb-0">
                            These back-lit examples are stored locally so the gallery loads from your site assets and stays available even without the source WordPress page.
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <div class="back-lit-stat-grid">
                            <div class="back-lit-stat">
                                <strong><?php echo count($backLitGalleryItems); ?></strong>
                                <span>Gallery images</span>
                            </div>
                            <div class="back-lit-stat">
                                <strong>Halo</strong>
                                <span>Rear-glow lighting</span>
                            </div>
                            <div class="back-lit-stat">
                                <strong>3D</strong>
                                <span>Raised lettering options</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="back-lit-gallery" class="back-lit-section back-lit-gallery-section">
            <div class="container">
                <div class="mb-4">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Examples</span>
                    <h2 class="display-5 text-black mt-2 mb-3">Back-lit Signboard Items</h2>
                </div>

                <div class="back-lit-gallery-grid">
<?php foreach ($backLitGalleryItems as $index => $item): ?>
                    <article class="back-lit-card">
                        <a class="back-lit-card-media" href="../assets/images/back-lit-signboard/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <img loading="lazy" src="../assets/images/back-lit-signboard/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        </a>
                        <div class="back-lit-card-body">
                            <span class="product-tag">Item <?php echo str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT); ?></span>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="back-lit-copy mb-0">Back-lit signboard reference image for glow effect, letter depth, material finish, and installation planning.</p>
                        </div>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="back-lit-section bg-black text-white">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="text-uppercase fw-bold text-white-50" style="font-size: 0.78rem; letter-spacing: 2px;">Ready To Quote</span>
                        <h2 class="display-5 text-white mt-2 mb-3">Send A Reference Item And Your Signboard Size.</h2>
                        <p class="mb-0 text-light-gray" style="line-height: 1.8;">Share the item number, preferred glow effect, dimensions, and installation location so we can recommend the right back-lit construction.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="../index.php#quote-form" class="btn-wb-outline text-white border-white">Get Quote</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
