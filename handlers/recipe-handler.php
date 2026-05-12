<?php
/**
 * Handler untuk pengiriman form resep
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi array resep user jika belum ada
if (!isset($_SESSION["user_recipes"])) {
    $_SESSION["user_recipes"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && (($_POST["form_type"] ?? "") === "resep")) {
    $resepBaru = [
        "judul"    => $_POST["judul"] ?? "",
        "kategori" => $_POST["kategori"] ?? "",
        "biaya"    => $_POST["biaya"] ?? "",
        "durasi"   => trim(($_POST["durasi_val"] ?? "") . " " . ($_POST["durasi_unit"] ?? "")),
        "bahan"    => $_POST["bahan"] ?? "",
        "langkah"  => $_POST["langkah"] ?? "",
        "penulis"  => $_POST["penulis"] ?? "",
        "gambar"   => $_POST["gambar"] ?? "",
    ];

    // Simpan ke session agar tidak menimpa
    $_SESSION["user_recipes"][] = $resepBaru;

    // AJAX response
    if (isset($_POST["ajax"]) && $_POST["ajax"] === "1") {
        header("Content-Type: application/json; charset=utf-8");

        $required = ["judul", "kategori", "bahan", "langkah", "penulis"];
        foreach ($required as $k) {
            if (trim((string)$resepBaru[$k]) === "") {
                echo json_encode([
                    "ok" => false,
                    "message" => "Lengkapi dulu: Judul, Kategori, Bahan, Langkah, dan Nama Pengirim.",
                ]);
                exit;
            }
        }

        echo json_encode([
            "ok" => true,
            "message" => 'Resep "'.esc($resepBaru["judul"]).'" berhasil ditambahkan!',
            "html" => recipe_card_html($resepBaru),
        ]);
        exit;
    }
}
