<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: " . $base_url . "index.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (!empty($name) && !empty($username) && !empty($password)) {
        // Cek username apakah sudah ada
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, 'user')");
            if ($stmt->execute([$name, $username, $password_hash])) {
                $success = "Akun berhasil dibuat. Silakan login.";
            } else {
                $error = "Terjadi kesalahan saat membuat akun.";
            }
        }
    } else {
        $error = "Silakan isi semua kolom.";
    }
}

?>

<main class="min-h-screen flex items-center justify-center py-20 px-4 mt-20">
    <div class="bg-surface-container rounded-[2rem] p-10 max-w-md w-full shadow-lg border border-outline-variant/30">
        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-5xl text-primary mb-4">person_add</span>
            <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Daftar Akun</h1>
            <p class="text-body-sm text-on-surface-variant">Bergabunglah dan bagikan pengalaman kulinermu.</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-6 text-sm font-label-bold flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="bg-primary-container text-on-primary-container p-4 rounded-xl mb-6 text-sm font-label-bold flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <?= esc($success) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="flex flex-col gap-6">
            <div class="flex flex-col gap-2">
                <label for="name" class="font-label-bold text-on-surface">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary bg-surface" required>
            </div>
            
            <div class="flex flex-col gap-2">
                <label for="username" class="font-label-bold text-on-surface">Username</label>
                <input type="text" id="username" name="username" class="rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary bg-surface" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="font-label-bold text-on-surface">Password</label>
                <input type="password" id="password" name="password" class="rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary bg-surface" required>
            </div>

            <button type="submit" class="mt-4 bg-primary text-on-primary py-3 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">how_to_reg</span>
                Daftar
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm text-on-surface-variant">
            Sudah punya akun? <a href="<?= $base_url ?>index.php?page=login" class="text-primary hover:underline font-label-bold">Masuk di sini</a>
        </div>
    </div>
</main>

