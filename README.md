# TEMPEKU - Platform Edukasi & Direktori Kuliner Tempe

Aplikasi web modern berbasis **TALL Stack (Laravel 12, Livewire 4, Alpine.js, Tailwind CSS)** untuk informasi, resep kreatif, dan direktori tempat kuliner tempe untuk Sobat Kos.

---

## 🚀 Arsitektur & Tech Stack

Aplikasi ini telah sepenuhnya dimigrasi dari arsitektur PHP Native ke arsitektur modern berstandar enterprise:

* **Backend Framework:** [Laravel 12](https://laravel.com/) (PHP 8.3+)
* **Full-Stack Reactivity:** [Livewire](https://livewire.laravel.com/) dengan fitur SPA navigation (`wire:navigate`) & live debounce search
* **Client-Side Interactivity:** [Alpine.js](https://alpinejs.dev/) (Drawer navigasi, modal, galeri carousel)
* **Styling Framework:** [Tailwind CSS](https://tailwindcss.com/) dengan Material 3 Design Tokens
* **Image Processing:** [Intervention Image v4](https://image.intervention.io/) (Auto-convert seluruh foto unggahan ke format WebP)
* **Database:** MySQL / MariaDB (Mendukung 3NF dengan Eloquent ORM & Relasi Lengkap)

---

## 🔐 Akun Uji Coba & Hak Akses (Roles)

Dalam aplikasi TEMPEKU, terdapat dua role pengguna: **Administrator** dan **Pengguna Biasa (User)**.

### 1. Kredensial Akun Default
| Role | Username | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` | `rahasia123` | Akses penuh dashboard manajemen sistem |
| **User Biasa** | `udin` | `user123` | Akun anggota komunitas (Sobat Kos) |

> 💡 **Catatan:** Anda juga dapat mendaftarkan akun baru kapan saja melalui halaman **Daftar Akun** (`/register`). Setiap akun yang didaftarkan secara mandiri otomatis memiliki role `user`.

---

## ⚖️ Perbedaan Hak Akses: Admin vs User Biasa

| Fitur / Kemampuan | User Biasa (`role: user`) | Administrator (`role: admin`) |
| :--- | :---: | :---: |
| **Melihat Katalog Resep & Detail Resep** | ✅ Ya | ✅ Ya |
| **Melihat Direktori Tempat Kuliner & Menu** | ✅ Ya | ✅ Ya |
| **Pencarian Real-time (Livewire Search)** | ✅ Ya | ✅ Ya |
| **Menambahkan Resep Baru (`/resep/tambah`)** | ✅ Ya (Otomatis tercatat nama user) | ✅ Ya |
| **Menambahkan Tempat Kuliner (`/tempat/tambah`)** | ✅ Ya (Otomatis tercatat nama user) | ✅ Ya |
| **Akses Portal Admin (`/admin/login`)** | ❌ Ditolak | ✅ Ya |
| **Akses Dashboard Manajemen (`/admin`)** | ❌ 403 Forbidden | ✅ Ya |
| **Navigasi Khusus Admin di Header (Shield Icon)** | ❌ Sembunyi | ✅ Muncul |
| **Menghapus Resep Komunitas** | ❌ Tidak bisa | ✅ Ya (Hapus kapan saja) |
| **Menghapus Tempat Kuliner & Relasi Menu** | ❌ Tidak bisa | ✅ Ya (Cascade delete) |
| **Menambah Kategori Resep Baru** | ❌ Tidak bisa | ✅ Ya (Form instan via Livewire) |
| **Menghapus Kategori Resep** | ❌ Tidak bisa | ✅ Ya |
| **Melihat Statistik Pengguna & Konten** | ❌ Tidak bisa | ✅ Ya (Widget 4 Kartu Metrik) |

---

## 📂 Panduan Rute Utama (Routes)

| Fitur | Rute Modern | Rute Lama (Legacy Support) |
| :--- | :--- | :--- |
| **Beranda** | `/TEMPEKU/public/` | `/TEMPEKU/index.php` |
| **Katalog Resep** | `/TEMPEKU/public/index.php/resep` | `/TEMPEKU/index.php?page=resep/daftar` |
| **Detail Resep** | `/TEMPEKU/public/index.php/resep/{id}` | `/TEMPEKU/index.php?page=resep/detail&id={id}` |
| **Tambah Resep** | `/TEMPEKU/public/index.php/resep/tambah` | `/TEMPEKU/index.php?page=resep/tambah` |
| **Tempat Kuliner** | `/TEMPEKU/public/index.php/tempat` | `/TEMPEKU/index.php?page=tempat/daftar` |
| **Detail Tempat** | `/TEMPEKU/public/index.php/tempat/{id}` | `/TEMPEKU/index.php?page=tempat/detail&id={id}` |
| **Tambah Tempat** | `/TEMPEKU/public/index.php/tempat/tambah` | `/TEMPEKU/index.php?page=tempat/tambah` |
| **Masuk / Login** | `/TEMPEKU/public/index.php/login` | `/TEMPEKU/index.php?page=login` |
| **Daftar Akun** | `/TEMPEKU/public/index.php/register` | `/TEMPEKU/index.php?page=register` |
| **Keluar / Logout** | `/TEMPEKU/public/index.php/logout` | `/TEMPEKU/index.php?page=logout` |

---

## 🛠️ Perintah Pengembangan (Development Commands)

Untuk menjalankan server pengembangan lokal mandiri (opsional jika tidak melalui Apache):
```bash
php artisan serve
```

Untuk mengompilasi ulang aset Tailwind CSS & JavaScript:
```bash
npm run build
# atau untuk hot-reload saat ngoding:
npm run dev
```

Untuk menjalankan migrasi database:
```bash
php artisan migrate
```

---

## 🛡️ Keamanan & Optimasi
1. **CSRF Protection:** Seluruh form dilindungi token `@csrf` bawaan Laravel.
2. **SQL Injection Prevention:** Menggunakan Eloquent ORM parameterized PDO bindings.
3. **XSS Protection:** Blade template engine meng-escape seluruh input secara otomatis.
4. **Document Root Isolation:** Folder kode backend, berkas `.env`, dan database terisolasi di luar akses langsung browser.
5. **Auto WebP Conversion:** Upload foto langsung dikonversi menjadi format `.webp` untuk memangkas ukuran aset hingga 70-80% tanpa penurunan kualitas visual.
