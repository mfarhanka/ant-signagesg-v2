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
            position: relative;
            display: block;
            width: 100%;
            padding: 0;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-bottom: 1px solid var(--color-pure-black);
            border-left: 0;
            border-right: 0;
            border-top: 0;
            background: var(--color-light-gray);
            cursor: zoom-in;
        }

        .product-detail-card-body,
        .product-detail-panel {
            padding: 1.25rem;
        }

        .product-detail-card h3 {
            font-size: 1.08rem;
            line-height: 1.25;
        }

        .product-entry-description {
            white-space: pre-line;
        }

        .product-entry-whatsapp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            margin-top: 1rem;
            padding: 0.7rem 0.95rem;
            border: 1px solid #16a34a;
            background: #16a34a;
            color: var(--color-pure-white);
            font-size: 0.78rem;
            font-weight: 800;
            line-height: 1;
            text-decoration: none;
            text-transform: uppercase;
        }

        .product-entry-whatsapp:hover,
        .product-entry-whatsapp:focus {
            background: #0f8a3a;
            border-color: #0f8a3a;
            color: var(--color-pure-white);
        }

        .product-photo-modal {
            position: fixed;
            inset: 0;
            z-index: 1100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            background: rgba(0, 0, 0, 0.78);
        }

        .product-photo-modal.is-open {
            display: flex;
        }

        .product-photo-modal-dialog {
            width: min(980px, 100%);
            max-height: 92vh;
            border: 1px solid var(--color-pure-white);
            background: var(--color-pure-white);
            overflow: hidden;
        }

        .product-photo-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--color-pure-black);
        }

        .product-photo-modal-title {
            margin: 0;
            font-size: 1rem;
        }

        .product-photo-modal-close {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
            color: var(--color-pure-black);
            padding: 0.55rem 0.8rem;
            font-weight: 700;
        }

        .product-photo-modal-body {
            padding: 1rem;
            background: var(--color-light-gray);
        }

        .product-photo-modal-body img {
            display: block;
            width: 100%;
            max-height: 76vh;
            object-fit: contain;
            background: var(--color-pure-white);
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

            .product-photo-modal {
                padding: 0.75rem;
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
<?php $productEntries = isset($currentItem['entries']) && is_array($currentItem['entries']) ? array_values(array_filter($currentItem['entries'], static fn (array $entry): bool => empty($entry['hidden']))) : []; ?>
<?php if ($productEntries !== []): ?>
        <section class="product-detail-section bg-light">
            <div class="container">
                <div class="mb-4">
                    <span class="text-uppercase tracking-wider text-muted fw-bold" style="font-size: 0.78rem; letter-spacing: 2px;">Items</span>
                    <h2 class="display-5 text-black mt-2 mb-3"><?php echo htmlspecialchars($currentItem['title'], ENT_QUOTES, 'UTF-8'); ?> Items</h2>
                </div>
                <div class="product-detail-grid">
<?php foreach ($productEntries as $entry): ?>
<?php $entryTitle = (string) ($entry['title'] ?? 'Product Item'); ?>
<?php $entryDescription = trim((string) ($entry['description'] ?? '')); ?>
<?php if ($entryDescription === ''): ?>
<?php $entryDescription = 'Reference item for ' . strtolower($currentItem['title']) . ' fabrication and installation planning.'; ?>
<?php endif; ?>
<?php $entryWhatsappUrl = 'https://wa.me/6582861600?text=' . rawurlencode('Hi Signage SG, I am interested in ' . $entryTitle . ' under ' . $currentItem['title'] . '.'); ?>
                    <article class="product-detail-card">
                        <button type="button" class="product-detail-card-media" data-product-photo="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/images/products/<?php echo htmlspecialchars($entry['image'] ?? $currentItem['image'], ENT_QUOTES, 'UTF-8'); ?>" data-product-photo-title="<?php echo htmlspecialchars($entryTitle, ENT_QUOTES, 'UTF-8'); ?>">
                            <img loading="lazy" src="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/images/products/<?php echo htmlspecialchars($entry['image'] ?? $currentItem['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($entry['title'] ?? $currentItem['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        </button>
                        <div class="product-detail-card-body">
                            <span class="product-tag"><?php echo htmlspecialchars($currentItem['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <h3><?php echo htmlspecialchars($entryTitle, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="product-detail-copy product-entry-description mb-0"><?php echo htmlspecialchars($entryDescription, ENT_QUOTES, 'UTF-8'); ?></p>
                            <a class="product-entry-whatsapp" href="<?php echo htmlspecialchars($entryWhatsappUrl, ENT_QUOTES, 'UTF-8'); ?>" title="Whatsapp Us" target="_blank" rel="noopener noreferrer">Whatsapp Us</a>
                        </div>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>
<?php endif; ?>
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

    <div class="product-photo-modal" id="productPhotoModal" aria-hidden="true">
        <div class="product-photo-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="productPhotoModalTitle">
            <div class="product-photo-modal-header">
                <h2 class="product-photo-modal-title" id="productPhotoModalTitle">Product Photo</h2>
                <button type="button" class="product-photo-modal-close" data-product-photo-close>Close</button>
            </div>
            <div class="product-photo-modal-body">
                <img src="" alt="" id="productPhotoModalImage">
            </div>
        </div>
    </div>

    <script>
        (() => {
            const modal = document.getElementById('productPhotoModal');
            const image = document.getElementById('productPhotoModalImage');
            const title = document.getElementById('productPhotoModalTitle');

            if (!modal || !image || !title) {
                return;
            }

            const closeModal = () => {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
                image.src = '';
                image.alt = '';
            };

            document.addEventListener('click', (event) => {
                const trigger = event.target.closest('[data-product-photo]');

                if (trigger) {
                    title.textContent = trigger.dataset.productPhotoTitle || 'Product Photo';
                    image.src = trigger.dataset.productPhoto;
                    image.alt = trigger.dataset.productPhotoTitle || 'Product photo preview';
                    modal.classList.add('is-open');
                    modal.setAttribute('aria-hidden', 'false');
                    return;
                }

                if (event.target === modal || event.target.matches('[data-product-photo-close]')) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                    closeModal();
                }
            });
        })();
    </script>

<?php require __DIR__ . '/footer.php'; ?>
