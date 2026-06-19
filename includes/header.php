<?php
$pageTitle = $pageTitle ?? 'Signage SG | Premium Architectural Fabricators Singapore';
$navPage = $navPage ?? 'home';
$metaDescription = $metaDescription ?? 'Signage SG designs, fabricates, and installs commercial signage in Singapore, including 3D lettering, lightboxes, acrylic signs, decals, and project coordination.';
$metaRobots = $metaRobots ?? 'index,follow';
$canonicalPath = $canonicalPath ?? ($_SERVER['PHP_SELF'] ?? '/');
$ogType = $ogType ?? 'website';
$ogImage = $ogImage ?? 'assets/images/logo.png';
$siteBaseUrl = $siteBaseUrl ?? 'https://signages.com.sg';
$assetBase = $assetBase ?? 'assets';
$homePagePath = $homePagePath ?? 'index.php';
$blogPath = $blogPath ?? 'blog';
$productPath = $productPath ?? 'signboard-and-signage-products-in-singapore-sg';
$structuredData = $structuredData ?? null;
$extraHead = $extraHead ?? '';

$isHomePage = $navPage === 'home';
$homeHref = $isHomePage ? '#hero' : $homePagePath . '#hero';
$quoteHref = $isHomePage ? '#quote-form' : $homePagePath . '#quote-form';
$estimatorHref = $isHomePage ? '#estimator' : $homePagePath . '#estimator';
$contactHref = $isHomePage ? '#location-map' : $homePagePath . '#location-map';
$productMenuHref = $productPath === '.' ? '#product-menu-structure' : $productPath . '#product-menu-structure';
$productFeaturedHref = $productPath === '.' ? '#product-range' : $productPath . '#product-range';
$productMenuGroups = [
    '3D Signboard With Lighting' => ['Front-lit Signboard', 'Back-lit Signboard', 'Whole-lit Signboard', 'Punch Hole Signboard', 'Light Bulb Signboard'],
    '3D Signboard With Non-Lighting' => ['Foamboard 3D Wording', 'Aluminium Box-Up 3D Wording', 'Acrylic 3D Wording'],
    'Lightbox' => ['Normal Lightbox', 'Aluminium Casing Lightbox', 'Soft Fabric Lightbox', 'Crystal Wording Lightbox'],
    '2D Signboard' => ['Normal Signboard', 'Aluminium Strip Signboard Base', 'Banner Signboard'],
    'Indoor Signage' => ['Foamboard 3D Wording Signage', 'Stainless Steel 3D Wording Signage', 'Acrylic 3D Wording', 'Acrylic Signage', 'Foamboard Signage'],
    'LED Displays' => ['LED Banner and Signage', 'LED Neon Signage', 'Pylon and Directional Signage'],
    'Billboard' => ['Billboard', 'Hoarding', 'Construction Board'],
    'Road Sign' => ['Roadsign Safety Signage', 'Directional Roadsign'],
    'Printing Services' => ['Label Sticker', 'Glass Window Sticker', 'Wall Sticker', 'Vehicle Sticker Wrapping'],
    'Exhibition Booth' => ['PVC Table Booth', 'Backdrop', 'Jumbo Banner', 'Pop-Up Backdrop Display System', 'Pop-Up Promotion Counter'],
    'Display Set' => ['Banner', 'Normal Roll-Up Bunting', 'Deluxe Roll-Up Bunting', 'Tripod/Round Plate Bunting', 'Human Stand', 'Easel Stand / Wood Stand', 'X-Stand', 'Door Bunting'],
    'Marketing Essential' => ['Namecard', 'Leaflet'],
];
$canonicalUrl = preg_match('#^https?://#i', $canonicalPath) ? $canonicalPath : rtrim($siteBaseUrl, '/') . '/' . ltrim($canonicalPath, '/');
$ogImageUrl = preg_match('#^https?://#i', $ogImage) ? $ogImage : rtrim($siteBaseUrl, '/') . '/' . ltrim($ogImage, '/');
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="<?php echo htmlspecialchars($metaRobots, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">

    <meta property="og:locale" content="en_SG">
    <meta property="og:type" content="<?php echo htmlspecialchars($ogType, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($ogImageUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="Signage SG">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($ogImageUrl, ENT_QUOTES, 'UTF-8'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" type="image/png" href="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/images/logo.png">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/css/style.css">
<?php if ($structuredData !== null): ?>
    <script type="application/ld+json"><?php echo json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?></script>
<?php endif; ?>
<?php echo $extraHead; ?>
</head>
<body class="d-flex flex-column h-full">

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo htmlspecialchars($homeHref, ENT_QUOTES, 'UTF-8'); ?>">
                <img src="<?php echo htmlspecialchars($assetBase, ENT_QUOTES, 'UTF-8'); ?>/images/logo.png" alt="Signage SG logo" style="width: 76px; height: auto;" class="flex-shrink-0">
                <div>
                    <span class="d-block h4 mb-0 fw-bold tracking-widest text-black display-font" style="letter-spacing: 1px;">SIGNAGE SG</span>
                    <span class="d-block text-uppercase text-muted" style="font-size: 0.55rem; letter-spacing: 3px; font-weight: 700;">ARCHITECTURAL SIGN CRAFTS</span>
                </div>
            </a>

            <button class="navbar-toggler border-1 border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mobile-nav-quote d-lg-none w-100 mt-3">
                <a href="<?php echo htmlspecialchars($quoteHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn-wb-solid btn-nav-quote w-100 text-center">Get Quote</a>
            </div>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1 gap-lg-4">
                    <li class="nav-item"><a class="nav-link<?php echo $isHomePage ? ' active' : ''; ?>" href="<?php echo htmlspecialchars($homeHref, ENT_QUOTES, 'UTF-8'); ?>">Home</a></li>
                    <li class="nav-item dropdown product-nav-item">
                        <a class="nav-link dropdown-toggle<?php echo $navPage === 'products' ? ' active' : ''; ?>" href="#" id="productsMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                        <div class="dropdown-menu product-mega-menu" aria-labelledby="productsMenu">
                            <div class="product-mega-inner">
                                <div class="product-mega-header">
                                    <div>
                                        <span class="product-mega-kicker">Product Menu</span>
                                        <strong>Browse by signage category</strong>
                                    </div>
                                    <div class="product-mega-actions">
                                        <a href="<?php echo htmlspecialchars($productPath, ENT_QUOTES, 'UTF-8'); ?>">Overview</a>
                                        <a href="<?php echo htmlspecialchars($productFeaturedHref, ENT_QUOTES, 'UTF-8'); ?>">Featured</a>
                                    </div>
                                </div>
                                <div class="product-mega-grid">
<?php foreach ($productMenuGroups as $groupTitle => $groupItems): ?>
                                    <section class="product-mega-group">
                                        <a class="product-mega-title" href="<?php echo htmlspecialchars($productMenuHref, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?></a>
                                        <ul>
<?php foreach ($groupItems as $groupItem): ?>
                                            <li><a href="<?php echo htmlspecialchars($productMenuHref, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($groupItem, ENT_QUOTES, 'UTF-8'); ?></a></li>
<?php endforeach; ?>
                                        </ul>
                                    </section>
<?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link<?php echo $navPage === 'blog' ? ' active' : ''; ?>" href="<?php echo htmlspecialchars($blogPath, ENT_QUOTES, 'UTF-8'); ?>">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($estimatorHref, ENT_QUOTES, 'UTF-8'); ?>">Cost Calculator</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo htmlspecialchars($contactHref, ENT_QUOTES, 'UTF-8'); ?>">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 navbar-cta-group">
                    <a href="https://wa.me/6582861600" class="text-black text-decoration-none d-none d-xl-inline-block fw-bold text-nowrap" style="font-size: 0.85rem;" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-phone me-1"></i>+65 8286 1600
                    </a>
                    <a href="<?php echo htmlspecialchars($quoteHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn-wb-solid btn-nav-quote d-none d-lg-inline-flex">Get Quote</a>
                </div>
            </div>
        </div>
    </nav>
