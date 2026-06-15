<?php
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
$redirectPath = ($basePath === '' ? '' : $basePath) . '/blog/3d-signboard-vs-lightbox-jb';
header('Location: ' . $redirectPath, true, 301);
exit;