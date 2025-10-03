# MCP (Milestone Checkpoint Plan) - Laravel Filament Boilerplate

## Tujuan
Membangun boilerplate Laravel Filament 4.x dengan fitur utama: **Manajemen User Login & CRUD User**.

---

## Checkpoint 1: Setup & Instalasi Dasar
- [x] Inisialisasi project Laravel baru
- [x] Instalasi Filament 4.x (`composer require filament/filament`)
- [x] Jalankan `php artisan filament:install`
- [x] Konfigurasi database & environment

---

## Checkpoint 2: Autentikasi User
- [ ] Implementasi fitur login/logout user (menggunakan Filament Auth bawaan)
- [ ] Proteksi route admin menggunakan middleware autentikasi

---

## Checkpoint 3: CRUD User Management
- [ ] Generate Filament Resource untuk User (`php artisan make:filament-resource User`)
- [ ] Implementasi form tambah/edit user (name, email, password, dsb)
- [ ] Implementasi tabel user (list, search, filter, aksi edit/hapus)
- [ ] Validasi data user pada form

---

## Checkpoint 4: Pengujian Dasar
- [ ] Uji coba login/logout
- [ ] Uji coba CRUD user (tambah, edit, hapus, lihat)
- [ ] Pastikan hanya admin yang bisa akses halaman user management

---

## Checkpoint 5: Dokumentasi & Finalisasi
- [ ] Update README & dokumentasi penggunaan
- [ ] Cleanup kode & struktur folder
- [ ] Checklist fitur utama sudah berjalan

---

**Catatan:**  
Centang ([x]) menandakan langkah sudah selesai.  
Silakan update checklist sesuai progres
