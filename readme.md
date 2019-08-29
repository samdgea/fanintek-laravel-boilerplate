# FANINTEK Custom Laravel Package

Ini merupakan custom laravel package yang telah tersusun dan terstandarisasi.

## Instalasi
1. Buka terminal bash/command prompt;
2. Jalankan perintah `composer install` untuk mengunduh package yang dibutuhkan;
3. Jalankan perintah `cp .env.example .env` untuk menduplikat file .env.example menjadi .env
4. Jalankan perintah `php artisan key:generate` untuk generate Application Key;
5. Mulai Konfigurasikan Environment database,mail server dll  pada file `.env`;
6. **Opsional**: Untuk pengguna MariaDB, buka file `core/Config/database.php` dan konfigurasikan *charset* menjadi `utf8` dan *collation* menjadi `utf8_unicode_ci`;
7. Jalankan perintah `php artisan migrate` untuk melakukan migrasi table ke database;
8. Mulai Konfigurasi yang diperlukan pada file `core/Config/fanrbac.php` ;
9. Jalankan perintah `php artisan db:seed`;
10. Selesai.

## Memulai
1. Jalankan perintah `npm build` **Hanya 1x saja**
2. Jalankan perintah `npm run watch`

## Fitur
1. Authorization Scaffolding
2. RBAC (Role Base Account Control)
3. Panel Menu Generator
4. DataTables Generator (Yajra/DataTables)
5. Laravel DebugBar
6. User Management
7. Role Management
8. Menu Management
9. **New** Auto Reload