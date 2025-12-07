# suite.in - Hotel Booking Website

Website booking hotel lengkap menggunakan Laravel dan MySQL (XAMPP).

## Fitur

- ✅ Authentication (Login, Register, Logout)
- ✅ Pencarian Hotel berdasarkan kota
- ✅ Detail Hotel dengan daftar kamar
- ✅ Sistem Booking lengkap
- ✅ Payment System (Dummy - siap untuk integrasi Midtrans)
- ✅ History Booking
- ✅ Profile Management
- ✅ Responsive Design dengan style Google (clean & modern)

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- XAMPP (MySQL)
- Laravel 12

## Installation

1. **Clone atau pastikan Anda berada di direktori project**
   ```bash
   cd c:\xampp\htdocs\suite-in
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment**
   - Copy `.env.example` ke `.env` (jika belum ada)
   - Edit `.env` dan set konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=suite_in
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Buat Database**
   - Buka phpMyAdmin (http://localhost/phpmyadmin)
   - Buat database baru dengan nama `suite_in`

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Database (Data Sample)**
   ```bash
   php artisan db:seed
   ```

8. **Create Storage Link (untuk upload gambar)**
   ```bash
   php artisan storage:link
   ```

9. **Build Assets**
   ```bash
   npm run build
   ```

10. **Start Development Server**
    ```bash
    php artisan serve
    ```

    Website akan tersedia di: http://localhost:8000

## Default Login

Setelah menjalankan seeder, Anda bisa login dengan:

### Admin
- **Email:** admin@suite.in
- **Password:** admin123
- **Role:** Admin (full access)

### Hotel Owner
- **Email:** owner@suite.in
- **Password:** owner123
- **Role:** Hotel Owner (manage own hotels)

### Customer
- **Email:** test@example.com
- **Password:** password
- **Role:** Customer (booking only)

**Lihat `ADMIN_GUIDE.md` untuk panduan lengkap mengelola hotel.**

## Struktur Database

- **hotels** - Data hotel
- **room_types** - Tipe kamar (Standard, Deluxe, Suite, dll)
- **rooms** - Data kamar per hotel
- **amenities** - Fasilitas hotel/kamar
- **hotel_amenities** - Relasi hotel dengan amenities
- **room_amenities** - Relasi room dengan amenities
- **bookings** - Data pemesanan
- **booking_rooms** - Relasi booking dengan rooms
- **payments** - Data pembayaran
- **reviews** - Review hotel
- **users** - Data user (dengan role: customer, hotel_owner, admin)
- **sessions** - Session data untuk authentication

## Integrasi Midtrans

Untuk mengganti dummy payment dengan Midtrans:

1. Install Midtrans package:
   ```bash
   composer require midtrans/midtrans-php
   ```

2. Update `PaymentController.php` method `process()` untuk menggunakan Midtrans API

3. Tambahkan konfigurasi di `.env`:
   ```env
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_IS_PRODUCTION=false
   ```

## Notes

## Fitur Admin & Hotel Owner

Website ini memiliki sistem role-based access:
- **Admin:** Bisa menambah, edit, hapus semua hotel. Hotel langsung aktif.
- **Hotel Owner:** Bisa menambah hotel sendiri, tapi perlu approval admin untuk aktif.
- **Customer:** Hanya bisa booking hotel.

**Lihat `ADMIN_GUIDE.md` untuk panduan lengkap mengelola hotel.**

## Notes

- Pastikan XAMPP MySQL service sudah running
- Untuk upload gambar hotel/room, pastikan folder `storage/app/public` memiliki permission yang tepat
- Website ini menggunakan Tailwind CSS untuk styling
- Pastikan sudah menjalankan `php artisan storage:link` untuk upload gambar

## Troubleshooting

- **Error: SQLSTATE[HY000] [1045] Access denied**
  - Pastikan username dan password MySQL di `.env` benar
  - Pastikan MySQL service di XAMPP sudah running

- **Error: Class not found**
  - Jalankan `composer dump-autoload`

- **Gambar tidak muncul**
  - Pastikan sudah menjalankan `php artisan storage:link`
  - Pastikan folder `storage/app/public` ada dan writable

