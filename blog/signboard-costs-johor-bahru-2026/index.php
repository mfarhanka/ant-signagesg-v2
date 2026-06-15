<?php
$posts = require __DIR__ . '/../includes/posts.php';
$post = $posts['signboard-costs-johor-bahru-2026'] ?? null;

if ($post === null) {
    http_response_code(404);
    exit('Blog post not found.');
}

require __DIR__ . '/../includes/post-template.php';