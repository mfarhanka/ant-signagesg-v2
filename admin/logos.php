<?php
if (PHP_SAPI !== 'cli') {
    $sessionPath = __DIR__ . '/../data/sessions';

    if (!is_dir($sessionPath)) {
        mkdir($sessionPath, 0777, true);
    }

    session_save_path($sessionPath);
    session_start();
} else {
    $_SESSION = [];
}

require __DIR__ . '/../includes/logo-admin-functions.php';

$adminPassword = getenv('SIGNAGE_ADMIN_PASSWORD') ?: 'admin123';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$message = (string) ($_SESSION['logo_admin_message'] ?? '');
$error = (string) ($_SESSION['logo_admin_error'] ?? '');
unset($_SESSION['logo_admin_message'], $_SESSION['logo_admin_error']);

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: logos.php');
    exit;
}

if ($requestMethod === 'POST' && ($_POST['action'] ?? '') === 'login') {
    if (hash_equals($adminPassword, (string) ($_POST['password'] ?? ''))) {
        $_SESSION['product_admin'] = true;
        header('Location: logos.php');
        exit;
    }

    $error = 'Invalid password.';
}

$isLoggedIn = !empty($_SESSION['product_admin']);

if ($isLoggedIn && $requestMethod === 'POST') {
    $items = signage_load_logo_items();
    $action = (string) ($_POST['action'] ?? '');

    try {
        if ($action === 'add_logo') {
            $name = trim((string) ($_POST['name'] ?? ''));

            if ($name === '') {
                throw new RuntimeException('Logo name is required.');
            }

            $image = signage_admin_upload_logo_image('logo_upload');

            if ($image === '') {
                throw new RuntimeException('Please upload a logo image.');
            }

            $items[] = [
                'name' => $name,
                'type' => (string) ($_POST['type'] ?? 'partner'),
                'image' => $image,
                'url' => trim((string) ($_POST['url'] ?? '')),
                'sort_order' => (int) ($_POST['sort_order'] ?? ((count($items) + 1) * 10)),
                'hidden' => empty($_POST['visible']),
            ];
            $message = 'Logo added.';
        }

        if ($action === 'update_logo') {
            $index = (int) ($_POST['index'] ?? -1);

            if (!isset($items[$index])) {
                throw new RuntimeException('Logo not found.');
            }

            $name = trim((string) ($_POST['name'] ?? ''));

            if ($name === '') {
                throw new RuntimeException('Logo name is required.');
            }

            $items[$index] = [
                'name' => $name,
                'type' => (string) ($_POST['type'] ?? 'partner'),
                'image' => signage_admin_upload_logo_image('logo_upload', (string) ($_POST['existing_image'] ?? $items[$index]['image'])),
                'url' => trim((string) ($_POST['url'] ?? '')),
                'sort_order' => (int) ($_POST['sort_order'] ?? $items[$index]['sort_order']),
                'hidden' => empty($_POST['visible']),
            ];
            $message = 'Logo updated.';
        }

        if ($action === 'delete_logo') {
            $index = (int) ($_POST['index'] ?? -1);

            if (!isset($items[$index])) {
                throw new RuntimeException('Logo not found.');
            }

            array_splice($items, $index, 1);
            $message = 'Logo removed.';
        }

        if ($message !== '') {
            signage_save_logo_items($items);
            $_SESSION['logo_admin_message'] = $message;
            header('Location: logos.php');
            exit;
        }
    } catch (Throwable $exception) {
        $_SESSION['logo_admin_error'] = $exception->getMessage();
        header('Location: logos.php');
        exit;
    }
}

$items = signage_load_logo_items();
$visibleCount = count(array_filter($items, static fn (array $item): bool => empty($item['hidden'])));
$sponsorCount = count(array_filter($items, static fn (array $item): bool => ($item['type'] ?? '') === 'sponsor'));
$partnerCount = count(array_filter($items, static fn (array $item): bool => ($item['type'] ?? '') === 'partner'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Admin | Signage SG</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f5f7; color: #111; }
        header, main { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        header { position: sticky; top: 0; z-index: 20; display: flex; justify-content: space-between; align-items: center; gap: 16px; padding: 18px 0; background: #f4f5f7; border-bottom: 1px solid #d8dce2; }
        main { padding: 22px 0 32px; }
        h1, h2, h3 { margin: 0 0 12px; }
        h1 { font-size: 28px; }
        h2 { font-size: 18px; }
        a { color: #111; }
        .admin-links { display: inline-flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 700; }
        .panel { background: #fff; border: 1px solid #cfd4dc; padding: 18px; margin-bottom: 18px; border-radius: 6px; box-shadow: 0 1px 2px rgba(17, 24, 39, .04); }
        .metric-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; margin-bottom: 18px; }
        .metric { background: #fff; border: 1px solid #cfd4dc; border-radius: 6px; padding: 14px; }
        .metric strong { display: block; font-size: 24px; line-height: 1; }
        .metric span { display: block; margin-top: 7px; color: #555; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; }
        .row { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 10px; align-items: end; }
        .row.add-logo { grid-template-columns: minmax(180px, 1.2fr) minmax(120px, .7fr) minmax(200px, 1.2fr) minmax(170px, 1fr) minmax(100px, .5fr) minmax(120px, auto) auto; }
        .logo-list { display: grid; gap: 12px; }
        .logo-card { display: grid; grid-template-columns: 150px minmax(0, 1fr); gap: 16px; align-items: center; border: 1px solid #d8dce2; border-radius: 6px; padding: 14px; background: #fff; }
        .logo-preview { display: flex; align-items: center; justify-content: center; min-height: 86px; border: 1px solid #d8dce2; background: #fafafa; }
        .logo-preview img { max-width: 120px; max-height: 64px; object-fit: contain; }
        label { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        input, select { width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #aeb6c2; border-radius: 4px; background: #fff; }
        input[type="checkbox"] { width: auto; }
        button { min-height: 40px; padding: 10px 14px; border: 1px solid #111; border-radius: 4px; background: #111; color: #fff; cursor: pointer; font-weight: 700; white-space: nowrap; }
        button.secondary { background: #fff; color: #111; }
        button.danger { background: #a40000; border-color: #a40000; }
        .action-row { display: flex; justify-content: flex-end; gap: 8px; margin-top: 10px; }
        .visibility-toggle { display: inline-flex; align-items: center; gap: 8px; min-height: 42px; text-transform: none; letter-spacing: 0; font-size: 14px; }
        .message { border: 1px solid #187a35; background: #e9f8ee; padding: 12px; margin-bottom: 16px; }
        .error { border: 1px solid #a40000; background: #fff0f0; padding: 12px; margin-bottom: 16px; }
        .muted { color: #555; font-size: 13px; }
        @media (max-width: 980px) { header { position: static; align-items: flex-start; flex-direction: column; } .metric-grid, .row, .row.add-logo, .logo-card { grid-template-columns: 1fr; } .action-row { justify-content: flex-start; flex-wrap: wrap; } }
    </style>
</head>
<body>
<?php if (!$isLoggedIn): ?>
    <main>
        <section class="panel" style="max-width: 420px; margin: 80px auto;">
            <h1>Logo Admin</h1>
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
            <h1>Logo Admin</h1>
            <p class="muted">Manage sponsor and partner logos used on the homepage carousel.</p>
        </div>
        <div class="admin-links">
            <a href="index.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="../#trusted-brands" target="_blank">View Logos</a>
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
        <section class="metric-grid" aria-label="Logo summary">
            <div class="metric"><strong><?php echo count($items); ?></strong><span>Total Logos</span></div>
            <div class="metric"><strong><?php echo (int) $visibleCount; ?></strong><span>Visible</span></div>
            <div class="metric"><strong><?php echo (int) $partnerCount; ?></strong><span>Partners</span></div>
            <div class="metric"><strong><?php echo (int) $sponsorCount; ?></strong><span>Sponsors</span></div>
        </section>

        <section class="panel">
            <h2>Add Logo</h2>
            <form method="post" class="row add-logo" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_logo">
                <div><label>Name</label><input name="name" required></div>
                <div>
                    <label>Type</label>
                    <select name="type">
                        <option value="partner">Partner</option>
                        <option value="sponsor">Sponsor</option>
                    </select>
                </div>
                <div><label>Logo Image</label><input type="file" name="logo_upload" accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml" required></div>
                <div><label>Link URL</label><input name="url" placeholder="https://..."></div>
                <div><label>Order</label><input type="number" name="sort_order" value="<?php echo (count($items) + 1) * 10; ?>"></div>
                <div><label>Visibility</label><label class="visibility-toggle"><input type="checkbox" name="visible" value="1" checked> Show</label></div>
                <div><button type="submit">Add Logo</button></div>
            </form>
        </section>

        <section class="panel">
            <h2>Manage Logos</h2>
            <div class="logo-list">
<?php foreach ($items as $index => $item): ?>
<?php $imageUrl = signage_logo_image_url((string) ($item['image'] ?? ''), '../assets'); ?>
                <article class="logo-card">
                    <div class="logo-preview">
<?php if ($imageUrl !== ''): ?>
                        <img loading="lazy" src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars(($item['name'] ?? 'Logo') . ' logo', ENT_QUOTES, 'UTF-8'); ?>">
<?php endif; ?>
                    </div>
                    <div>
                        <form method="post" class="row" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="update_logo">
                            <input type="hidden" name="index" value="<?php echo (int) $index; ?>">
                            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                            <div><label>Name</label><input name="name" value="<?php echo htmlspecialchars($item['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></div>
                            <div>
                                <label>Type</label>
                                <select name="type">
                                    <option value="partner"<?php echo ($item['type'] ?? '') === 'partner' ? ' selected' : ''; ?>>Partner</option>
                                    <option value="sponsor"<?php echo ($item['type'] ?? '') === 'sponsor' ? ' selected' : ''; ?>>Sponsor</option>
                                </select>
                            </div>
                            <div><label>Replace Image</label><input type="file" name="logo_upload" accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml"><span class="muted">Current: <?php echo htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span></div>
                            <div><label>Link URL</label><input name="url" value="<?php echo htmlspecialchars($item['url'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
                            <div><label>Order</label><input type="number" name="sort_order" value="<?php echo (int) ($item['sort_order'] ?? 0); ?>"></div>
                            <div><label>Visibility</label><label class="visibility-toggle"><input type="checkbox" name="visible" value="1"<?php echo empty($item['hidden']) ? ' checked' : ''; ?>> Show</label></div>
                            <div><button type="submit" class="secondary">Save</button></div>
                        </form>
                        <form method="post" class="action-row" onsubmit="return confirm('Delete this logo?');">
                            <input type="hidden" name="action" value="delete_logo">
                            <input type="hidden" name="index" value="<?php echo (int) $index; ?>">
                            <button type="submit" class="danger">Delete</button>
                        </form>
                    </div>
                </article>
<?php endforeach; ?>
            </div>
        </section>
    </main>
<?php endif; ?>
</body>
</html>
