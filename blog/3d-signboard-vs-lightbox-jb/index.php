<?php
$posts = require __DIR__ . '/../includes/posts.php';
$post = $posts['3d-signboard-vs-lightbox-jb'] ?? null;

if ($post === null) {
    http_response_code(404);
    exit('Blog post not found.');
}

require __DIR__ . '/../includes/post-template.php';