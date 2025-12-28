# UMKM Florist (Laravel)

Project Laravel untuk aplikasi katalog produk + panel admin (CRUD kategori & produk).

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- Git

## Setup (Windows / Laragon)

1) Clone repo

```bash
git clone <url-repo>
cd umkm_florist
```

2) Install dependency backend

```bash
composer install
```

3) Install dependency frontend

```bash
npm install
```

4) Buat file env

Kalau belum ada `.env`, copy dari `.env.example`.

PowerShell:

```powershell
Copy-Item .env.example .env
```

5) Generate app key

```bash
php artisan key:generate
```

6) Database

Project ini memakai MySQL.

1) Buat database di MySQL (misalnya lewat phpMyAdmin Laragon):

- Nama DB: `umkm_florist`

2) Pastikan `.env` sudah pakai MySQL (default dari `.env.example` sudah MySQL):

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=umkm_florist
DB_USERNAME=root
DB_PASSWORD=
```

7) Jalankan migration

```bash
php artisan migrate
```

8) (Opsional tapi disarankan) Seed data

Seeder akan membuat akun admin default:

- Email: `locco@gmail.com`
- Password: `password`

Jalankan:

```bash
php artisan db:seed
```

9) Konfigurasi akses admin (WAJIB)

Route admin memakai middleware `admin-only` yang whitelist email admin dari env `PRODUCT_ADMIN_EMAILS`.

Di `.env` isi misalnya:

```dotenv
PRODUCT_ADMIN_EMAILS=locco@gmail.com
```

Kalau email tidak masuk whitelist, login berhasil tapi akan kena `403` saat akses halaman admin.

10) Konfigurasi WhatsApp (WAJIB untuk tombol pesan)

Fitur "Pesan via WhatsApp" mengambil nomor dari env:

- `SELLER_WHATSAPP_NUMBER`: nomor admin/penjual untuk chat order
- `SELLER_WHATSAPP_BANNER`: nomor untuk tombol/banner (kalau dipakai di halaman tertentu)

Isi di `.env` (contoh format internasional Indonesia: mulai `62`, tanpa `+`, tanpa spasi):

```dotenv
SELLER_WHATSAPP_NUMBER=6281234567890
SELLER_WHATSAPP_BANNER=6281234567890
```

Catatan:

- Kalau nomor kosong, tombol WA bisa tidak berfungsi / link jadi invalid.
- Kalau kamu mau bedain nomor banner dan order, isi dengan nomor yang berbeda.

11) Storage link (kalau butuh akses file di `storage/app/public`)

```bash
php artisan storage:link
```

## Run (2 terminal)

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Buka aplikasi:

- http://127.0.0.1:8000

Login admin:

- http://127.0.0.1:8000/admin/login

## Alternatif (1 command)

Project ini juga punya script untuk jalanin server + vite bareng:

```bash
composer run dev
```

## Troubleshooting
- Jika admin kena `403`, pastikan email admin ada di `PRODUCT_ADMIN_EMAILS`.
