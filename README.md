# Sistem Informasi Rental Mobil – UAS PWL

Sistem Informasi Rental Mobil merupakan aplikasi web yang dibuat dalam rangka **Ujian Akhir Semester (UAS) Pemrograman Web Lanjutan (PWL)** untuk mengelola bisnis rental mobil secara digital, mulai dari pengelolaan data mobil, driver, transaksi hingga laporan.

Aplikasi ini dibangun menggunakan **Laravel 10**, **PHP 8.2**, **MySQL** dan menerapkan konsep **CRUD** serta role-based access control untuk admin dan kasir.

---

## 📌 Fitur Utama

### 🛠️ Backend (Admin & Kasir)

* Manajemen **Mobil**
* Manajemen **Driver**
* Manajemen **User** (admin & kasir)
* Manajemen **Transaksi Sewa**
* Laporan transaksi berdasarkan tanggal
* Dashboard ringkasan (mobil tersedia, total transaksi, total pendapatan)

### 👤 Pengguna (Customer)

* Registrasi dan login pengguna
* Pemesanan mobil online
* Cetak invoice
* Pembayaran via transfer/tunai

---

## 📁 Struktur Proyek

```
projek-uas-pwl-rental/
├─ app/
├─ bootstrap/
├─ config/
├─ database/
├─ public/
├─ resources/
├─ routes/
├─ tests/
├─ artisan
├─ composer.json
├─ package.json
└─ vite.config.js
```

Struktur folder mengikuti **standar Laravel** yang memisahkan antara model, controller, view, konfigurasi, dan asset publik.

---

## 🧾 Teknologi yang Digunakan

| Teknologi                         | Versi               |
| --------------------------------- | ------------------- |
| Laravel                           | 10.x                |
| PHP                               | 8.2                 |
| MySQL                             | Latest              |
| Blade                             | Laravel View Engine |
| Tailwind / Bootstrap              | CSS Framework       |
| Filament Admin Panel *(opsional)* | Admin UI            |

---

## 📥 Cara Instalasi

Ikuti langkah berikut untuk menjalankan aplikasi di lokal:

1. **Clone repository**

   ```bash
   git clone https://github.com/Nopwall09/projek-uas-pwl-rental.git
   cd projek-uas-pwl-rental
   ```

2. **Install dependencies**

   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Setup environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   Edit file `.env`:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrasi database + seeder**

   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan server**

   ```bash
   php artisan serve
   ```

---

## 🧠 Cara Menambah User Admin / Kasir

Untuk membuat akun admin atau kasir, gunakan perintah artisan:

```bash
php artisan make:filament-user
```

Ikuti instruksi untuk memasukkan email, password, dan role.

---

## 📦 Library & Paket Eksternal

Proyek ini menggunakan beberapa paket eksternal seperti:

* Filament Admin Panel
* Laravel Breeze / Jetstream (untuk login & registrasi)
* Laravel UI

> Sesuaikan bagian ini jika ada paket lain yang digunakan.

---

## 📊 Screenshot *(opsional)*

Tambahkan beberapa screenshot UI project:

```
![Dashboard](link-gambar-dashboard)
![Form Transaksi](link-gambar-form)
```

---

## 💡 Kontribusi

Jika ingin berkontribusi:

1. Fork repository
2. Buat *branch* baru
3. Tambahkan fitur atau perbaikan
4. Buat pull request

---

## 📄 Lisensi

Proyek ini dirilis di bawah **MIT License** — bebas digunakan, dimodifikasi, dan didis
