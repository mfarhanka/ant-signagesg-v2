<?php

require __DIR__ . '/../includes/product-catalog.php';

$siteBaseUrl = 'https://signages.com.sg';
$today = date('Y-m-d');
$posts = require __DIR__ . '/../blog/includes/posts.php';

$urls = [
    ['path' => '/', 'lastmod' => $today, 'changefreq' => 'weekly', 'priority' => '1.0'],
    ['path' => '/industry-solutions', 'lastmod' => $today, 'changefreq' => 'monthly', 'priority' => '0.95'],
    ['path' => '/products', 'lastmod' => $today, 'changefreq' => 'weekly', 'priority' => '0.9'],
    ['path' => '/blog', 'lastmod' => $today, 'changefreq' => 'weekly', 'priority' => '0.8'],
];

foreach ($productGroupPaths as $groupPath) {
    $urls[] = [
        'path' => '/products/' . $groupPath,
        'lastmod' => $today,
        'changefreq' => 'monthly',
        'priority' => '0.82',
    ];
}

foreach ($productPagePaths as $productPath) {
    $urls[] = [
        'path' => '/products/' . $productPath,
        'lastmod' => $today,
        'changefreq' => 'monthly',
        'priority' => '0.76',
    ];
}

foreach ($posts as $post) {
    $urls[] = [
        'path' => '/blog/' . $post['slug'],
        'lastmod' => $post['published_date'],
        'changefreq' => 'monthly',
        'priority' => '0.7',
    ];
}

$seen = [];
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

foreach ($urls as $url) {
    $path = '/' . trim($url['path'], '/');
    $path = $path === '/' ? '/' : rtrim($path, '/');

    if (isset($seen[$path])) {
        continue;
    }

    $seen[$path] = true;
    $loc = htmlspecialchars(rtrim($siteBaseUrl, '/') . $path, ENT_XML1);
    $lastmod = htmlspecialchars($url['lastmod'], ENT_XML1);
    $changefreq = htmlspecialchars($url['changefreq'], ENT_XML1);
    $priority = htmlspecialchars($url['priority'], ENT_XML1);

    $xml .= "    <url>\n";
    $xml .= "        <loc>{$loc}</loc>\n";
    $xml .= "        <lastmod>{$lastmod}</lastmod>\n";
    $xml .= "        <changefreq>{$changefreq}</changefreq>\n";
    $xml .= "        <priority>{$priority}</priority>\n";
    $xml .= "    </url>\n";
}

$xml .= "</urlset>\n";

file_put_contents(__DIR__ . '/../sitemap.xml', $xml);

echo 'Wrote ' . count($seen) . " sitemap URLs.\n";
