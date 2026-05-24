<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/db.php';
require_once 'handlers/tempat-kuliner-handler.php';
include_once 'includes/header.php';
?>
<main class="pt-24 pb-24">
    <?php include_once 'sections/form-tempat-kuliner.php'; ?>
    <div id="tempatList" class="max-w-md mx-auto mt-12 px-margin-mobile md:px-margin-desktop grid grid-cols-1 gap-lg">
        <!-- Preview will appear here -->
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>
