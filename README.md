# 🖨️ Website Toko Fotokopi - Laravel 10  

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP->=8.1-777BB4?logo=php&logoColor=white)
![Status](https://img.shields.io/badge/Status-Academic%20Project-blue)
![License](https://img.shields.io/badge/License-MIT-green)

Project ini adalah **Tugas Akhir Kuliah** yang saya buat dengan tujuan merancang **website penjualan** untuk toko fotokopi.  
Website ini memiliki dua fitur utama:
1. **Pembelian barang secara online**  
2. **Pemesanan jasa cetak dokumen secara online**

Selain itu, sistem pembayaran sudah terintegrasi dengan **Payment Gateway** (mode sandbox).

---

## 🚀 Fitur Utama
- Autentikasi pengguna (Register & Login).
- Manajemen produk (barang & jasa cetak dokumen).
- Pembelian barang online.
- Pemesanan jasa cetak dokumen online.
- Integrasi **Payment Gateway** (sandbox mode).
- Dashboard Admin untuk mengelola produk & pesanan.
- Seeder untuk akun admin (akun pembeli wajib daftar di menu **Register**).

---

## 🛠️ Teknologi yang Digunakan
- **Laravel 10** (Framework utama).
- **MySQL** (Database).
- **Bootstrap** (untuk tampilan UI).
- **Payment Gateway** (sandbox).

---

## 📂 Instalasi & Menjalankan Project

### 1. Clone repository
```bash
git clone https://github.com/username/arc-fotocopy-store-revisi.git
cd arc-fotocopy-store
```
### 2. Install dependency
```bash
composer install
```
### 3. install aplikasi pendukung
- xpdf-tools, dapat didownload di link : https://www.xpdfreader.com/download.html
tools ini saya gunakan untuk membaca jumlah halaman pdf yang akan dicetak pembeli secara otomatis.
### 4.konfigurasi file `.env`
```bash
cp .env.example .env
```

```env
APP_NAME="ARC Fotokopi"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Payment Gateway midtrans(sandbox)
PAYMENT_GATEWAY_KEY=
PAYMENT_GATEWAY_SECRET=
PAYMENT_GATEWAY_MODE=

#captha google, pakai yg v2
NOCAPTCHA_SITEKEY=
NOCAPTCHA_SECRET=
```

### 5.generate application key
```bash
php artisan key:generate
```

### 6.migrasi & seeder database
```bash
php artisan migrate --seed
```

### 7.link storage
```bash
php artisan storage:link
```

### 8.jalankan server lokal
```bash
php artisan serve
```

Akses di: `http://localhost:8000`
