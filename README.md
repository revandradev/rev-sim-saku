<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# ISaku

ISaku adalah aplikasi pencatat keuangan berbasis Laravel yang menggunakan Filament sebagai admin panel dan user panel. Aplikasi ini dirancang agar mudah dikembangkan, modern, dan responsif.

## Deskripsi

ISaku membantu Anda mencatat transaksi keuangan, mengelola data diri, serta mengatur pengaturan aplikasi secara mudah dan aman. Dibangun dengan Laravel 10 dan Filament 4, aplikasi ini cocok untuk kebutuhan personal maupun bisnis kecil.

## Fitur

- **Manajemen Transaksi:** Catat pemasukan dan pengeluaran dengan mudah.
- **Riwayat Transaksi:** Lihat histori transaksi secara detail.
- **Pengaturan Data Diri:** Edit profil dan data pengguna.
- **Pengaturan Umum:** Ubah nama dan slogan aplikasi.
- **Notifikasi:** Mendapatkan notifikasi langsung di panel.
- **Lockscreen:** Keamanan tambahan dengan auto lock saat idle.
- **Footer Custom:** Informasi footer yang dapat dikustomisasi.
- **Tema & Font:** Tampilan modern dengan dukungan tema dan font custom.

## Cara Install

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/laravel-filament-boilerplate.git
   cd laravel-filament-boilerplate
   ```

2. **Install Dependency**
   ```bash
   composer install
   npm install
   ```

3. **Copy File Environment**
   ```bash
   cp .env.example .env
   ```

4. **Generate Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

6. **Build Asset**
   ```bash
   npm run dev
   ```

7. **Jalankan Server**
   ```bash
   php artisan serve
   ```

## Kontribusi

Silakan buat pull request atau issue jika ingin berkontribusi atau menemukan bug.

---

© 2025 - Dibuat dengan ❤️ oleh revandev
