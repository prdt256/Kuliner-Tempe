<?php
/**
 * Konfigurasi Koneksi Database Menggunakan PDO
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'akar'; // Sesuaikan dengan password database local Anda (biasanya kosong atau 'root')
$db_name = 'tempeku';

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Tampilkan pesan error sederhana tanpa mengekspos credential
    die("Koneksi database gagal. Pastikan database '$db_name' sudah dibuat atau jalankan migrate_seed.php.");
}
