<?php
$posts = array_values(require __DIR__ . '/includes/posts.php');
usort($posts, static function (array $left, array $right): int {
    return strcmp($right['published_date'], $left['published_date']);
});

$featuredPost = $posts[0] ?? null;
$averageReadTime = 0;

if ($posts) {
    $totalReadMinutes = 0;

    foreach ($posts as $post) {
        if (preg_match('/(\d+)/', $post['read_time'], $matches) === 1) {
            $totalReadMinutes += (int) $matches[1];
        }
    }

    $averageReadTime = (int) round($totalReadMinutes / count($posts));
}

$pageTitle = 'Signage SG Blog | Signage Strategy, Compliance and Build Insights';
$navPage = 'blog';
$metaDescription = 'Read Signage SG insights on signage planning, compliance, fabrication timing, material choices, and rollout coordination for commercial projects in Singapore.';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/blog';
$ogType = 'website';
$ogImage = '../assets/images/logo.png';
$assetBase = '../assets';
$homePagePath = '../index.php';
$blogPath = '../blog';
$productPath = '../signboard-and-signage-products-in-singapore-sg';
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
    'blogPost' => array_map(static function (array $post) use ($siteBaseUrl): array {
        return [
            '@type' => 'BlogPosting',
            'headline' => $post['title'],
            'url' => $siteBaseUrl . '/blog/' . $post['slug'],
            'datePublished' => $post['published_date']
        ];
    }, $posts)
];
$extraHead = <<<'HTML'
    <style>
        .blog-hero {
            padding-top: 140px;
            padding-bottom: 72px;
            border-bottom: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .blog-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid var(--color-pure-black);
            padding: 0.45rem 0.8rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .blog-page-title {
            max-width: 12ch;
            font-size: clamp(2.5rem, 4vw, 4rem);
            line-height: 1;
        }

        .blog-page-copy {
            max-width: 40rem;
            font-size: 1rem;
            line-height: 1.75;
            color: var(--color-dark-gray);
        }

        .blog-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .blog-summary-item,
        .blog-feature-card,
        .blog-article-card,
        .blog-cta-panel {
            background: var(--color-pure-white);
            border: 1px solid var(--color-pure-black);
        }

        .blog-summary-item {
            padding: 0.7rem 1rem;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .blog-section {
            padding: 4rem 0;
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
        .blog-article-card,
        .blog-cta-panel {
            padding: 1.75rem;
        }

        .blog-feature-card,
        .blog-cta-panel {
            max-width: 56rem;
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

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
        }

        .blog-section-heading {
            max-width: 40rem;
            margin-bottom: 2rem;
        }

        .blog-section-heading p {
            margin-bottom: 0;
            color: var(--color-dark-gray);
            line-height: 1.75;
        }

        @media (max-width: 991.98px) {
            .blog-hero {
                padding-top: 132px;
                padding-bottom: 56px;
            }

            .blog-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
HTML;
require __DIR__ . '/../includes/header.php';
?>

    <header class="blog-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
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
                        <a href="../index.php#quote-form" class="btn-wb-outline">Discuss A Project</a>
                    </div>
                    <div class="blog-summary">
                        <div class="blog-summary-item"><?php echo count($posts); ?> articles</div>
                        <div class="blog-summary-item"><?php echo $averageReadTime; ?> min average read</div>
                        <div class="blog-summary-item">SG + JB coverage</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
<?php if ($featuredPost !== null): ?>
        <section class="blog-section">
            <div class="container">
                <span class="blog-section-kicker">Featured article</span>
                <article class="blog-feature-card">
                    <div class="blog-card-meta">
                        <span><?php echo htmlspecialchars($featuredPost['category'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span><?php echo htmlspecialchars($featuredPost['read_time'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <h2 class="blog-card-title"><?php echo htmlspecialchars($featuredPost['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p class="blog-card-copy">
                        <?php echo htmlspecialchars($featuredPost['summary'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <a href="<?php echo htmlspecialchars($featuredPost['slug'], ENT_QUOTES, 'UTF-8'); ?>" class="btn-wb-outline">Read Article</a>
                </article>
            </div>
        </section>
<?php endif; ?>

        <section id="latest-articles" class="blog-section">
            <div class="container">
                <div class="blog-section-heading">
                    <span class="blog-section-kicker">Latest articles</span>
                    <h2 class="h3 mb-3">Recent posts and practical guides.</h2>
                    <p>Browse the latest articles on signage planning, material choices, pricing, and project coordination.</p>
                </div>
                <div class="blog-grid">
<?php foreach ($posts as $post): ?>
                    <article class="blog-article-card">
                        <div class="blog-card-meta">
                            <span><?php echo htmlspecialchars($post['category'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span><?php echo htmlspecialchars($post['read_time'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <h2 class="blog-card-title"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="blog-card-copy">
                            <?php echo htmlspecialchars($post['card_summary'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <a href="<?php echo htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8'); ?>" class="btn-wb-outline">Read Article</a>
                    </article>
<?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="blog-section">
            <div class="container">
                <div class="blog-cta-panel">
                    <span class="blog-section-kicker">Need project advice?</span>
                    <h2 class="mb-3">Talk to the team about your next signage rollout.</h2>
                    <p class="blog-card-copy mb-4">
                        If you need pricing, material guidance, or help planning a site submission, get in touch and we can review the project with you.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="../index.php#quote-form" class="btn-wb-solid">Request A Quote</a>
                        <a href="https://wa.me/6582861600" class="btn-wb-outline" target="_blank" rel="noopener noreferrer">WhatsApp Mr. Gan (+65 8286 1600)</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
