<?php
require_once __DIR__ . '/product-catalog.php';

function signage_catalog_json_path(): string
{
    return __DIR__ . '/../data/product-catalog.json';
}

function signage_products_root(): string
{
    return __DIR__ . '/../products';
}

function signage_load_catalog_for_admin(): array
{
    global $productMenuGroups, $productItems;

    return [
        'groups' => $productMenuGroups,
        'items' => $productItems,
    ];
}

function signage_save_catalog_for_admin(array $groups, array $items): void
{
    $path = signage_catalog_json_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $payload = [
        'groups' => $groups,
        'items' => array_values($items),
    ];

    file_put_contents($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

function signage_catalog_find_item(array $items, string $group, string $title): ?array
{
    foreach ($items as $item) {
        if (($item['group'] ?? '') === $group && ($item['title'] ?? '') === $title) {
            return $item;
        }
    }

    return null;
}

function signage_admin_safe_join(string $base, string $relative): string
{
    $base = rtrim(str_replace('\\', '/', $base), '/');
    $relative = trim(str_replace('\\', '/', $relative), '/');
    $path = $base . ($relative === '' ? '' : '/' . $relative);
    $parts = [];

    foreach (explode('/', $path) as $part) {
        if ($part === '' || $part === '.') {
            continue;
        }

        if ($part === '..') {
            array_pop($parts);
            continue;
        }

        $parts[] = $part;
    }

    return (str_starts_with($path, '/') ? '/' : '') . implode('/', $parts);
}

function signage_admin_remove_dir(string $dir, string $base): void
{
    $resolvedBase = realpath($base);
    $resolvedDir = realpath($dir);

    if ($resolvedBase === false || $resolvedDir === false || !str_starts_with(str_replace('\\', '/', $resolvedDir), str_replace('\\', '/', $resolvedBase))) {
        return;
    }

    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($resolvedDir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($items as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }

    rmdir($resolvedDir);
}

function signage_rebuild_product_folders(array $groups, array $items): void
{
    $baseDir = signage_products_root();

    if (!is_dir($baseDir)) {
        mkdir($baseDir, 0777, true);
    }

    $groupPaths = [];
    $validDirs = [''];

    foreach (array_keys($groups) as $groupTitle) {
        $groupSlug = signage_product_anchor($groupTitle);
        $groupPaths[$groupTitle] = $groupSlug;
        $validDirs[] = $groupSlug;
        $groupDir = signage_admin_safe_join($baseDir, $groupSlug);

        if (!is_dir($groupDir)) {
            mkdir($groupDir, 0777, true);
        }

        $groupIndex = "<?php\n"
            . "\$productPageType = 'group';\n"
            . "\$productGroupTitle = " . var_export($groupTitle, true) . ";\n"
            . "\$rootPrefix = '../../';\n"
            . "require __DIR__ . '/../../includes/product-page-template.php';\n";

        file_put_contents($groupDir . '/index.php', $groupIndex);
    }

    foreach ($items as $item) {
        $groupTitle = $item['group'] ?? '';
        $title = $item['title'] ?? '';

        if ($groupTitle === '' || $title === '' || !isset($groupPaths[$groupTitle])) {
            continue;
        }

        $itemSlug = signage_product_source_slug($item['source_url'] ?? '', $title);
        $relativePath = $groupPaths[$groupTitle] . '/' . $itemSlug;
        $validDirs[] = $relativePath;
        $itemDir = signage_admin_safe_join($baseDir, $relativePath);

        if (!is_dir($itemDir)) {
            mkdir($itemDir, 0777, true);
        }

        $itemIndex = "<?php\n"
            . "\$productPageType = 'item';\n"
            . "\$productGroupTitle = " . var_export($groupTitle, true) . ";\n"
            . "\$productItemTitle = " . var_export($title, true) . ";\n"
            . "\$rootPrefix = '../../../';\n"
            . "require __DIR__ . '/../../../includes/product-page-template.php';\n";

        file_put_contents($itemDir . '/index.php', $itemIndex);
    }

    $validMap = array_fill_keys($validDirs, true);
    $directories = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($baseDir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($directories as $directory) {
        if (!$directory->isDir()) {
            continue;
        }

        $relative = trim(str_replace('\\', '/', substr($directory->getPathname(), strlen($baseDir))), '/');

        if ($relative !== '' && !isset($validMap[$relative]) && substr_count($relative, '/') <= 1) {
            signage_admin_remove_dir($directory->getPathname(), $baseDir);
        }
    }
}
