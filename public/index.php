<?php

// Ensure URL contains index.php under Apache subfolder without mod_rewrite AllowOverride
$reqUri = $_SERVER['REQUEST_URI'] ?? '';
$reqPath = parse_url($reqUri, PHP_URL_PATH) ?? '';
if (rtrim($reqPath, '/') === '/TEMPEKU/public') {
    $qs = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: /TEMPEKU/public/index.php' . $qs, true, 302);
    exit;
}

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
