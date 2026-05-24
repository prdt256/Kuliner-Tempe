<?php
/**
 * Script untuk Migrasi (Membuat Tabel) dan Seeder (Mengisi Data Awal)
 * Jalankan file ini dari terminal (CLI) atau browser untuk inisialisasi awal.
 */

$host = 'localhost';
$user = 'root';
$pass = 'akar'; 
$dbname = 'tempeku';

try {
    // 1. Connect tanpa spesifik database untuk mencoba membuatnya jika belum ada
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "Mencoba membuat database '$dbname'...\n<br>";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    echo "Database '$dbname' berhasil dibuat atau sudah tersedia.\n<br>";

    // 2. Gunakan database tersebut
    $pdo->exec("USE `$dbname`");

    // 3. Buat Tabel (Migrasi)
    echo "Membuat tabel-tabel...\n<br>";

    $sql = "
    CREATE TABLE IF NOT EXISTS kategori (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_kategori VARCHAR(100) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS resep (
        id INT AUTO_INCREMENT PRIMARY KEY,
        kategori_id INT,
        judul VARCHAR(255) NOT NULL,
        penulis VARCHAR(100),
        durasi VARCHAR(50),
        biaya VARCHAR(50),
        bahan TEXT,
        langkah TEXT,
        gambar VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL
    );

    CREATE TABLE IF NOT EXISTS restoran (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_restoran VARCHAR(255) NOT NULL,
        alamat TEXT,
        latitude DECIMAL(10,8),
        longitude DECIMAL(11,8),
        deskripsi TEXT,
        gambar VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE IF NOT EXISTS menu_restoran (
        id INT AUTO_INCREMENT PRIMARY KEY,
        restoran_id INT,
        nama_menu VARCHAR(255) NOT NULL,
        harga DECIMAL(10,2),
        deskripsi TEXT,
        FOREIGN KEY (restoran_id) REFERENCES restoran(id) ON DELETE CASCADE
    );

    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        name VARCHAR(100) NOT NULL,
        role VARCHAR(50) DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";
    
    $pdo->exec($sql);
    echo "Tabel berhasil dibuat.\n<br>";

    // 4. Seeder (Dummy Data)
    echo "Memasukkan data seeder (dummy)...\n<br>";
    
    // Kategori
    $stmt = $pdo->query("SELECT COUNT(*) FROM kategori");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO kategori (nama_kategori) VALUES ('Gorengan'), ('Tumisan'), ('Kuah'), ('Keringan')");
        echo "- Data kategori berhasil ditambahkan.\n<br>";
    }

    // Resep
    $stmt = $pdo->query("SELECT COUNT(*) FROM resep");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("
            INSERT INTO resep (kategori_id, judul, penulis, durasi, biaya, bahan, langkah, gambar) VALUES 
            (1, 'Tempe Mendoan Gurih', 'Budi Santoso', '15 Menit', 'Rp 15.000', '1 papan tempe\\n2 batang daun bawang\\n150g tepung terigu\\nBumbu halus: Bawang putih, ketumbar, garam', '1. Iris tempe tipis-tipis.\\n2. Campur tepung dengan bumbu halus dan air.\\n3. Masukkan daun bawang.\\n4. Celup tempe dan goreng setengah matang.', 'https://images.unsplash.com/photo-1627993077793-13824ed2ccab?q=80&w=500&auto=format&fit=crop'),
            (2, 'Orek Tempe Manis Pedas', 'Siti Aminah', '20 Menit', 'Rp 20.000', '1 papan tempe\\n3 siung bawang putih\\n5 siung bawang merah\\n3 cabe merah besar\\nKecap manis, garam, gula merah', '1. Potong tempe dadu, goreng kering.\\n2. Tumis bawang dan cabe hingga harum.\\n3. Masukkan gula, garam, dan kecap.\\n4. Masukkan tempe, aduk rata.', 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop')
        ");
        echo "- Data resep berhasil ditambahkan.\n<br>";
    }

    // Restoran & Menu
    $stmt = $pdo->query("SELECT COUNT(*) FROM restoran");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("
            INSERT INTO restoran (nama_restoran, alamat, latitude, longitude, deskripsi, gambar) VALUES 
            ('Warung Tempe Mendoan Asli Purwokerto', 'Jl. Jenderal Sudirman No. 123, Purwokerto', -7.424424, 109.230230, 'Menyajikan tempe mendoan hangat khas Purwokerto dengan sambal kecap pedas.', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop'),
            ('Orek Tempe Nusantara Raya', 'Jl. Merdeka Barat No. 10, Jakarta Pusat', -6.175110, 106.827153, 'Restoran spesialis hidangan orek tempe dengan berbagai varian sambal.', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=500&auto=format&fit=crop')
        ");
        echo "- Data restoran berhasil ditambahkan.\n<br>";
        
        $pdo->exec("
            INSERT INTO menu_restoran (restoran_id, nama_menu, harga, deskripsi) VALUES 
            (1, 'Mendoan Biasa', 15000, '5 lembar mendoan dengan sambal kecap.'),
            (1, 'Mendoan Jumbo', 25000, '5 lembar mendoan ukuran besar dengan sambal kecap spesial.'),
            (2, 'Orek Tempe Basah', 20000, 'Orek tempe dengan bumbu basah nan gurih.'),
            (2, 'Orek Tempe Kering', 22000, 'Orek tempe kering kriuk dan tahan lama.')
        ");
        echo "- Data menu restoran berhasil ditambahkan.\n<br>";
    }

    // Users
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    if ($stmt->fetchColumn() == 0) {
        $password_hash = password_hash('rahasia123', PASSWORD_DEFAULT);
        $pdo->exec("INSERT INTO users (username, password, name, role) VALUES ('admin', '$password_hash', 'Administrator', 'admin')");
        echo "- Data users (admin) berhasil ditambahkan.\n<br>";
    }

    echo "\n<br><strong>=== SEMUA MIGRASI DAN SEEDER SELESAI ===</strong>\n";

} catch (PDOException $e) {
    die("Error Database: " . $e->getMessage());
}
