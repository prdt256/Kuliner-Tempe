<?php
require_once "includes/db.php";
require_once "includes/functions.php";

$routes = require "routes.php";
$page = $_GET["page"] ?? "home";

// Logout handler (tanpa layout UI)
if ($page === "logout") {
    require $routes["logout"];
    exit;
}

if (!array_key_exists($page, $routes) || !file_exists($routes[$page])) {
    $page = "home"; // fallback jika rute salah
}

// Render UI
include_once "includes/header.php";
require $routes[$page];
include_once "includes/footer.php";