# AUTOVEX
### Motorcycle Service Management System

AUTOVEX merupakan aplikasi berbasis web untuk membantu pengelolaan layanan servis sepeda motor secara terstruktur dan terintegrasi. Aplikasi ini dikembangkan menggunakan Laravel 13, PHP, MySQL, HTML, CSS, JavaScript, serta REST API yang dapat diuji menggunakan Postman.

AUTOVEX membantu proses pengelolaan data pelanggan, kendaraan, pendaftaran servis, pengerjaan servis, hingga pembayaran melalui satu sistem.

## Fitur Aplikasi

### 1. Data Pelanggan
- Menambah, melihat, mengedit, dan menghapus data pelanggan.
- Mengelola nama lengkap, nomor HP, alamat, dan pekerjaan.

### 2. Data Kendaraan
- Mengelola informasi kendaraan pelanggan.
- Menyimpan nomor plat, jenis kendaraan, nomor STNK, tahun pembuatan, nama pemilik, dan warna.
- Menyediakan pilihan jenis kendaraan Matic dan Manual Transmisi.

### 3. Daftar Service
- Mendaftarkan kendaraan yang akan diservis.
- Memilih kendaraan dan pelanggan melalui dropdown.
- Menampilkan nama pelanggan secara otomatis.
- Mencatat keluhan kendaraan dan tanggal servis.

### 4. Data Service
- Mengelola detail pekerjaan servis.
- Memilih ID Service dari data pendaftaran.
- Menampilkan keluhan kendaraan secara otomatis berdasarkan ID Service.
- Mengelola estimasi servis, mekanik, dan sparepart pengganti.

### 5. Pembayaran Service
- Mengelola transaksi pembayaran servis.
- Menyediakan pilihan Cash/Tunai dan Non Tunai.
- Mencatat jumlah biaya dan keterangan pembayaran.

## Teknologi yang Digunakan

- Laravel Framework 13
- PHP 8.5.12 pada lingkungan pengembangan
- MySQL
- HTML, CSS, dan JavaScript
- Composer
- Node.js dan NPM
- XAMPP dan phpMyAdmin
- Git dan GitHub
- Postman
- Visual Studio Code

## Persyaratan Sistem

Sebelum menjalankan AUTOVEX, pastikan komputer memiliki:

1. PHP minimal 8.4.1 sesuai dependency yang digunakan pada project.
2. Composer untuk instalasi package PHP.
3. Node.js dan NPM untuk mengelola aset frontend.
4. MySQL sebagai database.
5. Git untuk melakukan cloning repository.
6. Browser untuk membuka aplikasi.

**Penting:** Jika komputer memiliki beberapa versi PHP, pastikan terminal menggunakan versi yang kompatibel sebelum menjalankan Composer atau Laravel.

## Cara Instalasi dan Menjalankan AUTOVEX

### Langkah 1 — Memeriksa Versi PHP

Buka terminal PowerShell pada Visual Studio Code.

Jalankan:

```powershell
php -v
```

Pastikan versi PHP minimal 8.4.1.

Jika komputer Windows menggunakan PHP 8.2 dari XAMPP dan mempunyai PHP 8.5 di folder `C:\Cphp85`, jalankan:

```powershell
$env:Path = "C:\Cphp85;" + $env:Path
php -v
```

Lokasi folder PHP tersebut hanya contoh dari lingkungan pengembangan AUTOVEX dan harus disesuaikan pada komputer masing-masing.

### Langkah 2 — Clone Repository

Masuk ke direktori tempat project akan disimpan, misalnya:

```powershell
cd C:\xamppBARU\htdocs
```

Clone repository AUTOVEX:

```powershell
git clone https://github.com/Mulia123456/autovex13.git autovex13-clone
```

Masuk ke direktori hasil clone:

```powershell
cd autovex13-clone
```

**Catatan:** Hindari melakukan clone di dalam folder AUTOVEX asli agar tidak membingungkan lokasi project. Nama folder clone boleh disesuaikan.

### Langkah 3 — Instal Dependency Laravel

Pastikan terminal berada di folder yang berisi `artisan` dan `composer.json`.

Jalankan:

```powershell
composer install
```

Composer akan menginstal dependency berdasarkan file `composer.lock`.

Jika muncul masalah ketidakcocokan versi PHP, periksa kembali versi PHP aktif. Jangan langsung menggunakan `composer update` atau `--ignore-platform-reqs`.

### Langkah 4 — Membuat File Environment

Jalankan:

```powershell
Copy-Item .env.example .env
```

Perintah tersebut membuat file `.env` berdasarkan konfigurasi contoh.

Kemudian jalankan:

```powershell
php artisan key:generate
```

### Langkah 5 — Konfigurasi Database MySQL

Jalankan MySQL melalui XAMPP, kemudian buka phpMyAdmin.

Buat database bernama:

`autovex_db`

Setelah itu, buka file `.env` pada Visual Studio Code dan atur konfigurasi database berikut:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=autovex_db
DB_USERNAME=root
DB_PASSWORD=
```

**Penting:** Konfigurasi tersebut harus ditulis di file `.env`, bukan dijalankan sebagai perintah PowerShell.

Username dan password MySQL dapat berbeda pada setiap komputer.

### Langkah 6 — Membersihkan Cache Konfigurasi

Jalankan:

```powershell
php artisan config:clear
```

Perintah tersebut digunakan untuk membersihkan cache konfigurasi agar Laravel menggunakan pengaturan environment yang sesuai.

### Langkah 7 — Membuat Tabel Database

Setelah koneksi MySQL benar dan database sudah tersedia, jalankan:

```powershell
php artisan migrate
```

Migration akan membuat tabel aplikasi berdasarkan struktur yang telah didefinisikan pada project.

Jangan menggunakan `php artisan migrate:fresh` pada database yang memiliki data penting karena perintah tersebut menghapus seluruh tabel sebelum membuatnya kembali.

### Langkah 8 — Menginstal Dependency Frontend

Jalankan:

```powershell
npm.cmd install
```

Perintah `npm.cmd` digunakan untuk menghindari pemblokiran skrip `npm.ps1` pada beberapa konfigurasi PowerShell Windows.

Setelah instalasi selesai, bangun aset frontend:

```powershell
npm.cmd run build
```

Untuk pengembangan dengan Vite, dapat menggunakan:

```powershell
npm.cmd run dev
```

Jika menggunakan mode development, biarkan terminal Vite tetap aktif dan buka terminal baru untuk menjalankan Laravel.

### Langkah 9 — Menjalankan Aplikasi

Jalankan:

```powershell
php artisan serve
```

Kemudian buka browser:

http://127.0.0.1:8000

Apabila port 8000 sedang digunakan aplikasi lain, jalankan:

```powershell
php artisan serve --port=8001
```

Kemudian akses:

http://127.0.0.1:8001

Aplikasi AUTOVEX dapat digunakan setelah server berhasil dijalankan dan koneksi database tersedia.

## REST API AUTOVEX

AUTOVEX menyediakan REST API untuk lima modul:

```text
/api/pelanggans
/api/kendaraans
/api/daftar-services
/api/data-services
/api/pembayaran-services
```

API dapat diuji menggunakan Postman dengan metode HTTP:

- GET — mengambil data.
- POST — menambahkan data.
- PUT — memperbarui data.
- DELETE — menghapus data.

Endpoint yang memerlukan ID, struktur request body, dan aturan validasi perlu disesuaikan dengan route serta controller pada project.

## Catatan Penting Git Clone

1. File `.env` tidak disertakan dalam repository karena menyimpan konfigurasi lingkungan yang dapat berisi informasi sensitif.
2. Folder `vendor` dan `node_modules` perlu diinstal kembali menggunakan Composer dan NPM.
3. Database MySQL perlu disiapkan pada komputer yang menjalankan project.
4. Data pelanggan, kendaraan, dan transaksi tidak otomatis ikut tersalin melalui Git Clone.
5. Versi PHP yang tidak sesuai dapat menyebabkan `composer install` dan `php artisan serve` gagal.
6. Aplikasi hasil clone dapat menggunakan folder, port, dan database terpisah agar tidak mengganggu project asli.
7. Jangan mengunggah file `.env` atau kredensial database ke repository publik.

## Repository GitHub

https://github.com/Mulia123456/autovex13

**AUTOVEX — Motorcycle Service Management System**

Project aplikasi manajemen servis sepeda motor menggunakan Laravel, MySQL, REST API, Postman, dan GitHub.