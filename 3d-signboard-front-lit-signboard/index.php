<?php
$pageTitle = '3D Signboard Front-lit Signboard in Singapore | Signage SG';
$navPage = 'products';
$metaDescription = 'View front-lit 3D signboard examples in Singapore, including aluminium box-up letters, acrylic faces, LED modules, ACP bases, and shopfront signboard projects.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/3d-signboard-front-lit-signboard';
$ogImage = 'assets/images/front-lit-signboard/43-3961b93d-7092-4bc7-bda0-706c53ce5df8-1.jpeg';
$assetBase = '../assets';
$homePagePath = '../index.php';
$blogPath = '../blog';
$productPath = '../signboard-and-signage-products-in-singapore-sg';
$industryPath = '../industry-solutions';
require __DIR__ . '/../includes/product-catalog.php';
require __DIR__ . '/../includes/front-lit-signboard-gallery.php';

$frontLitHeroImage = $frontLitGalleryItems[0]['image'] ?? '43-3961b93d-7092-4bc7-bda0-706c53ce5df8-1.jpeg';
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => '3D Signboard Front-lit Signboard',
    'description' => $metaDescription,
    'url' => $siteBaseUrl . $canonicalPath,
    'mainEntity' => [
        '@type' => 'ItemList',
        'numberOfItems' => count($frontLitGalleryItems),
        'itemListElement' => array_map(
            fn ($item, $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['title'],
                'image' => $siteBaseUrl . '/assets/images/front-lit-signboard/' . $item['image'],
            ],
            $frontLitGalleryItems,
            array_keys($frontLitGalleryItems)
        ),
    ],
];
$extraHead = <<<'HTML'
    <style>
        .front-lit-hero {
            position: relative;
            padding: 150px 0 72px;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
            overflow: hidden;
        }

        .front-lit-hero::before,
        .front-lit-gallery-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.035) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .front-lit-kicker {
            display: inline-flex;
            border: 1px solid var(--color-pure-black);
            padding: 0.45rem 0.8rem;
            background: var(--color-light-gray);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .front-lit-title {
            max-width: 11ch;
            font-size: clamp(2.65rem, 5vw, 4.9rem);
            line-height: 0.98;
        }

        .front-lit-copy {
            color: var(--color-dark-gray);
            line-height: 1.85;
        }

        .front-lit-hero-photo,
        .front-lit-stat,
        .front-lit-card,
        .front-lit-spec-panel {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .front-lit-hero-photo {
            aspect-ratio: 4 / 5;
            overflow: hidden;
        }

        .front-lit-hero-photo img,
        .front-lit-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .front-lit-section {
            padding: 4.5rem 0;
            border-bottom: 1px solid var(--color-pure-black);
        }

        .front-lit-gallery-section {
            position: relative;
            overflow: hidden;
        }

        .front-lit-gallery-section .container {
            position: relative;
            z-index: 1;
        }

        .front-lit-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .front-lit-stat {
            padding: 1.2rem;
        }

        .front-lit-stat strong {
            display: block;
            margin-bottom: 0.35rem;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            line-height: 1;
        }

        .front-lit-gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.4rem;
        }

        .front-lit-card {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .front-lit-card-media {
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-light-gray);
        }

        .front-lit-card-body {
            padding: 1.2rem;
        }

        .front-lit-card h3 {
            font-size: 1.05rem;
            line-height: 1.25;
        }

        .front-lit-spec-list {
            padding-left: 1.05rem;
            margin: 0;
            color: var(--color-dark-gray);
            line-height: 1.7;
        }

        .front-lit-spec-panel {
            padding: 1.5rem;
        }

        @media (max-width: 991.98px) {
            .front-lit-gallery-grid,
            .front-lit-stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .front-lit-hero {
                padding-top: 132px;
            }

            .front-lit-gallery-grid,
            .front-lit-stat-grid {
                grid-template-columns: 1fr;
            }

            .front-lit-section {
                padding: 3.25rem 0;
            }
        }
    </style>
HTML;
require __DIR__ . '/../includes/header.php';
?>

    <header class="front-lit-hero">
        <div class="container position-relative z-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="front-lit-kicker">3D Signboard With Lighting</span>
                    <h1 class="front-lit-title mt-4 mb-4">Front-lit Signboard</h1>
                    <p class="front-lit-copy fs-5 mb-4">
                        Browse downloaded Front-lit Signboard examples from the source gallery, including aluminium box-up letters, acrylic faces, LED lighting, ACP bases, stickers, and shopfront installations.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#front-lit-gallery" class="btn-wb-solid">View Gallery</a>
                        <a href="../index.php#quote-form" class="btn-wb-outline">Request Quote</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="front-lit-hero-photo mb-0">
                        <img src="../assets/images/front-lit-signboard/<?php echo htmlspecialchars($frontLitHeroImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Front-lit signboard example in Singapore">
                    </figure>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section class="front-lit-section bg-light">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Downloaded Items</span>
                        <h2 class="display-5 text-black mt-2 mb-3">Front-lit Project Gallery</h2>
                        <p class="front-lit-copy mb-0">
                            These examples are stored locally so the page loads from your own site assets instead of depending on the source WordPress gallery.
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <div class="front-lit-stat-grid">
                            <div class="front-lit-stat">
                                <strong><?php echo count($frontLitGalleryItems); ?></strong>
                                <span>Gallery images</span>
                            </div>
                            <div class="front-lit-stat">
                                <strong>LED</strong>
                                <span>Front illumination</span>
                            </div>
                            <div class="front-lit-stat">
                                <strong>3D</strong>
                                <span>Box-up lettering options</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="front-lit-gallery" class="front-lit-section front-lit-gallery-section">
            <div class="container">
                <div class="mb-4">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Examples</span>
                    <h2 class="display-5 text-black mt-2 mb-3">Front-lit Signboard Items</h2>
                </div>

                <div class="front-lit-gallery-grid">
<?php foreach ($frontLitGalleryItems as $index => $item): ?>
                    <article class="front-lit-card">
                        <a class="front-lit-card-media" href="../assets/images/front-lit-signboard/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <img loading="lazy" src="../assets/images/front-lit-signboard/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        </a>
                        <div class="front-lit-card-body">
                            <span class="product-tag">Item <?php echo str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT); ?></span>
                            <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
<?php if ($item['description'] !== ''): ?>
                            <ul class="front-lit-spec-list">
<?php foreach (array_filter(array_map('trim', explode("\n", $item['description']))) as $line): ?>
                                <li><?php echo htmlspecialchars(ltrim($line, '- '), ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
                            </ul>
<?php else: ?>
                            <p class="front-lit-copy mb-0">Front-lit signboard reference image for material, lighting, shape, and installation planning.</p>
<?php endif; ?>
                        </div>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="front-lit-section bg-black text-white">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="text-uppercase fw-bold text-white-50" style="font-size: 0.78rem; letter-spacing: 2px;">Ready To Quote</span>
                        <h2 class="display-5 text-white mt-2 mb-3">Send A Reference Item And Your Signboard Size.</h2>
                        <p class="mb-0 text-light-gray" style="line-height: 1.8;">Share the item number, preferred material, dimensions, and installation location so we can recommend the right front-lit construction.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="../index.php#quote-form" class="btn-wb-outline text-white border-white">Get Quote</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
