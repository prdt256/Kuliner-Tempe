<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
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
            header("Location: index.php");
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Silakan isi semua kolom.";
    }
}

include_once 'includes/header.php';
?>

<main class="min-h-screen flex items-center justify-center py-20 px-4 mt-20">
    <div class="bg-surface-container rounded-[2rem] p-10 max-w-md w-full shadow-lg border border-outline-variant/30">
        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-5xl text-primary mb-4">account_circle</span>
            <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Masuk</h1>
            <p class="text-body-sm text-on-surface-variant">Silakan masuk untuk membagikan resep dan tempat kuliner favoritmu.</p>
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
                Masuk
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm text-on-surface-variant">
            Belum punya akun? <a href="register.php" class="text-primary hover:underline font-label-bold">Daftar sekarang</a>
        </div>
    </div>
</main>

<?php include_once 'includes/footer.php'; ?>
