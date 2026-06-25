<?php
if (PHP_SAPI !== 'cli') {
    session_start();
} else {
    $_SESSION = [];
}

require __DIR__ . '/../includes/product-admin-functions.php';

$adminPassword = getenv('SIGNAGE_ADMIN_PASSWORD') ?: 'admin123';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$message = '';
$error = '';

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
            $image = trim((string) ($_POST['image'] ?? ''));
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
            $items[] = [
                'title' => $title,
                'group' => $group,
                'image' => $image !== '' ? $image : 'foamboard-signage-singapore.jpeg',
                'source_url' => $sourceUrl,
            ];
            $message = 'Subcategory added.';
        }

        if ($action === 'update_product') {
            $oldGroup = (string) ($_POST['old_group'] ?? '');
            $oldTitle = (string) ($_POST['old_title'] ?? '');
            $newGroup = (string) ($_POST['group'] ?? '');
            $newTitle = trim((string) ($_POST['title'] ?? ''));

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

            foreach ($items as &$item) {
                if (($item['group'] ?? '') === $oldGroup && ($item['title'] ?? '') === $oldTitle) {
                    $item['group'] = $newGroup;
                    $item['title'] = $newTitle;
                    $item['image'] = trim((string) ($_POST['image'] ?? '')) ?: 'foamboard-signage-singapore.jpeg';
                    $item['source_url'] = trim((string) ($_POST['source_url'] ?? ''));
                    break;
                }
            }
            unset($item);

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

        if ($message !== '') {
            signage_save_catalog_for_admin($groups, $items);
            signage_rebuild_product_folders($groups, $items);
        }
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}

$catalog = signage_load_catalog_for_admin();
$groups = $catalog['groups'];
$items = $catalog['items'];
$imageFiles = array_map('basename', glob(__DIR__ . '/../assets/images/products/*') ?: []);
sort($imageFiles);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Admin | Signage SG</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f6f6f6; color: #111; }
        header, main { max-width: 1180px; margin: 0 auto; padding: 24px; }
        header { display: flex; justify-content: space-between; align-items: center; gap: 16px; }
        h1, h2, h3 { margin: 0 0 12px; }
        a { color: #111; }
        .panel { background: #fff; border: 1px solid #111; padding: 18px; margin-bottom: 18px; }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .category { border: 1px solid #ccc; padding: 14px; margin-top: 12px; }
        .item { border-top: 1px solid #ddd; padding-top: 12px; margin-top: 12px; }
        .row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 8px; align-items: end; }
        label { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        input, select { width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #999; }
        button { padding: 10px 14px; border: 1px solid #111; background: #111; color: #fff; cursor: pointer; }
        button.secondary { background: #fff; color: #111; }
        button.danger { background: #a40000; border-color: #a40000; }
        .message { border: 1px solid #187a35; background: #e9f8ee; padding: 12px; margin-bottom: 16px; }
        .error { border: 1px solid #a40000; background: #fff0f0; padding: 12px; margin-bottom: 16px; }
        .muted { color: #555; font-size: 13px; }
        @media (max-width: 900px) { .grid, .row { grid-template-columns: 1fr; } header { align-items: flex-start; flex-direction: column; } }
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
            <p class="muted"><?php echo count($groups); ?> categories, <?php echo count($items); ?> subcategories</p>
        </div>
        <div>
            <a href="../products" target="_blank">View Products</a> |
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
        <section class="panel">
            <h2>Add Category</h2>
            <form method="post" class="row">
                <input type="hidden" name="action" value="add_category">
                <div><label>Category Title</label><input name="title" required></div>
                <div><button type="submit">Add Category</button></div>
            </form>
        </section>

        <section class="panel">
            <h2>Add Subcategory</h2>
            <form method="post" class="row">
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
                <div><label>Image Filename</label><input name="image" list="imageFiles" placeholder="example.jpeg"></div>
                <div><label>Source URL</label><input name="source_url" placeholder="https://..."></div>
                <div><button type="submit">Add Subcategory</button></div>
            </form>
        </section>

        <datalist id="imageFiles">
<?php foreach ($imageFiles as $imageFile): ?>
            <option value="<?php echo htmlspecialchars($imageFile, ENT_QUOTES, 'UTF-8'); ?>"></option>
<?php endforeach; ?>
        </datalist>

        <section class="panel">
            <h2>Manage Categories</h2>
<?php foreach ($groups as $groupTitle => $groupItemTitles): ?>
            <article class="category">
                <form method="post" class="row">
                    <input type="hidden" name="action" value="rename_category">
                    <input type="hidden" name="old_title" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                    <div><label>Category</label><input name="new_title" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>" required></div>
                    <div><label>Total Items</label><input value="<?php echo count($groupItemTitles); ?>" disabled></div>
                    <div><button type="submit" class="secondary">Rename</button></div>
                </form>
                <form method="post" onsubmit="return confirm('Delete this category and all subcategories?');" style="margin-top: 8px;">
                    <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" class="danger">Delete Category</button>
                </form>

<?php foreach ($groupItemTitles as $itemTitle): ?>
<?php $productItem = signage_catalog_find_item($items, $groupTitle, $itemTitle) ?? ['title' => $itemTitle, 'group' => $groupTitle, 'image' => '', 'source_url' => '']; ?>
                <div class="item">
                    <form method="post" class="row">
                        <input type="hidden" name="action" value="update_product">
                        <input type="hidden" name="old_group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="old_title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <div>
                            <label>Parent</label>
                            <select name="group">
<?php foreach (array_keys($groups) as $selectGroupTitle): ?>
                                <option value="<?php echo htmlspecialchars($selectGroupTitle, ENT_QUOTES, 'UTF-8'); ?>"<?php echo $selectGroupTitle === $groupTitle ? ' selected' : ''; ?>><?php echo htmlspecialchars($selectGroupTitle, ENT_QUOTES, 'UTF-8'); ?></option>
<?php endforeach; ?>
                            </select>
                        </div>
                        <div><label>Subcategory</label><input name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>" required></div>
                        <div><label>Image</label><input name="image" list="imageFiles" value="<?php echo htmlspecialchars($productItem['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
                        <div><label>Source URL</label><input name="source_url" value="<?php echo htmlspecialchars($productItem['source_url'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
                        <div><button type="submit" class="secondary">Save Subcategory</button></div>
                    </form>
                    <form method="post" onsubmit="return confirm('Delete this subcategory?');" style="margin-top: 8px;">
                        <input type="hidden" name="action" value="delete_product">
                        <input type="hidden" name="group" value="<?php echo htmlspecialchars($groupTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="title" value="<?php echo htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit" class="danger">Delete Subcategory</button>
                    </form>
                </div>
<?php endforeach; ?>
            </article>
<?php endforeach; ?>
        </section>
    </main>
<?php endif; ?>
</body>
</html>
