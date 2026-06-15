<?php
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
$redirectPath = ($basePath === '' ? '' : $basePath) . '/blog';
header('Location: ' . $redirectPath, true, 301);
exit;