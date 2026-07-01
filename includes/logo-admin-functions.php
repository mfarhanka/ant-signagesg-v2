<?php
function signage_logo_data_path(): string
{
    return __DIR__ . '/../data/logo-partners.json';
}

function signage_logo_upload_dir(): string
{
    return __DIR__ . '/../assets/images/trusted-brands';
}

function signage_default_logo_items(): array
{
    return [
        ['name' => 'Sentosa', 'type' => 'partner', 'image' => 'sentosa-logo.png', 'url' => '', 'sort_order' => 10, 'hidden' => false],
        ['name' => 'Moomoo', 'type' => 'partner', 'image' => 'moomoo-logo.png', 'url' => '', 'sort_order' => 20, 'hidden' => false],
        ['name' => 'MOS Burger', 'type' => 'partner', 'image' => 'mos-burger-logo.png', 'url' => '', 'sort_order' => 30, 'hidden' => false],
        ['name' => 'Yamaha', 'type' => 'partner', 'image' => 'yamaha-logo.png', 'url' => '', 'sort_order' => 40, 'hidden' => false],
        ['name' => 'Cainiao', 'type' => 'partner', 'image' => 'cainiao-logo.png', 'url' => '', 'sort_order' => 50, 'hidden' => false],
        ['name' => 'Singapore National Eye Centre', 'type' => 'partner', 'image' => 'singapore-national-eye-centre-logo.png', 'url' => '', 'sort_order' => 60, 'hidden' => false],
        ['name' => 'Tiger', 'type' => 'partner', 'image' => 'tiger-logo.png', 'url' => '', 'sort_order' => 70, 'hidden' => false],
        ['name' => 'UNIQLO', 'type' => 'partner', 'image' => 'uniqlo-logo.png', 'url' => '', 'sort_order' => 80, 'hidden' => false],
        ['name' => 'SBS Transit', 'type' => 'partner', 'image' => 'sbs-transit-logo.png', 'url' => '', 'sort_order' => 90, 'hidden' => false],
        ['name' => 'Nestle', 'type' => 'partner', 'image' => 'nestle-logo.png', 'url' => '', 'sort_order' => 100, 'hidden' => false],
    ];
}

function signage_normalize_logo_item(array $item, int $fallbackOrder = 0): array
{
    $type = strtolower(trim((string) ($item['type'] ?? 'partner')));

    return [
        'name' => trim((string) ($item['name'] ?? '')),
        'type' => in_array($type, ['sponsor', 'partner'], true) ? $type : 'partner',
        'image' => basename(trim((string) ($item['image'] ?? ''))),
        'url' => signage_logo_clean_url((string) ($item['url'] ?? '')),
        'sort_order' => (int) ($item['sort_order'] ?? $fallbackOrder),
        'hidden' => !empty($item['hidden']),
    ];
}

function signage_logo_clean_url(string $url): string
{
    $url = trim($url);

    if ($url === '') {
        return '';
    }

    $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));

    return in_array($scheme, ['http', 'https'], true) ? $url : '';
}

function signage_load_logo_items(): array
{
    $path = signage_logo_data_path();

    if (!is_file($path)) {
        return signage_default_logo_items();
    }

    $decoded = json_decode((string) file_get_contents($path), true);

    if (!is_array($decoded)) {
        return signage_default_logo_items();
    }

    $items = array_is_list($decoded) ? $decoded : ($decoded['items'] ?? []);

    if (!is_array($items)) {
        return signage_default_logo_items();
    }

    $normalized = [];

    foreach ($items as $index => $item) {
        if (!is_array($item)) {
            continue;
        }

        $normalized[] = signage_normalize_logo_item($item, ($index + 1) * 10);
    }

    usort($normalized, static function (array $a, array $b): int {
        return [$a['sort_order'], $a['name']] <=> [$b['sort_order'], $b['name']];
    });

    return $normalized;
}

function signage_save_logo_items(array $items): void
{
    $path = signage_logo_data_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $cleanItems = [];

    foreach ($items as $index => $item) {
        if (!is_array($item)) {
            continue;
        }

        $clean = signage_normalize_logo_item($item, ($index + 1) * 10);

        if ($clean['name'] === '' || $clean['image'] === '') {
            continue;
        }

        $cleanItems[] = $clean;
    }

    file_put_contents($path, json_encode(['items' => $cleanItems], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

function signage_visible_logo_items(?string $type = null): array
{
    return array_values(array_filter(signage_load_logo_items(), static function (array $item) use ($type): bool {
        if (!empty($item['hidden'])) {
            return false;
        }

        return $type === null || ($item['type'] ?? '') === $type;
    }));
}

function signage_admin_upload_logo_image(string $fieldName, ?string $fallback = null): string
{
    if (!isset($_FILES[$fieldName]) || ($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return $fallback ?? '';
    }

    if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Logo upload failed. Please try another file.');
    }

    $tmpPath = (string) $_FILES[$fieldName]['tmp_name'];
    $originalName = (string) $_FILES[$fieldName]['name'];
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];

    if (!in_array($extension, $allowedExtensions, true)) {
        throw new RuntimeException('Logo must be JPG, PNG, WebP, GIF, or SVG.');
    }

    if ($extension !== 'svg' && function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = $finfo ? finfo_file($finfo, $tmpPath) : '';

        if ($finfo) {
            finfo_close($finfo);
        }

        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true)) {
            throw new RuntimeException('Uploaded file does not appear to be a valid image.');
        }
    }

    $imageDir = signage_logo_upload_dir();

    if (!is_dir($imageDir)) {
        mkdir($imageDir, 0777, true);
    }

    $baseName = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', pathinfo($originalName, PATHINFO_FILENAME)), '-'));

    if ($baseName === '') {
        $baseName = 'logo';
    }

    $filename = $baseName . '.' . $extension;
    $targetPath = $imageDir . '/' . $filename;
    $counter = 2;

    while (is_file($targetPath)) {
        $filename = $baseName . '-' . $counter . '.' . $extension;
        $targetPath = $imageDir . '/' . $filename;
        $counter++;
    }

    if (!move_uploaded_file($tmpPath, $targetPath)) {
        throw new RuntimeException('Unable to save uploaded logo.');
    }

    return $filename;
}

function signage_logo_image_url(string $filename, string $prefix = 'assets'): string
{
    $filename = basename(trim($filename));

    return $filename === '' ? '' : rtrim($prefix, '/') . '/images/trusted-brands/' . rawurlencode($filename);
}
