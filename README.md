<<<<<<< HEAD
# 📚 Dashboard Absensi - Sistem Manajemen Kehadiran

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.4+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Filament-3.x-FF6B35?style=for-the-badge&logo=filament&logoColor=white" alt="Filament">
</p>

<p align="center">
  Sistem manajemen kehadiran modern dengan QR Code untuk institusi pendidikan
</p>

## 🚀 Fitur Utama

-   **QR Code Absensi**: Generate dan scan QR code untuk absensi otomatis
-   **Dashboard Admin**: Interface admin dengan Filament untuk manajemen data
-   **Role Management**: Multi-role (Admin, Dosen, Mahasiswa)
-   **Real-time Notification**: Notifikasi sukses/gagal secara real-time
-   **Responsive Design**: UI yang responsif untuk semua perangkat
-   **Manual QR Input**: Input manual kode QR untuk backup
-   **Laporan Absensi**: Generate laporan kehadiran

## 📋 Prasyarat

Pastikan sistem Anda memiliki:

-   **PHP 8.4+** (dengan ekstensi: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
-   **Composer** (versi terbaru)
-   **Node.js & NPM** (untuk asset compilation)
-   **MySQL 8.0+** atau **MariaDB 10.3+**
-   **Web Server** (Apache/Nginx/PHP built-in server)

## 🛠️ Instalasi dan Setup

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/dashboard-absen.git
cd dashboard-absen
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Buat database MySQL baru:

```sql
CREATE DATABASE absen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit file `.env` dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absen
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Migrasi Database

```bash
# Jalankan migrasi
php artisan migrate

php artisan db:seed
```

### 6. Setup Storage

```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Set permission (Linux/Mac)
chmod -R 775 storage bootstrap/cache
```

### 7. Compile Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Aplikasi

```bash
# Menggunakan PHP built-in server
php artisan serve

# Aplikasi akan berjalan di http://127.0.0.1:8000
```

Ikuti prompt untuk membuat akun admin, kemudian akses panel admin di:

```
http://127.0.0.1:8000/admin
```

### Generate Test Data

```bash
# Generate QR code dan data test
php artisan test:qr
```

### Clear Cache (jika diperlukan)

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 📱 Penggunaan

### 1. Login sebagai Admin

-   Akses: `http://127.0.0.1:8000/admin`
-   Kelola data dosen, mahasiswa, mata kuliah, dan jadwal

### 2. Login sebagai Dosen

-   Akses: `http://127.0.0.1:8000/login-user`
-   Buat jadwal kuliah dan generate QR code
-   Monitor kehadiran mahasiswa

### 3. Login sebagai Mahasiswa

-   Akses: `http://127.0.0.1:8000/login-user`
-   Scan QR code untuk absensi
-   Lihat riwayat kehadiran

## 🎯 Akun Default

Setelah menjalankan seeder, tersedia akun default:

| Role      | Email                 | Password |
| --------- | --------------------- | -------- |
| Admin     | admin@example.com     | password |
| Dosen     | dosen@example.com     | password |
| Mahasiswa | mahasiswa@example.com | password |

## 🗂️ Struktur Database

### Tabel Utama:

-   `users` - Data pengguna sistem
-   `dosen` - Data dosen
-   `mahasiswa` - Data mahasiswa
-   `matakuliah` - Data mata kuliah
-   `jadwal` - Jadwal perkuliahan
-   `qrcodes` - QR code untuk absensi
-   `absensi` - Record kehadiran

### Relasi:

-   User (1:1) Dosen/Mahasiswa
-   Dosen (1:N) Matakuliah
-   Matakuliah (1:N) Jadwal
-   Jadwal (1:N) QRCode
-   Jadwal (N:M) Mahasiswa
-   Absensi (N:1) Jadwal, Mahasiswa, QRCode

## 🔍 Troubleshooting

### Error "Class not found"

```bash
composer dump-autoload
```

### Error Permission Denied

```bash
# Linux/Mac
sudo chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Windows (run as Administrator)
icacls storage /grant "IIS_IUSRS:(OI)(CI)F" /T
icacls bootstrap\cache /grant "IIS_IUSRS:(OI)(CI)F" /T
```

### Error Database Connection

1. Pastikan MySQL service berjalan
2. Periksa kredensial database di `.env`
3. Test koneksi: `php artisan migrate:status`

### Asset tidak ter-load

```bash
npm run build
php artisan view:clear
```

## 🚀 Development

### Menjalankan dalam mode development:

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Asset watcher
npm run dev
```

### Testing:

```bash
# Run tests
php artisan test

# Test QR functionality
php artisan test:notifications
```

---

<p align="center">
  Dibuat dengan ❤️ menggunakan Laravel & Filament
</p>
=======
# KElOMPOK_03-Pak-Yadi-
>>>>>>> b3b215545d93ed72788239c39215a640cb24e365
