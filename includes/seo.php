<?php

if (!function_exists('signage_seo_absolute_url')) {
    function signage_seo_absolute_url(string $path, string $siteBaseUrl = 'https://signages.com.sg'): string
    {
        if (preg_match('#^https?://#i', $path) === 1) {
            return $path;
        }

        $path = preg_replace('#^(\.\./)+#', '', $path) ?? $path;
        $path = preg_replace('#^\./#', '', $path) ?? $path;

        return rtrim($siteBaseUrl, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('signage_seo_canonical_path')) {
    function signage_seo_canonical_path(string $path): string
    {
        if (preg_match('#^https?://#i', $path) === 1) {
            return rtrim($path, '/');
        }

        $pathOnly = parse_url($path, PHP_URL_PATH);
        $normalized = '/' . ltrim((string) $pathOnly, '/');
        $normalized = preg_replace('#/index\.php$#', '/', $normalized) ?? $normalized;
        $normalized = preg_replace('#(?<!^)/$#', '', $normalized) ?? $normalized;

        return $normalized === '' ? '/' : $normalized;
    }
}

if (!function_exists('signage_seo_organization_schema')) {
    function signage_seo_organization_schema(string $siteBaseUrl = 'https://signages.com.sg'): array
    {
        return [
            '@type' => 'LocalBusiness',
            '@id' => rtrim($siteBaseUrl, '/') . '/#organization',
            'name' => 'Signage SG',
            'url' => rtrim($siteBaseUrl, '/') . '/',
            'logo' => rtrim($siteBaseUrl, '/') . '/assets/images/logo.png',
            'image' => rtrim($siteBaseUrl, '/') . '/assets/images/logo.png',
            'telephone' => '+65 8286 1600',
            'email' => 'antadv.gan@gmail.com',
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '601 Ang Mo Kio Avenue 5',
                'addressLocality' => 'Singapore',
                'postalCode' => '560601',
                'addressCountry' => 'SG',
            ],
            'openingHoursSpecification' => [[
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '09:00',
                'closes' => '18:00',
            ]],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Singapore',
            ],
            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'telephone' => '+65 8286 1600',
                'contactType' => 'sales',
                'areaServed' => 'SG',
                'availableLanguage' => ['English'],
            ]],
            'sameAs' => [
                'https://wa.me/6582861600',
            ],
        ];
    }
}

if (!function_exists('signage_seo_webpage_schema')) {
    function signage_seo_webpage_schema(string $pageTitle, string $metaDescription, string $canonicalUrl, string $siteBaseUrl = 'https://signages.com.sg'): array
    {
        $webPageIdBase = str_ends_with($canonicalUrl, '/') ? $canonicalUrl : rtrim($canonicalUrl, '/');

        return [
            '@type' => 'WebPage',
            '@id' => $webPageIdBase . '#webpage',
            'url' => $canonicalUrl,
            'name' => $pageTitle,
            'description' => $metaDescription,
            'inLanguage' => 'en-SG',
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => rtrim($siteBaseUrl, '/') . '/#website',
                'name' => 'Signage SG',
                'url' => rtrim($siteBaseUrl, '/') . '/',
            ],
            'publisher' => [
                '@id' => rtrim($siteBaseUrl, '/') . '/#organization',
            ],
        ];
    }
}

if (!function_exists('signage_seo_schema_graph')) {
    function signage_seo_schema_graph(array $pageSchemas, string $pageTitle, string $metaDescription, string $canonicalUrl, string $siteBaseUrl = 'https://signages.com.sg'): array
    {
        $schemas = [
            signage_seo_organization_schema($siteBaseUrl),
            [
                '@type' => 'WebSite',
                '@id' => rtrim($siteBaseUrl, '/') . '/#website',
                'name' => 'Signage SG',
                'url' => rtrim($siteBaseUrl, '/') . '/',
                'publisher' => [
                    '@id' => rtrim($siteBaseUrl, '/') . '/#organization',
                ],
                'inLanguage' => 'en-SG',
            ],
            signage_seo_webpage_schema($pageTitle, $metaDescription, $canonicalUrl, $siteBaseUrl),
        ];

        foreach ($pageSchemas as $schema) {
            if (is_array($schema) && $schema !== []) {
                unset($schema['@context']);
                $schemas[] = $schema;
            }
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $schemas,
        ];
    }
}
