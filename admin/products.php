<?php
if (PHP_SAPI !== 'cli') {
    session_start();
} else {
    $_SESSION = [];
}

require __DIR__ . '/../includes/product-admin-functions.php';

$adminPassword = getenv('SIGNAGE_ADMIN_PASSWORD') ?: 'admin123';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$message = (string) ($_SESSION['product_admin_message'] ?? '');
$error = (string) ($_SESSION['product_admin_error'] ?? '');
unset($_SESSION['product_admin_message'], $_SESSION['product_admin_error']);

function signage_admin_upload_product_image(string $fieldName, ?string $fallback = null): string
{
    if (!isset($_FILES[$fieldName]) || ($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return $fallback ?? 'foamboard-signage-singapore.jpeg';
    }

    if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Image upload failed. Please try another file.');
    }

    $tmpPath = (string) $_FILES[$fieldName]['tmp_name'];
    $originalName = (string) $_FILES[$fieldName]['name'];
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (!in_array($extension, $allowedExtensions, true)) {
        throw new RuntimeException('Image must be JPG, PNG, WebP, or GIF.');
    }

    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = $finfo ? finfo_file($finfo, $tmpPath) : '';

        if ($finfo) {
            finfo_close($finfo);
        }

        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true)) {
            throw new RuntimeException('Uploaded file does not appear to be a valid image.');
        }
    }

    $imageDir = __DIR__ . '/../assets/images/products';

    if (!is_dir($imageDir)) {
        mkdir($imageDir, 0777, true);
    }

    $baseName = signage_product_anchor(pathinfo($originalName, PATHINFO_FILENAME));

    if ($baseName === '') {
        $baseName = 'product-image';
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
        throw new RuntimeException('Unable to save uploaded image.');
    }

    return $filename;
}

function signage_admin_product_image_url(?string $filename): string
{
    $filename = trim((string) $filename);

    return $filename === '' ? '' : '../assets/images/products/' . rawurlencode($filename);
}

function signage_admin_find_category_preview_image(array $items, string $groupTitle): string
{
    foreach ($items as $item) {
        if (($item['group'] ?? '') === $groupTitle && !empty($item['image'])) {
            return (string) $item['image'];
        }

        if (($item['group'] ?? '') !== $groupTitle || empty($item['entries']) || !is_array($item['entries'])) {
            continue;
        }

        foreach ($item['entries'] as $entry) {
            if (!empty($entry['image'])) {
                return (string) $entry['image'];
            }
        }
    }

    return '';
}

function signage_admin_count_entries(array $items, ?string $groupTitle = null): array
{
    $total = 0;
    $hidden = 0;

    foreach ($items as $item) {
        if ($groupTitle !== null && ($item['group'] ?? '') !== $groupTitle) {
            continue;
        }

        if (empty($item['entries']) || !is_array($item['entries'])) {
            continue;
        }

        foreach ($item['entries'] as $entry) {
            $total++;

            if (!empty($entry['hidden'])) {
                $hidden++;
            }
        }
    }

    return [
        'total' => $total,
        'hidden' => $hidden,
        'visible' => $total - $hidden,
    ];
}

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: products.php');
    exit;
}

if ($requestMethod === 'POST' && ($_POST['action'] ?? '') === 'login') {
    if (hash_equals($adminPassword, (string) ($_POST['password'] ?? ''))) {
        $_SESSION['product_admin'] = true;
        header('Location: products.php');
        exit;
    }

    $error = 'Invalid password.';
}

$isLoggedIn = !empty($_SESSION['product_admin']);

if ($isLoggedIn && $requestMethod === 'POST') {
    $catalog = signage_load_catalog_for_admin();
    $groups = $catalog['groups'];
    $items = $catalog['items'];
    $action = (string) ($_POST['action'] ?? '');

    try {
        if ($action === 'add_category') {
            $title = trim((string) ($_POST['title'] ?? ''));

            if ($title === '') {
                throw new RuntimeException('Category title is required.');
            }

            if (isset($groups[$title])) {
                throw new RuntimeException('Category already exists.');
            }

            $groups[$title] = [];
            $message = 'Category added.';
        }

        if ($action === 'rename_category') {
            $oldTitle = (string) ($_POST['old_title'] ?? '');
            $newTitle = trim((string) ($_POST['new_title'] ?? ''));

            if ($oldTitle === '' || $newTitle === '') {
                throw new RuntimeException('Category titles are required.');
            }

            if (!isset($groups[$oldTitle])) {
                throw new RuntimeException('Category not found.');
            }

            if ($oldTitle !== $newTitle && isset($groups[$newTitle])) {
                throw new RuntimeException('New category title already exists.');
            }

            $newGroups = [];

            foreach ($groups as $groupTitle => $groupItems) {
                $newGroups[$groupTitle === $oldTitle ? $newTitle : $groupTitle] = $groupItems;
            }

            foreach ($items as &$item) {
                if (($item['group'] ?? '') === $oldTitle) {
                    $item['group'] = $newTitle;
                }
            }
            unset($item);

            $groups = $newGroups;
            $message = 'Category renamed.';
        }

        if ($action === 'delete_category') {
            $title = (string) ($_POST['title'] ?? '');

            if (!isset($groups[$title])) {
                throw new RuntimeException('Category not found.');
            }

            unset($groups[$title]);
            $items = array_values(array_filter($items, static fn (array $item): bool => ($item['group'] ?? '') !== $title));
            $message = 'Category and its subcategories removed.';
        }

        if ($action === 'add_product') {
            $group = (string) ($_POST['group'] ?? '');
            $title = trim((string) ($_POST['title'] ?? ''));
            $slug = signage_product_anchor(trim((string) ($_POST['slug'] ?? '')) ?: $title);
            $sourceUrl = trim((string) ($_POST['source_url'] ?? ''));

            if (!isset($groups[$group])) {
                throw new RuntimeException('Category not found.');
            }

            if ($title === '') {
                throw new RuntimeException('Subcategory title is required.');
            }

            if (in_array($title, $groups[$group], true)) {
                throw new RuntimeException('Subcategory already exists in this category.');
            }

            $groups[$group][] = $title;
            $image = signage_admin_upload_product_image('image_upload');
            $items[] = [
                'title' => $title,
                'group' => $group,
                'slug' => $slug,
                'image' => $image,
                'source_url' => $sourceUrl,
            ];
            $message = 'Subcategory added.';
        }

        if ($action === 'update_product') {
            $oldGroup = (string) ($_POST['old_group'] ?? '');
            $oldTitle = (string) ($_POST['old_title'] ?? '');
            $newGroup = (string) ($_POST['group'] ?? $oldGroup);
            $newTitle = trim((string) ($_POST['title'] ?? ''));
            $newSlug = signage_product_anchor(trim((string) ($_POST['slug'] ?? '')) ?: $newTitle);

            if (!isset($groups[$oldGroup], $groups[$newGroup]) || $newTitle === '') {
                throw new RuntimeException('Valid category and subcategory title are required.');
            }

            foreach ($groups as $groupTitle => &$groupItems) {
                $groupItems = array_values(array_filter($groupItems, static fn (string $itemTitle): bool => !($groupTitle === $oldGroup && $itemTitle === $oldTitle)));
            }
            unset($groupItems);

            if (!in_array($newTitle, $groups[$newGroup], true)) {
                $groups[$newGroup][] = $newTitle;
            }

            $matchedIndex = null;

            foreach ($items as $index => $item) {
                if (($item['group'] ?? '') === $oldGroup && ($item['title'] ?? '') === $oldTitle) {
                    $matchedIndex = $index;
                    break;
                }
            }

            if ($matchedIndex === null) {
                foreach ($items as $index => $item) {
                    if (($item['group'] ?? '') === $newGroup && ($item['title'] ?? '') === $newTitle) {
                        $matchedIndex = $index;
                        break;
                    }
                }
            }

            if ($matchedIndex === null) {
                $items[] = [
                    'title' => $newTitle,
                    'group' => $newGroup,
                    'slug' => $newSlug,
                    'image' => signage_admin_upload_product_image('image_upload', trim((string) ($_POST['existing_image'] ?? '')) ?: 'foamboard-signage-singapore.jpeg'),
                    'source_url' => trim((string) ($_POST['source_url'] ?? '')),
                ];
            } else {
                $items[$matchedIndex]['group'] = $newGroup;
                $items[$matchedIndex]['title'] = $newTitle;
                $items[$matchedIndex]['slug'] = $newSlug;
                $items[$matchedIndex]['image'] = signage_admin_upload_product_image('image_upload', trim((string) ($_POST['existing_image'] ?? '')) ?: ($items[$matchedIndex]['image'] ?? 'foamboard-signage-singapore.jpeg'));
                $items[$matchedIndex]['source_url'] = trim((string) ($_POST['source_url'] ?? ''));
            }

            $seenProductKeys = [];
            $items = array_values(array_filter($items, static function (array $item) use (&$seenProductKeys): bool {
                $key = ($item['group'] ?? '') . '|' . ($item['title'] ?? '');

                if (isset($seenProductKeys[$key])) {
                    return false;
                }

                $seenProductKeys[$key] = true;
                return true;
            }));

            $message = 'Subcategory updated.';
        }

        if ($action === 'delete_product') {
            $group = (string) ($_POST['group'] ?? '');
            $title = (string) ($_POST['title'] ?? '');

            if (isset($groups[$group])) {
                $groups[$group] = array_values(array_filter($groups[$group], static fn (string $itemTitle): bool => $itemTitle !== $title));
            }

            $items = array_values(array_filter($items, static fn (array $item): bool => !(($item['group'] ?? '') === $group && ($item['title'] ?? '') === $title)));
            $message = 'Subcategory removed.';
        }

        if ($action === 'add_product_entry') {
            $group = (string) ($_POST['group'] ?? '');
            $title = (string) ($_POST['title'] ?? '');
            $entryTitle = trim((string) ($_POST['entry_title'] ?? ''));
            $entryDescription = trim((string) ($_POST['entry_description'] ?? ''));

            if ($group === '' || $title === '' || $entryTitle === '') {
                throw new RuntimeException('Item title is required.');
            }

            $entryImage = signage_admin_upload_product_image('entry_image_upload');

            foreach ($items as &$item) {
                if (($item['group'] ?? '') === $group && ($item['title'] ?? '') === $title) {
                    if (!isset($item['entries']) || !is_array($item['entries'])) {
                        $item['entries'] = [];
                    }

                    $item['entries'][] = [
                        'title' => $entryTitle,
                        'image' => $entryImage,
                        'description' => $entryDescription,
                        'hidden' => empty($_POST['entry_visible']),
                    ];
                    break;
                }
            }
            unset($item);

            $message = 'Item added.';
        }

        if ($action === 'update_product_entry') {
            $group = (string) ($_POST['group'] ?? '');
            $title = (string) ($_POST['title'] ?? '');
            $entryIndex = (int) ($_POST['entry_index'] ?? -1);
            $entryTitle = trim((string) ($_POST['entry_title'] ?? ''));
            $entryDescription = trim((string) ($_POST['entry_description'] ?? ''));

            if ($group === '' || $title === '' || $entryIndex < 0 || $entryTitle === '') {
                throw new RuntimeException('Valid item details are required.');
            }

            foreach ($items as &$item) {
                if (($item['group'] ?? '') === $group && ($item['title'] ?? '') === $title && isset($item['entries'][$entryIndex])) {
                    $existingImage = trim((string) ($_POST['existing_entry_image'] ?? '')) ?: ($item['entries'][$entryIndex]['image'] ?? 'foamboard-signage-singapore.jpeg');
                    $item['entries'][$entryIndex] = [
                        'title' => $entryTitle,
                        'image' => signage_admin_upload_product_image('entry_image_upload', $existingImage),
                        'description' => $entryDescription,
                        'hidden' => empty($_POST['entry_visible']),
                    ];
                    break;
                }
            }
            unset($item);

            $message = 'Item updated.';
        }

        if ($action === 'delete_product_entry') {
            $group = (string) ($_POST['group'] ?? '');
            $title = (string) ($_POST['title'] ?? '');
            $entryIndex = (int) ($_POST['entry_index'] ?? -1);

            foreach ($items as &$item) {
                if (($item['group'] ?? '') === $group && ($item['title'] ?? '') === $title && isset($item['entries'][$entryIndex])) {
                    array_splice($item['entries'], $entryIndex, 1);
                    break;
                }
            }
            unset($item);

            $message = 'Item removed.';
        }

        if ($message !== '') {
            signage_save_catalog_for_admin($groups, $items);
            signage_rebuild_product_folders($groups, $items);
            $_SESSION['product_admin_message'] = $message;
            header('Location: products.php');
            exit;
        }
    } catch (Throwable $exception) {
        $_SESSION['product_admin_error'] = $exception->getMessage();
        header('Location: products.php');
        exit;
    }
}

$catalog = signage_load_catalog_for_admin();
$groups = $catalog['groups'];
$items = $catalog['items'];
$entryTotals = signage_admin_count_entries($items);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Admin | Signage SG</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f5f7; color: #111; }
        header, main { width: min(1760px, calc(100% - 32px)); margin: 0 auto; }
        header { position: sticky; top: 0; z-index: 20; display: flex; justify-content: space-between; align-items: center; gap: 16px; padding: 18px 0; background: #f4f5f7; border-bottom: 1px solid #d8dce2; }
        main { padding: 22px 0 32px; }
        h1, h2, h3 { margin: 0 0 12px; }
        h1 { font-size: 28px; }
        h2 { font-size: 18px; }
        h3 { font-size: 16px; }
        a { color: #111; }
        .admin-links { display: inline-flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 700; }
        .panel { background: #fff; border: 1px solid #cfd4dc; padding: 18px; margin-bottom: 18px; border-radius: 6px; box-shadow: 0 1px 2px rgba(17, 24, 39, .04); }
        .quick-panels { display: grid; grid-template-columns: minmax(280px, .85fr) minmax(520px, 1.6fr); gap: 16px; align-items: start; }
        .metric-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; margin-bottom: 18px; }
        .metric { background: #fff; border: 1px solid #cfd4dc; border-radius: 6px; padding: 14px; }
        .metric strong { display: block; font-size: 24px; line-height: 1; }
        .metric span { display: block; margin-top: 7px; color: #555; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; }
        .section-heading { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px; }
        .category { border: 1px solid #cfd4dc; margin-top: 12px; background: #fff; border-radius: 6px; overflow: hidden; }
        .category summary { display: flex; justify-content: space-between; gap: 16px; align-items: center; padding: 16px; cursor: pointer; font-weight: 700; background: #fff; }
        .category summary::-webkit-details-marker { display: none; }
        .category summary::before { content: "+"; display: inline-flex; width: 26px; height: 26px; align-items: center; justify-content: center; border: 1px solid #111; margin-right: 10px; flex-shrink: 0; }
        .category[open] summary::before { content: "-"; }
        .category-summary-title { display: flex; align-items: center; min-width: 0; }
        .category-summary-title span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .category-summary-actions { display: inline-flex; align-items: center; gap: 8px; flex-wrap: wrap; justify-content: flex-end; flex-shrink: 0; }
        .category-count { flex-shrink: 0; border: 1px solid #111; padding: 5px 8px; font-size: 12px; font-family: monospace; background: #fff; }
        .category-count.is-muted { border-color: #b6bdc8; color: #555; }
        .category-count.is-hidden { border-color: #a40000; color: #a40000; }
        .category-body { padding: 16px; border-top: 1px solid #d8dce2; background: #fbfcfd; }
        .category-admin { display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: end; margin-bottom: 14px; padding: 14px; border: 1px solid #d8dce2; background: #fff; border-radius: 6px; }
        .item { border: 1px solid #d8dce2; padding: 14px; margin-top: 12px; background: #fff; border-radius: 6px; }
        .item-header { display: flex; justify-content: space-between; gap: 12px; align-items: flex-start; margin-bottom: 12px; }
        .item-title { margin: 0; font-size: 15px; }
        .subitem-panel { margin-top: 12px; border: 1px solid #d8dce2; background: #fafafa; border-radius: 6px; overflow: hidden; }
        .subitem-panel summary { display: flex; justify-content: space-between; align-items: center; gap: 12px; padding: 12px 14px; cursor: pointer; font-weight: 700; background: #eef1f5; }
        .subitem-panel-body { padding: 14px; border-top: 1px solid #d8dce2; }
        .entry { padding: 12px; margin-top: 12px; border: 1px solid #d8dce2; background: #fff; border-radius: 6px; }
        .entry-form { display: grid; grid-template-columns: minmax(220px, 1fr) minmax(240px, 1fr) minmax(280px, 1.2fr) minmax(150px, .7fr) auto; gap: 10px; align-items: end; }
        .row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; align-items: end; }
        .row.compact { grid-template-columns: minmax(180px, 1fr) auto; }
        .row.subcategory-form { grid-template-columns: minmax(220px, 1.1fr) minmax(220px, 1fr) minmax(260px, 1fr) minmax(220px, 1fr) auto; }
        .row.add-entry-form { grid-template-columns: minmax(220px, 1fr) minmax(240px, 1fr) minmax(280px, 1.2fr) minmax(150px, .7fr) auto; }
        .action-row { display: flex; justify-content: flex-end; gap: 8px; margin-top: 10px; }
        label { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        input, select, textarea { width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #aeb6c2; border-radius: 4px; background: #fff; }
        input[type="checkbox"] { width: auto; }
        textarea { min-height: 84px; resize: vertical; }
        button { min-height: 40px; padding: 10px 14px; border: 1px solid #111; border-radius: 4px; background: #111; color: #fff; cursor: pointer; font-weight: 700; white-space: nowrap; }
        button.link-button { padding: 0; border: 0; background: transparent; color: #555; text-decoration: underline; font-size: 13px; }
        button.photo-thumb { display: inline-flex; width: 58px; height: 44px; min-height: 0; padding: 0; border: 1px solid #111; background: #fff; overflow: hidden; flex-shrink: 0; }
        button.photo-thumb img { display: block; width: 100%; height: 100%; object-fit: cover; }
        button.category-photo-thumb { width: 46px; height: 34px; }
        .image-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-top: 6px; }
        .visibility-toggle { display: inline-flex; align-items: center; gap: 8px; min-height: 42px; text-transform: none; letter-spacing: 0; font-size: 14px; }
        .visibility-status { display: inline-flex; align-items: center; min-height: 24px; padding: 0 8px; border: 1px solid #111; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        .visibility-status.is-hidden { border-color: #a40000; color: #a40000; }
        button.secondary { background: #fff; color: #111; }
        button.danger { background: #a40000; border-color: #a40000; }
        .message { border: 1px solid #187a35; background: #e9f8ee; padding: 12px; margin-bottom: 16px; }
        .error { border: 1px solid #a40000; background: #fff0f0; padding: 12px; margin-bottom: 16px; }
        .muted { color: #555; font-size: 13px; }
        .image-modal { position: fixed; inset: 0; z-index: 1000; display: none; align-items: center; justify-content: center; padding: 24px; background: rgba(0, 0, 0, .72); }
        .image-modal.is-open { display: flex; }
        .image-modal-dialog { width: min(920px, 100%); max-height: 92vh; background: #fff; border: 1px solid #111; overflow: hidden; }
        .image-modal-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 12px 14px; border-bottom: 1px solid #111; }
        .image-modal-title { margin: 0; font-size: 16px; }
        .image-modal-close { background: #fff; color: #111; }
        .image-modal-body { padding: 14px; background: #f6f6f6; }
        .image-modal-body img { display: block; width: 100%; max-height: 74vh; object-fit: contain; background: #fff; border: 1px solid #ddd; }
        @media (max-width: 1180px) { .quick-panels, .metric-grid, .category-admin, .row, .row.compact, .row.subcategory-form, .row.add-entry-form, .entry-form { grid-template-columns: 1fr; } }
        @media (max-width: 900px) { header, main { width: min(100% - 24px, 1760px); } header { position: static; align-items: flex-start; flex-direction: column; padding: 16px 0; } main { padding: 16px 0; } .category summary, .subitem-panel summary { align-items: flex-start; flex-direction: column; } .category-summary-actions { justify-content: flex-start; } .action-row { justify-content: flex-start; flex-wrap: wrap; } }
    </style>
</head>
<body>
<?php if (!$isLoggedIn): ?>
    <main>
        <section class="panel" style="max-width: 420px; margin: 80px auto;">
            <h1>Product Admin</h1>
            <p class="muted">Default password is <strong>admin123</strong>. Set <code>SIGNAGE_ADMIN_PASSWORD</code> on production.</p>
<?php if ($error !== ''): ?>
            <div class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>
            <form method="post">
                <input type="hidden" name="action" value="login">
                <label>Password</label>
                <input type="password" name="password" required>
                <p><button type="submit">Login</button></p>
            </form>
        </section>
    </main>
<?php else: ?>
    <header>
        <div>
            <h1>Product Admin</h1>
            <p class="muted"><?php echo count($groups); ?> categories, <?php echo count($items); ?> subcategories, <?php echo (int) $entryTotals['total']; ?> product-page items</p>
        </div>
        <div class="admin-links">
            <a href="../products" target="_blank">View Products</a>
            <a href="?logout=1">Logout</a>
        </div>
    </header>
    <main>
<?php if ($message !== ''): ?>
        <div class="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>
<?php if ($error !== ''): ?>
        <div class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
<?php endif; ?>
        <section class="metric-grid" aria-label="Catalog summary">
            <div class="metric"><strong><?php echo count($groups); ?></strong><span>Categories</span></div>
            <div class="metric"><strong><?php echo count($items); ?></strong><span>Subcategories</span></div>
            <div class="metric"><strong><?php echo (int) $entryTotals['visible']; ?></strong><span>Visible Items</span></div>
            <div class="metric"><strong><?php echo (int) $entryTotals['hidden']; ?></strong><span>Hidden Items</span></div>
        </section>

        <div class="quick-panels">
        <section class="panel">
            <h2>Add Category</h2>
            <form method="post" class="row compact">
                <input type="hidden" name="action" value="add_category">
                <div><label>Category Title</label><input name="title" required></div>
                <div><button type="submit">Add Category</button></div>
            </form>
        </section>

        <section class="panel">
            <h2>Add Subcategory</h2>
            <form method="post" class="row" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_product">
                <div>
                    <label>Parent Category</label>
                    <select name="group" required>
<?php foreach (array_keys($groups) as $groupTitle): ?>
                        <option value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?></option>
<?php endforeach; ?>
                    </select>
                </div>
                <div><label>Subcategory Title</label><input name="title" required></div>
                <div><label>SEO Slug</label><input name="slug" placeholder="front-lit-signboard"></div>
                <div><label>Upload Image</label><input type="file" name="image_upload" accept="image/jpeg,image/png,image/webp,image/gif"></div>
                <div><label>Reference URL</label><input name="source_url" placeholder="https://..."></div>
                <div><button type="submit">Add Subcategory</button></div>
            </form>
        </section>
        </div>

        <section class="panel">
            <div class="section-heading">
                <h2>Manage Categories</h2>
                <span class="muted">Open a category to edit subcategories and product-page items.</span>
            </div>
<?php foreach ($groups as $groupTitle => $groupItemTitles): ?>
<?php $categoryPreviewImage = signage_admin_find_category_preview_image($items, $groupTitle); ?>
<?php $categoryEntryTotals = signage_admin_count_entries($items, $groupTitle); ?>
            <details class="category">
                <summary>
                    <span class="category-summary-title"><span><?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?></span></span>
                    <span class="category-summary-actions">
<?php if ($categoryPreviewImage !== ''): ?>
                        <button type="button" class="photo-thumb category-photo-thumb" aria-label="View category photo for <?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>" data-image-preview="<?php echo htmlspecialchars(signage_admin_product_image_url($categoryPreviewImage), ENT_QUOTES, 'UTF-8'); ?>" data-image-title="<?php echo htmlspecialchars($groupTitle . ' category photo', ENT_QUOTES, 'UTF-8'); ?>">
                            <img loading="lazy" src="<?php echo htmlspecialchars(signage_admin_product_image_url($categoryPreviewImage), ENT_QUOTES, 'UTF-8'); ?>" alt="">
                        </button>
<?php endif; ?>
                        <span class="category-count"><?php echo count($groupItemTitles); ?> subcategories</span>
                        <span class="category-count is-muted"><?php echo (int) $categoryEntryTotals['visible']; ?> visible</span>
                        <span class="category-count is-hidden"><?php echo (int) $categoryEntryTotals['hidden']; ?> hidden</span>
                    </span>
                </summary>
                <div class="category-body">
                <div class="category-admin">
                <form method="post" class="row compact">
                    <input type="hidden" name="action" value="rename_category">
                    <input type="hidden" name="old_title" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                    <div><label>Category</label><input name="new_title" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>" required></div>
                    <div><button type="submit" class="secondary">Rename</button></div>
                </form>
                <form method="post" onsubmit="return confirm('Delete this category and all subcategories?');">
                    <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" class="danger">Delete Category</button>
                </form>
                </div>

<?php foreach ($groupItemTitles as $itemTitle): ?>
<?php $productItem = signage_catalog_find_item($items, $groupTitle, $itemTitle) ?? ['title' => $itemTitle, 'group' => $groupTitle, 'image' => '', 'source_url' => '']; ?>
<?php $productEntries = isset($productItem['entries']) && is_array($productItem['entries']) ? $productItem['entries'] : []; ?>
<?php $productEntryTotal = count($productEntries); ?>
<?php $productHiddenTotal = count(array_filter($productEntries, static fn (array $entry): bool => !empty($entry['hidden']))); ?>
<?php $productSlug = signage_product_anchor((string) ($productItem['slug'] ?? '')) ?: signage_product_source_slug($productItem['source_url'] ?? '', $itemTitle); ?>
<?php $productImageUrl = signage_admin_product_image_url($productItem['image'] ?? ''); ?>
                <div class="item">
                    <div class="item-header">
                        <h3 class="item-title"><?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <span class="category-summary-actions">
                            <span class="category-count"><?php echo (int) $productEntryTotal; ?> items</span>
                            <span class="category-count is-muted"><?php echo (int) ($productEntryTotal - $productHiddenTotal); ?> visible</span>
                            <span class="category-count is-hidden"><?php echo (int) $productHiddenTotal; ?> hidden</span>
                        </span>
                    </div>
                    <form method="post" class="row subcategory-form" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="update_product">
                        <input type="hidden" name="old_group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="old_title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($productItem['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <div><label>Subcategory</label><input name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>" required></div>
                        <div><label>SEO Slug</label><input name="slug" value="<?php echo htmlspecialchars($productSlug, ENT_QUOTES, 'UTF-8'); ?>" required></div>
                        <div>
                            <label>Replace Image</label>
                            <input type="file" name="image_upload" accept="image/jpeg,image/png,image/webp,image/gif">
                            <span class="image-meta">
                                <span class="muted">Current: <?php echo htmlspecialchars($productItem['image'] ?? 'none', ENT_QUOTES, 'UTF-8'); ?></span>
<?php if (!empty($productItem['image'])): ?>
                                <button type="button" class="photo-thumb" aria-label="View subcategory photo for <?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>" data-image-preview="<?php echo htmlspecialchars($productImageUrl, ENT_QUOTES, 'UTF-8'); ?>" data-image-title="<?php echo htmlspecialchars($itemTitle . ' subcategory photo', ENT_QUOTES, 'UTF-8'); ?>">
                                    <img loading="lazy" src="<?php echo htmlspecialchars($productImageUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                                </button>
<?php endif; ?>
                            </span>
                        </div>
                        <div><label>Reference URL</label><input name="source_url" value="<?php echo htmlspecialchars($productItem['source_url'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
                        <div><button type="submit" class="secondary">Save Subcategory</button></div>
                    </form>
                    <form method="post" class="action-row" onsubmit="return confirm('Delete this subcategory?');">
                        <input type="hidden" name="action" value="delete_product">
                        <input type="hidden" name="group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit" class="danger">Delete Subcategory</button>
                    </form>
                    <details class="subitem-panel">
                        <summary>
                            <span>Product-page items under <?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="category-summary-actions">
                                <span class="category-count"><?php echo (int) $productEntryTotal; ?> total</span>
                                <span class="category-count is-muted"><?php echo (int) ($productEntryTotal - $productHiddenTotal); ?> visible</span>
                                <span class="category-count is-hidden"><?php echo (int) $productHiddenTotal; ?> hidden</span>
                            </span>
                        </summary>
                        <div class="subitem-panel-body">
                            <form method="post" class="row add-entry-form" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="add_product_entry">
                                <input type="hidden" name="group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                <div><label>Item Title</label><input name="entry_title" required></div>
                                <div><label>Upload Item Image</label><input type="file" name="entry_image_upload" accept="image/jpeg,image/png,image/webp,image/gif"></div>
                                <div><label>Description</label><textarea name="entry_description"></textarea></div>
                                <div>
                                    <label>Visibility</label>
                                    <label class="visibility-toggle"><input type="checkbox" name="entry_visible" value="1" checked> Show item</label>
                                </div>
                                <div><button type="submit">Add Item</button></div>
                            </form>

<?php foreach ($productEntries as $entryIndex => $entry): ?>
<?php $entryImageUrl = signage_admin_product_image_url($entry['image'] ?? ''); ?>
<?php $entryIsHidden = !empty($entry['hidden']); ?>
                            <div class="entry">
                                <form method="post" class="entry-form" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="update_product_entry">
                                    <input type="hidden" name="group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="entry_index" value="<?php echo (int) $entryIndex; ?>">
                                    <input type="hidden" name="existing_entry_image" value="<?php echo htmlspecialchars($entry['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                    <div><label>Item Title</label><input name="entry_title" value="<?php echo htmlspecialchars($entry['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></div>
                                    <div>
                                        <label>Replace Item Image</label>
                                        <input type="file" name="entry_image_upload" accept="image/jpeg,image/png,image/webp,image/gif">
                                        <span class="image-meta">
                                            <span class="muted">Current: <?php echo htmlspecialchars($entry['image'] ?? 'none', ENT_QUOTES, 'UTF-8'); ?></span>
<?php if (!empty($entry['image'])): ?>
                                            <button type="button" class="photo-thumb" aria-label="View item photo for <?php echo htmlspecialchars($entry['title'] ?? 'Product item', ENT_QUOTES, 'UTF-8'); ?>" data-image-preview="<?php echo htmlspecialchars($entryImageUrl, ENT_QUOTES, 'UTF-8'); ?>" data-image-title="<?php echo htmlspecialchars(($entry['title'] ?? 'Product item') . ' photo', ENT_QUOTES, 'UTF-8'); ?>">
                                                <img loading="lazy" src="<?php echo htmlspecialchars($entryImageUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                                            </button>
<?php endif; ?>
                                        </span>
                                    </div>
                                    <div><label>Description</label><textarea name="entry_description"><?php echo htmlspecialchars($entry['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
                                    <div>
                                        <label>Visibility</label>
                                        <label class="visibility-toggle"><input type="checkbox" name="entry_visible" value="1"<?php echo $entryIsHidden ? '' : ' checked'; ?>> Show item</label>
                                        <span class="visibility-status<?php echo $entryIsHidden ? ' is-hidden' : ''; ?>"><?php echo $entryIsHidden ? 'Hidden' : 'Visible'; ?></span>
                                    </div>
                                    <div><button type="submit" class="secondary">Save Item</button></div>
                                </form>
                                <form method="post" class="action-row" onsubmit="return confirm('Delete this item?');">
                                    <input type="hidden" name="action" value="delete_product_entry">
                                    <input type="hidden" name="group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="entry_index" value="<?php echo (int) $entryIndex; ?>">
                                    <button type="submit" class="danger">Delete Item</button>
                                </form>
                            </div>
<?php endforeach; ?>
                        </div>
                    </details>
                </div>
<?php endforeach; ?>
                </div>
            </details>
<?php endforeach; ?>
        </section>
    </main>
<?php endif; ?>
    <div class="image-modal" id="imagePreviewModal" aria-hidden="true">
        <div class="image-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="imagePreviewTitle">
            <div class="image-modal-header">
                <h2 class="image-modal-title" id="imagePreviewTitle">Image Preview</h2>
                <button type="button" class="image-modal-close" data-image-preview-close>Close</button>
            </div>
            <div class="image-modal-body">
                <img src="" alt="" id="imagePreviewImg">
            </div>
        </div>
    </div>
    <script>
        const imageModal = document.getElementById('imagePreviewModal');
        const imagePreview = document.getElementById('imagePreviewImg');
        const imageTitle = document.getElementById('imagePreviewTitle');

        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-image-preview]');

            if (trigger) {
                event.preventDefault();
                event.stopPropagation();
                imagePreview.src = trigger.dataset.imagePreview;
                imagePreview.alt = trigger.dataset.imageTitle || 'Product image preview';
                imageTitle.textContent = trigger.dataset.imageTitle || 'Image Preview';
                imageModal.classList.add('is-open');
                imageModal.setAttribute('aria-hidden', 'false');
                return;
            }

            if (event.target.matches('[data-image-preview-close]') || event.target === imageModal) {
                imageModal.classList.remove('is-open');
                imageModal.setAttribute('aria-hidden', 'true');
                imagePreview.src = '';
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && imageModal.classList.contains('is-open')) {
                imageModal.classList.remove('is-open');
                imageModal.setAttribute('aria-hidden', 'true');
                imagePreview.src = '';
            }
        });
    </script>
</body>
</html>
