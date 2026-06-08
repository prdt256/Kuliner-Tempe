<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rasa Nusantara - Website Kuliner</title>
    <style>
        /* Reset CSS & Variabel Warna */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        :root {
            --primary-color: #ff4757;
            --secondary-color: #ffa502;
            --dark-color: #2f3542;
            --light-color: #f1f2f6;
        }

        body {
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        /* Navbar */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }
        .logo span {
            color: var(--secondary-color);
        }
        .nav-links {
            display: flex;
            list-style: none;
            gap: 25px;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 600;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Hero Section (Tampilan Utama) */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
            min-height: calc(100vh - 80px);
        }
        .hero-content {
            flex: 1;
            padding-right: 50px;
        }
        .hero-content h1 {
            font-size: 48px;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .hero-content h1 span {
            color: var(--primary-color);
        }
        .hero-content p {
            font-size: 18px;
            color: #57606f;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn-menu {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.4);
            transition: transform 0.3s, background-color 0.3s;
        }
        .btn-menu:hover {
            background-color: #ff2e44;
            transform: translateY(-3px);
        }
        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
        }
        /* Menggunakan gambar ilustrasi makanan dari Unsplash */
        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        /* Responsif untuk HP */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }
            .hero {
                flex-direction: column-reverse;
                text-align: center;
                padding: 40px 20px;
            }
            .hero-content {
                padding-right: 0;
                margin-top: 30px;
            }
            .hero-content h1 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>

    <!-- Bagian Navigasi -->
    <header>
        <nav class="navbar">
            <div class="logo">Rasa<span>Nusantara</span></div>
            <ul class="nav-links">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <!-- Bagian Konten Utama -->
    <main class="hero">
        <div class="hero-content">
            <h1>Lezatnya Kuliner Tradisional dengan <span>Sentuhan Modern</span></h1>
            <p>Nikmati perpaduan bumbu rempah asli Indonesia pilihan yang dimasak dengan standar higienis tinggi. Kami mengutamakan kesegaran bahan untuk menyajikan cita rasa terbaik langsung ke meja Anda.</p>
            <a href="#" class="btn-menu">Jelajahi Menu</a>
        </div>
        <div class="hero-image">
            <!-- Gambar makanan otomatis dari internet -->
            <img src="https://unsplash.com" alt="Sajian Kuliner Lezat">
        </div>
    </main>

</body>
</html>
