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

    $gambarInput = $_POST["gambar"] ?? "";
    if (empty($mediaPaths) && !empty($gambarInput)) {
        $mediaPaths[] = $gambarInput;
    }
    
    $gambar = json_encode($mediaPaths);

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

            $gambarSrc = !empty($mediaPaths) ? $mediaPaths[0] : "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop";
            
            // Cek apakah video
            $ext = strtolower(pathinfo($gambarSrc, PATHINFO_EXTENSION));
            $isVideo = in_array($ext, ['mp4', 'webm', 'ogg']);

            $mediaElement = $isVideo 
                ? '<video src="'.esc($gambarSrc).'" class="w-full h-full object-cover" autoplay muted loop playsinline></video>'
                : '<img src="'.esc($gambarSrc).'" class="w-full h-full object-cover">';

            $htmlPreview = '
            <article class="bg-surface-container-lowest rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm">
                <div class="h-64 overflow-hidden relative">
                    ' . $mediaElement . '
                </div>
                <div class="p-lg flex flex-col flex-1">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-2">'.esc($nama_restoran).'</h3>
                    <p class="text-body-sm text-on-surface-variant mb-6">'.esc($alamat).'</p>
                    <p class="text-body-sm text-primary font-bold"><em>Preview Tampilan Kartu</em></p>
                </div>
            </article>';

            echo json_encode([
                "ok" => true,
                "message" => 'Tempat Kuliner "'.esc($nama_restoran).'" berhasil disimpan ke database!',
                "html" => $htmlPreview
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

