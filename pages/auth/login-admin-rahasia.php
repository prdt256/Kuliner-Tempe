<?php
// Cek apakah session sudah dimulai sebelum memanggil session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: " . $base_url . "index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            header("Location: " . $base_url . "index.php");
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Silakan isi semua kolom.";
    }
}

?>

<main class="min-h-screen flex items-center justify-center py-20 px-4 mt-20">
    <div class="bg-surface-container rounded-[2rem] p-10 max-w-md w-full shadow-lg border border-outline-variant/30">
        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-5xl text-primary mb-4">admin_panel_settings</span>
            <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Login Admin</h1>
            <p class="text-body-sm text-on-surface-variant">Akses rahasia pengelola TEMPEKU</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-6 text-sm font-label-bold flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="flex flex-col gap-6">
            <div class="flex flex-col gap-2">
                <label for="username" class="font-label-bold text-on-surface">Username</label>
                <input type="text" id="username" name="username" class="rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary bg-surface" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="font-label-bold text-on-surface">Password</label>
                <input type="password" id="password" name="password" class="rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary bg-surface" required>
            </div>

            <button type="submit" class="mt-4 bg-primary text-on-primary py-3 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">login</span>
                Masuk Sistem
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="<?= $base_url ?>index.php" class="text-sm text-primary hover:underline flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</main>

