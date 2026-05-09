<?php
/**
 * TEMPEKU - Website Inspirasi Resep Tempe
 * File ini sekarang berfungsi sebagai "Entry Point" (Kerangka Utama)
 */

// 1. Load semua fungsi pembantu
require_once 'includes/functions.php';

// 2. Load logic pengolahan form (POST/AJAX)
require_once 'handlers/recipe-handler.php';

// 3. Render Header (HTML Head, Nav)
include_once 'includes/header.php';
?>

<main>
    <?php
    // 4. Render Section-Section Konten
    include_once 'sections/hero.php';
    include_once 'sections/about.php';
    include_once 'sections/processing.php';
    include_once 'sections/recommendations.php';
    include_once 'sections/recipes.php';
    include_once 'sections/form-resep.php';
    ?>
</main>

<?php
// 5. Render Footer (Scripts, Penutup HTML)
include_once 'includes/footer.php';
?>
