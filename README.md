# AUTOVEX
## Motorcycle Service Management System

AUTOVEX merupakan aplikasi berbasis web untuk membantu pengelolaan layanan service sepeda motor. Aplikasi ini dibuat menggunakan Laravel 13, PHP, MySQL, dan API yang dapat diuji menggunakan Postman.

### Fitur Aplikasi

1. **Data Pelanggan**
   - Tambah, lihat, edit, dan hapus data pelanggan.
   - Informasi nama, nomor HP, alamat, dan pekerjaan.

2. **Data Kendaraan**
   - Mengelola data kendaraan pelanggan.
   - Pilihan jenis kendaraan Matic dan Manual Transmisi.

3. **Daftar Service**
   - Pendaftaran service kendaraan.
   - Dropdown kendaraan dan pelanggan.
   - Nama pelanggan terisi otomatis.

4. **Data Service**
   - Pengelolaan detail pengerjaan service.
   - Keluhan kendaraan terisi otomatis berdasarkan ID Service.
   - Estimasi biaya, mekanik, dan sparepart.

5. **Pembayaran Service**
   - Pengelolaan transaksi pembayaran.
   - Pilihan Cash/Tunai dan Non Tunai.
   - Informasi jumlah biaya dan keterangan pembayaran.

### Teknologi yang Digunakan

- Laravel 13
- PHP 8.5
- MySQL
- HTML, CSS, dan JavaScript
- Composer
- Node.js dan NPM
- Git dan GitHub
- Postman

---

# CARA INSTALASI DAN MENJALANKAN AUTOVEX

## 1. Persiapan Software

Pastikan komputer sudah memiliki:
- XAMPP
- PHP yang kompatibel dengan Laravel 13
- Composer
- Node.js dan NPM
- Git
- Visual Studio Code

## 2. Clone Repository

Buka terminal VS Code, kemudian jalankan:

```bash
git clone https://github.com/Mulia123456/autovex13.git
```

Masuk ke folder aplikasi:

```bash
cd autovex13
```

## 3. Instal Dependency Laravel

Jalankan:

```bash
composer install
```

## 4. Membuat File Environment

Pada PowerShell, jalankan:

```powershell
Copy-Item .env.example .env
```

Kemudian buat application key:

```bash
php artisan key:generate
```

## 5. Konfigurasi Database MySQL

Buka file `.env`, kemudian atur konfigurasi berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=autovex_db
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password MySQL dengan konfigurasi komputer masing-masing.

## 6. Membuat Database

1. Jalankan Apache dan MySQL melalui XAMPP.
2. Buka phpMyAdmin.
3. Buat database dengan nama `autovex_db`.

## 7. Membuat Tabel Database

Jalankan perintah:

```bash
php artisan migrate
```

## 8. Instal Dependency Frontend

Pada terminal jalankan:

```bash
npm install
```

Jika menggunakan PowerShell Windows dan perintah tersebut diblokir, gunakan:

```powershell
npm.cmd install
```

Kemudian bangun aset aplikasi:

```powershell
npm.cmd run build
```

## 9. Menjalankan Aplikasi

Jalankan:

```bash
php artisan serve
```

Buka browser dan akses:

```text
http://127.0.0.1:8000
```

Aplikasi AUTOVEX siap digunakan.

---

# API AUTOVEX

API tersedia untuk lima modul berikut:

```text
/api/pelanggans
/api/kendaraans
/api/daftar-services
/api/data-services
/api/pembayaran-services
```

API dapat diuji menggunakan Postman dengan metode GET, POST, PUT, dan DELETE.

### Catatan

- File `.env` tidak disertakan dalam repository demi keamanan.
- Folder `vendor` dan `node_modules` dibuat kembali melalui proses instalasi dependency.
- Database harus dibuat dan dimigrasikan pada komputer masing-masing.
- Data pelanggan, kendaraan, dan transaksi dari komputer pembuat project tidak otomatis ikut tersalin melalui Git Clone.

**Repository GitHub:**  
https://github.com/Mulia123456/autovex13