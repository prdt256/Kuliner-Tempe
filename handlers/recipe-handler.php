<?php
/**
 * Handler untuk pengiriman form resep
 */

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && (($_POST["form_type"] ?? "") === "resep")) {
    $judul    = $_POST["judul"] ?? "";
    $kategori = $_POST["kategori"] ?? "";
    $biaya    = $_POST["biaya"] ?? "";
    $durasi   = trim(($_POST["durasi_val"] ?? "") . " " . ($_POST["durasi_unit"] ?? ""));
    $bahan    = $_POST["bahan"] ?? "";
    $langkah  = $_POST["langkah"] ?? "";
    $penulis  = $_POST["penulis"] ?? "";
    
    // Proses upload media
    $mediaPaths = [];
    if (isset($_FILES['media']) && !empty($_FILES['media']['name'][0])) {
        $uploadDir = __DIR__ . '/../media/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileCount = count($_FILES['media']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['media']['error'][$i] === UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['media']['name'][$i]);
                $uniqueName = time() . '_' . uniqid() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
                $targetFilePath = $uploadDir . $uniqueName;
                
                if (move_uploaded_file($_FILES['media']['tmp_name'][$i], $targetFilePath)) {
                    $mediaPaths[] = 'media/' . $uniqueName;
                }
            }
        }
    }
    
    // Jika tidak ada upload, cek apakah ada link gambar (opsional) atau gunakan array kosong
    $gambarInput = $_POST["gambar"] ?? "";
    if (empty($mediaPaths) && !empty($gambarInput)) {
        $mediaPaths[] = $gambarInput;
    }
    
    $gambar = json_encode($mediaPaths);

    // AJAX response header
    if (isset($_POST["ajax"]) && $_POST["ajax"] === "1") {
        header("Content-Type: application/json; charset=utf-8");

        $required = ["judul", "kategori", "bahan", "langkah", "penulis"];
        foreach ($required as $k) {
            if (trim((string)($_POST[$k] ?? "")) === "") {
                echo json_encode([
                    "ok" => false,
                    "message" => "Lengkapi dulu: Judul, Kategori, Bahan, Langkah, dan Nama Pengirim.",
                ]);
                exit;
            }
        }

        try {
            // Cari atau buat kategori
            $stmt = $pdo->prepare("SELECT id FROM kategori WHERE nama_kategori = :nama LIMIT 1");
            $stmt->execute(['nama' => $kategori]);
            $kategoriId = $stmt->fetchColumn();

            if (!$kategoriId) {
                $stmt = $pdo->prepare("INSERT INTO kategori (nama_kategori) VALUES (:nama)");
                $stmt->execute(['nama' => $kategori]);
                $kategoriId = $pdo->lastInsertId();
            }

            // Insert ke tabel resep
            $stmt = $pdo->prepare("
                INSERT INTO resep (kategori_id, judul, penulis, durasi, biaya, bahan, langkah, gambar) 
                VALUES (:kategori_id, :judul, :penulis, :durasi, :biaya, :bahan, :langkah, :gambar)
            ");
            
            $stmt->execute([
                'kategori_id' => $kategoriId,
                'judul'       => $judul,
                'penulis'     => $penulis,
                'durasi'      => $durasi,
                'biaya'       => $biaya,
                'bahan'       => $bahan,
                'langkah'     => $langkah,
                'gambar'      => $gambar
            ]);

            $resepBaru = [
                "id"       => $pdo->lastInsertId(),
                "judul"    => $judul,
                "kategori" => $kategori,
                "biaya"    => $biaya,
                "durasi"   => $durasi,
                "bahan"    => $bahan,
                "langkah"  => $langkah,
                "penulis"  => $penulis,
                "gambar"   => $gambar,
            ];

            echo json_encode([
                "ok" => true,
                "message" => 'Resep "'.esc($judul).'" berhasil disimpan ke database!',
                "html" => recipe_card_html($resepBaru),
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
