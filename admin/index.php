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

$isLoggedIn = !empty($_SESSION['product_admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Signage SG</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f5f7; color: #111; }
        main { width: min(960px, calc(100% - 32px)); margin: 0 auto; padding: 48px 0; }
        h1, h2 { margin: 0 0 12px; }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-top: 22px; }
        .card { display: block; padding: 20px; border: 1px solid #cfd4dc; border-radius: 6px; background: #fff; color: #111; text-decoration: none; box-shadow: 0 1px 2px rgba(17, 24, 39, .04); }
        .card:hover { border-color: #111; }
        .card span { display: block; color: #555; font-size: 13px; line-height: 1.5; }
        .muted { color: #555; font-size: 14px; line-height: 1.6; }
        .admin-links { display: flex; gap: 12px; margin-top: 22px; font-weight: 700; }
        a { color: #111; }
        @media (max-width: 720px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <main>
        <h1>Admin Dashboard</h1>
        <p class="muted">Choose what you want to manage. Login is shared across admin pages.</p>

        <div class="grid">
            <a class="card" href="products.php">
                <h2>Products</h2>
                <span>Manage categories, subcategories, product images, and product-page items.</span>
            </a>
            <a class="card" href="logos.php">
                <h2>Sponsor & Partner Logos</h2>
                <span>Add, edit, order, hide, and remove homepage carousel logos.</span>
            </a>
        </div>

        <div class="admin-links">
            <a href="../" target="_blank">View Site</a>
<?php if ($isLoggedIn): ?>
            <a href="products.php?logout=1">Logout</a>
<?php endif; ?>
        </div>
    </main>
</body>
</html>
