<?php
/**
 * TEMPEKU - Gateway to Laravel Application
 */
$query = $_SERVER['QUERY_STRING'] ?? '';
$target = 'public/';
if (!empty($query)) {
    $target .= 'index.php?' . $query;
}
header('Location: ' . $target, true, 302);
exit;
