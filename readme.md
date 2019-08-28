# FANINTEK Custom Laravel Package

Ini merupakan custom laravel package yang telah tersusun dan terstandarisasi.

## Instalasi
1. Buka terminal bash/command prompt;
2. Jalankan perintah `composer install` untuk mengunduh package yang dibutuhkan;
3. Jalankan perintah `php artisan key:generate` untuk generate Application Key;
4. Mulai Konfigurasikan Environment database,mail server dll  pada file `.env`
5. Jalankan perintah `php artisan migrate` untuk melakukan migrasi table ke database;
6. Mulai Konfigurasi yang diperlukan pada file `core/Config/fanrbac.php` ;
7. Jalankan perintah `php artisan db:seed`;
8. Selesai.

## Fitur
1. Authorization Scaffolding
2. RBAC (Role Base Account Control)
3. Panel Menu Generator
4. DataTables Generator (Yajra/DataTables)
5. Laravel DebugBar
6. User Management
7. Role Management
8. **(Coming Soon)** Menu Management