<?php
require __DIR__ . '/product-catalog.php';

$productPageType = $productPageType ?? 'group';
$productGroupTitle = $productGroupTitle ?? '';
$productItemTitle = $productItemTitle ?? null;
$rootPrefix = $rootPrefix ?? '../';

$currentGroupProductItems = array_values(array_filter(
    $productItems,
    static fn (array $item): bool => $item['group'] === $productGroupTitle
));

$currentItem = null;

if ($productPageType === 'item' && $productItemTitle !== null) {
    foreach ($currentGroupProductItems as $item) {
        if ($item['title'] === $productItemTitle) {
            $currentItem = $item;
            break;
        }
    }

    if ($currentItem === null) {
        http_response_code(404);
        exit('Product item not found.');
    }
}

if ($productPageType === 'group' && $currentGroupProductItems === []) {
    http_response_code(404);
    exit('Product group not found.');
}

$pageHeading = $currentItem['title'] ?? $productGroupTitle;
$pageTitle = $pageHeading . ' in Singapore | Signage SG';
$navPage = 'products';
$metaDescription = $currentItem
    ? 'Explore ' . $currentItem['title'] . ' options in Singapore, including custom fabrication, materials, sizing, and installation support by Signage SG.'
    : 'Explore ' . $productGroupTitle . ' products in Singapore, including custom fabrication, materials, sizing, and installation support by Signage SG.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/products/' . ($currentItem ? $productPagePaths[$productGroupTitle . '|' . $currentItem['title']] : $productGroupPaths[$productGroupTitle]);
$heroItem = $currentItem ?? $currentGroupProductItems[0];
$ogImage = 'assets/images/products/' . $heroItem['image'];
$assetBase = $rootPrefix . 'assets';
$homePagePath = $rootPrefix . 'index.php';
$blogPath = $rootPrefix . 'blog';
$productPath = $productPageType === 'item' ? '../..' : '..';
$industryPath = $rootPrefix . 'industry-solutions';
$groupUrl = $productPath === '..' ? '.' : '..';
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => $currentItem ? 'Service' : 'CollectionPage',
    'name' => $pageHeading,
    'description' => $metaDescription,
    'url' => $siteBaseUrl . $canonicalPath,
    'image' => $siteBaseUrl . '/assets/images/products/' . $heroItem['image'],
];
$extraHead = <<<'HTML'
    <style>
        .product-detail-hero {
            position: relative;
            padding: 150px 0 84px;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
            overflow: hidden;
        }

        .product-detail-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.035) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .product-detail-kicker {
            display: inline-flex;
            border: 1px solid var(--color-pure-black);
            padding: 0.45rem 0.8rem;
            background: var(--color-light-gray);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .product-detail-title {
            max-width: 13ch;
            font-size: clamp(2.65rem, 5vw, 4.75rem);
            line-height: 0.98;
        }

        .product-detail-copy {
            color: var(--color-dark-gray);
            line-height: 1.85;
        }

        .product-detail-photo,
        .product-detail-panel,
        .product-detail-card {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .product-detail-photo {
            aspect-ratio: 4 / 5;
            overflow: hidden;
        }

        .product-detail-photo img,
        .product-detail-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-detail-section {
            padding: 4.5rem 0;
            border-bottom: 1px solid var(--color-pure-black);
        }

        .product-detail-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.4rem;
        }

        .product-detail-card-media {
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-light-gray);
        }

        .product-detail-card-body,
        .product-detail-panel {
            padding: 1.25rem;
        }

        .product-detail-card h3 {
            font-size: 1.08rem;
            line-height: 1.25;
        }

        @media (max-width: 991.98px) {
            .product-detail-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .product-detail-hero {
                padding-top: 132px;
            }

            .product-detail-grid {
                grid-template-columns: 1fr;
            }

            .product-detail-section {
                padding: 3.25rem 0;
            }
        }
    </style>
HTML;
require __DIR__ . '/header.php';
?>

    <header class="product-detail-hero">
        <div class="container position-relative z-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="product-detail-kicker"><?php echo htmlspecialchars($productGroupTitle, ENT_QUOTES, 'UTF-8'); ?></span>
                    <h1 class="product-detail-title mt-4 mb-4"><?php echo htmlspecialchars($pageHeading, ENT_QUOTES, 'UTF-8'); ?></h1>
                    <p class="product-detail-copy fs-5 mb-4">
                        <?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?php echo htmlspecialchars($homePagePath, ENT_QUOTES, 'UTF-8'); ?>#quote-form" class="btn-wb-solid">Request Quote</a>
                        <a href="<?php echo htmlspecialchars($productPath, ENT_QUOTES, 'UTF-8'); ?>" class="btn-wb-outline">All Products</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="product-detail-photo mb-0">
                        <img src="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/images/products/<?php echo htmlspecialchars($heroItem['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($pageHeading, ENT_QUOTES, 'UTF-8'); ?> example in Singapore">
                    </figure>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section class="product-detail-section bg-light">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Category</span>
                        <h2 class="display-5 text-black mt-2 mb-3"><?php echo htmlspecialchars($productGroupTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-detail-panel">
                            <p class="product-detail-copy mb-3">Use this page to collect references, compare available options, and prepare the basic project details needed for a quotation.</p>
                            <p class="product-detail-copy mb-0">Typical details to prepare: preferred size, installation location, material finish, lighting requirement, artwork file, and target completion date.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php if ($currentItem === null): ?>
        <section class="product-detail-section">
            <div class="container">
                <div class="mb-4">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Subcategories</span>
                    <h2 class="display-5 text-black mt-2 mb-3">Browse <?php echo htmlspecialchars($productGroupTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
                </div>
                <div class="product-detail-grid">
<?php foreach ($currentGroupProductItems as $productCardItem): ?>
<?php $itemPath = $productPagePaths[$productCardItem['group'] . '|' . $productCardItem['title']] ?? ''; ?>
<?php $itemHref = $itemPath !== '' ? '../' . $itemPath : '#'; ?>
                    <article class="product-detail-card">
                        <a class="product-detail-card-media" href="<?php echo htmlspecialchars($itemHref, ENT_QUOTES, 'UTF-8'); ?>">
                            <img loading="lazy" src="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/images/products/<?php echo htmlspecialchars($productCardItem['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($productCardItem['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        </a>
                        <div class="product-detail-card-body">
                            <span class="product-tag"><?php echo htmlspecialchars($productGroupTitle, ENT_QUOTES, 'UTF-8'); ?></span>
                            <h3><a class="text-black text-decoration-none" href="<?php echo htmlspecialchars($itemHref, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($productCardItem['title'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
                            <p class="product-detail-copy mb-0">Custom fabrication and installation support for <?php echo htmlspecialchars(strtolower($productCardItem['title']), ENT_QUOTES, 'UTF-8'); ?> projects.</p>
                        </div>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>
<?php else: ?>
        <section class="product-detail-section">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-5">
                        <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Product Scope</span>
                        <h2 class="display-5 text-black mt-2 mb-3">What This Page Covers</h2>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-detail-panel">
                            <p class="product-detail-copy mb-3"><?php echo htmlspecialchars($currentItem['title'], ENT_QUOTES, 'UTF-8'); ?> can be customized for sizing, materials, mounting, finishing, and installation site requirements.</p>
                            <p class="product-detail-copy mb-0">Original reference source: <a href="<?php echo htmlspecialchars($currentItem['source_url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">view source product page</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php endif; ?>

        <section class="product-detail-section bg-black text-white">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="text-uppercase fw-bold text-white-50" style="font-size: 0.78rem; letter-spacing: 2px;">Ready To Quote</span>
                        <h2 class="display-5 text-white mt-2 mb-3">Send Your Product Reference And Site Details.</h2>
                        <p class="mb-0 text-light-gray" style="line-height: 1.8;">Share the product type, rough dimensions, location, and preferred finish. Our team can recommend the right fabrication path.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="<?php echo htmlspecialchars($homePagePath, ENT_QUOTES, 'UTF-8'); ?>#quote-form" class="btn-wb-outline text-white border-white">Get Quote</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/footer.php'; ?>
