<?php
/**
 * Handler untuk pengiriman form tempat kuliner
 */

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && (($_POST["form_type"] ?? "") === "tempat_kuliner")) {
    $nama_restoran = $_POST["nama_restoran"] ?? "";
    $alamat        = $_POST["alamat"] ?? "";
    $latitude      = $_POST["latitude"] ?? "";
    $longitude     = $_POST["longitude"] ?? "";
    $deskripsi     = $_POST["deskripsi"] ?? "";
    $gambar        = $_POST["gambar"] ?? "";

    if (isset($_POST["ajax"]) && $_POST["ajax"] === "1") {
        header("Content-Type: application/json; charset=utf-8");

        $required = ["nama_restoran", "alamat", "deskripsi"];
        foreach ($required as $k) {
            if (trim((string)($_POST[$k] ?? "")) === "") {
                echo json_encode([
                    "ok" => false,
                    "message" => "Lengkapi dulu: Nama Tempat, Alamat Lengkap, dan Deskripsi.",
                ]);
                exit;
            }
        }

        try {
            $stmt = $pdo->prepare("
                INSERT INTO restoran (nama_restoran, alamat, latitude, longitude, deskripsi, gambar) 
                VALUES (:nama_restoran, :alamat, :latitude, :longitude, :deskripsi, :gambar)
            ");
            
            $stmt->execute([
                'nama_restoran' => $nama_restoran,
                'alamat'        => $alamat,
                'latitude'      => (trim($latitude) === "" ? null : $latitude),
                'longitude'     => (trim($longitude) === "" ? null : $longitude),
                'deskripsi'     => $deskripsi,
                'gambar'        => $gambar
            ]);

            echo json_encode([
                "ok" => true,
                "message" => 'Tempat Kuliner "'.esc($nama_restoran).'" berhasil disimpan ke database!',
                "html" => "" // Placeholder jika nanti mau ditampilkan via AJAX
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "ok" => false,
                "message" => "Terjadi kesalahan database: " . $e->getMessage()
            ]);
        }
        exit;
    }
}

