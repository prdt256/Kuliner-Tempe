<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: " . $base_url . "index.php?page=login");
    exit;
}
require_once 'handlers/recipe-handler.php';
?>
<main class="pt-24 pb-24">
    <?php include_once 'sections/form-resep.php'; ?>
    <div id="resepList" class="max-w-md mx-auto mt-12 px-margin-mobile md:px-margin-desktop grid grid-cols-1 gap-lg">
        <!-- Preview will appear here -->
    </div>
</main>
