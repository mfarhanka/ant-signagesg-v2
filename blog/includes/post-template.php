<?php

if (!isset($post) || !is_array($post)) {
    throw new RuntimeException('Blog post data is required.');
}

$pageTitle = $post['title'];
$navPage = 'blog';
$siteBaseUrl = 'https://signages.com.sg';
$canonicalPath = '/blog/' . $post['slug'];
$metaDescription = $post['meta_description'];
$ogType = 'article';
$ogImage = $post['og_image'];
$assetBase = '../../assets';
$homePagePath = '../../index.php';
$blogPath = '..';
$productPath = '../../signboard-and-signage-products-in-singapore-sg';
$industryPath = '../../industry-solutions';
$structuredData = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post['title'],
        'description' => $post['meta_description'],
        'image' => $post['schema_images'],
        'datePublished' => $post['published_date'],
        'dateModified' => $post['published_date'],
        'author' => [
            '@type' => 'Organization',
            'name' => $post['author']
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Signage SG',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $siteBaseUrl . '/assets/images/logo.png'
            ]
        ],
        'mainEntityOfPage' => $siteBaseUrl . $canonicalPath,
        'articleSection' => $post['guide_label'],
        'inLanguage' => $post['schema_language']
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(
            static function (array $faqItem): array {
                return [
                    '@type' => 'Question',
                    'name' => $faqItem['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => strip_tags($faqItem['answer'] . ' ' . ($faqItem['note'] ?? ''))
                    ]
                ];
            },
            $post['faq']
        )
    ]
];
$extraHead = <<<'HTML'
    <style>
        .article-hero {
            position: relative;
            padding: 150px 0 84px;
            border-bottom: 1px solid var(--color-pure-black);
            background:
                linear-gradient(135deg, rgba(0, 0, 0, 0.03) 0%, rgba(0, 0, 0, 0) 58%),
                var(--color-pure-white);
            overflow: hidden;
        }

        .article-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
            background-size: 44px 44px;
            pointer-events: none;
        }

        .article-shell {
            padding: 5rem 0;
        }

        .article-content {
            max-width: 860px;
            margin: 0 auto;
        }

        .article-kicker,
        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--color-dark-gray);
        }

        .article-title {
            max-width: 14ch;
            font-size: clamp(2.7rem, 5vw, 4.5rem);
            line-height: 1;
        }

        .article-lead,
        .article-copy,
        .article-faq-answer,
        .article-note {
            color: var(--color-dark-gray);
            line-height: 1.9;
        }

        .article-section {
            margin-top: 3rem;
        }

        .article-section h2,
        .article-section h3 {
            color: var(--color-pure-black);
            margin-bottom: 1rem;
        }

        .article-media-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
            margin-top: 1.75rem;
        }

        .article-figure,
        .article-comparison-card,
        .article-tip,
        .article-faq-item,
        .article-cta {
            border: 1px solid var(--color-pure-black);
            background: var(--color-pure-white);
        }

        .article-figure {
            overflow: hidden;
        }

        .article-figure img {
            width: 100%;
            display: block;
            aspect-ratio: 4 / 3;
            object-fit: cover;
        }

        .article-figure figcaption {
            padding: 1rem 1.1rem;
            font-size: 0.9rem;
            color: var(--color-dark-gray);
        }

        .article-comparison-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .article-comparison-card {
            padding: 1.5rem;
            height: 100%;
        }

        .article-comparison-label {
            display: inline-block;
            margin-bottom: 1rem;
            padding: 0.35rem 0.75rem;
            border: 1px solid var(--color-pure-black);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .article-comparison-list,
        .article-faq-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0 0;
        }

        .article-comparison-list li,
        .article-faq-item {
            padding-top: 0.9rem;
            margin-top: 0.9rem;
            border-top: 1px solid var(--color-subtle-border);
        }

        .article-comparison-list li:first-child {
            padding-top: 0;
            margin-top: 0;
            border-top: 0;
        }

        .article-tip,
        .article-note,
        .article-cta {
            padding: 1.5rem;
        }

        .article-faq-item {
            padding: 1.4rem;
            margin-top: 1rem;
            border-top: 0;
        }

        .article-faq-question {
            margin-bottom: 0.75rem;
            font-size: 1.15rem;
        }

        .article-cta {
            margin-top: 3rem;
        }

        @media (max-width: 991.98px) {
            .article-hero {
                padding: 132px 0 72px;
            }

            .article-media-grid,
            .article-comparison-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
HTML;
require __DIR__ . '/../../includes/header.php';
?>

    <header class="article-hero">
        <div class="container position-relative" style="z-index: 1;">
            <div class="article-content">
                <div class="article-kicker mb-4">
                    <span><?php echo htmlspecialchars($post['author'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span><?php echo htmlspecialchars($post['location'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span><?php echo htmlspecialchars($post['guide_label'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <h1 class="article-title mb-4"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="article-lead mb-4"><?php echo $post['hero_lead']; ?></p>
                <div class="article-meta">
                    <span><?php echo htmlspecialchars($post['published_label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span><?php echo htmlspecialchars($post['read_time'], ENT_QUOTES, 'UTF-8'); ?></span>
<?php foreach ($post['meta_tags'] as $metaTag): ?>
                    <span><?php echo htmlspecialchars($metaTag, ENT_QUOTES, 'UTF-8'); ?></span>
<?php endforeach; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <section class="article-shell">
            <div class="container">
                <article class="article-content">
<?php foreach ($post['sections'] as $index => $section): ?>
                    <section class="article-section<?php echo $index === 0 ? ' mt-0' : ''; ?>">
                        <h2><?php echo htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
<?php if ($section['type'] === 'content'): ?>
<?php foreach ($section['paragraphs'] as $paragraph): ?>
                        <p class="article-copy"><?php echo $paragraph; ?></p>
<?php endforeach; ?>
<?php if (!empty($section['media'])): ?>
                        <div class="article-media-grid">
<?php foreach ($section['media'] as $media): ?>
                            <figure class="article-figure">
                                <img src="<?php echo htmlspecialchars($media['src'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($media['alt'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                <figcaption><?php echo htmlspecialchars($media['caption'], ENT_QUOTES, 'UTF-8'); ?></figcaption>
                            </figure>
<?php endforeach; ?>
                        </div>
<?php endif; ?>
<?php elseif ($section['type'] === 'comparison'): ?>
                        <div class="article-comparison-grid">
<?php foreach ($section['cards'] as $card): ?>
                            <div class="article-comparison-card">
                                <span class="article-comparison-label"><?php echo htmlspecialchars($card['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <h3><?php echo htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
<?php if (isset($card['items'])): ?>
                                <ul class="article-comparison-list article-copy">
<?php foreach ($card['items'] as $item): ?>
                                    <li><?php echo $item; ?></li>
<?php endforeach; ?>
                                </ul>
<?php else: ?>
                                <p class="article-copy mb-0"><?php echo htmlspecialchars($card['copy'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
                            </div>
<?php endforeach; ?>
                        </div>
<?php elseif ($section['type'] === 'decision'): ?>
<?php foreach ($section['choices'] as $choice): ?>
                        <h3><?php echo htmlspecialchars($choice['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="article-copy"><?php echo $choice['copy']; ?></p>
<?php endforeach; ?>
                        <div class="article-tip mt-4">
                            <h3><?php echo htmlspecialchars($section['tip']['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="article-copy mb-0"><?php echo $section['tip']['copy']; ?></p>
                        </div>
<?php endif; ?>
                    </section>
<?php endforeach; ?>

                    <section class="article-section">
                        <h2>Frequently asked questions</h2>
                        <div class="article-faq-list">
<?php foreach ($post['faq'] as $faqItem): ?>
                            <div class="article-faq-item">
                                <h3 class="article-faq-question"><?php echo htmlspecialchars($faqItem['question'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="article-faq-answer mb-0"><?php echo $faqItem['answer']; ?></p>
<?php if (!empty($faqItem['note'])): ?>
                                <p class="article-note mt-3 mb-0"><?php echo $faqItem['note']; ?></p>
<?php endif; ?>
                            </div>
<?php endforeach; ?>
                        </div>
                    </section>

                    <section class="article-cta">
                        <h2 class="mb-3"><?php echo htmlspecialchars($post['cta']['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="article-copy mb-4"><?php echo htmlspecialchars($post['cta']['copy'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="d-flex flex-wrap gap-3">
<?php foreach ($post['cta']['buttons'] as $button): ?>
                            <a href="<?php echo htmlspecialchars($button['href'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars($button['class'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($button['label'], ENT_QUOTES, 'UTF-8'); ?></a>
<?php endforeach; ?>
                        </div>
                    </section>
                </article>
            </div>
        </section>
    </main>

<?php require __DIR__ . '/../../includes/footer.php'; ?>
