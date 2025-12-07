# Panduan Admin & Hotel Owner - suite.in

## Akses Login

### Admin
- **Email:** admin@suite.in
- **Password:** admin123
- **Akses:** Full access ke semua hotel dan fitur admin

### Hotel Owner
- **Email:** owner@suite.in
- **Password:** owner123
- **Akses:** Hanya bisa mengelola hotel miliknya sendiri

### Customer (Test)
- **Email:** test@example.com
- **Password:** password
- **Akses:** Booking hotel sebagai customer

## Cara Menambahkan Hotel (Admin)

1. **Login sebagai Admin**
   - Akses: http://127.0.0.1:8000/login
   - Login dengan: admin@suite.in / admin123

2. **Akses Dashboard**
   - Klik "Dashboard" di navigation bar
   - Atau langsung ke: http://127.0.0.1:8000/admin/dashboard

3. **Tambah Hotel Baru**
   - Klik "Manage Hotels" atau "Hotels" di navigation
   - Klik tombol "+ Add New Hotel"
   - Isi semua informasi hotel:
     - Nama hotel
     - Deskripsi
     - Alamat lengkap
     - Kota, Provinsi, Kode Pos
     - Nomor telepon dan email
     - Rating bintang (1-5)
     - Upload gambar hotel (opsional)
     - Pilih amenities yang tersedia
   - Klik "Create Hotel"

4. **Hotel akan langsung aktif** (karena dibuat oleh admin)

## Cara Menambahkan Hotel (Hotel Owner)

1. **Login sebagai Hotel Owner**
   - Akses: http://127.0.0.1:8000/login
   - Login dengan: owner@suite.in / owner123

2. **Akses Dashboard**
   - Klik "Dashboard" di navigation bar

3. **Tambah Hotel Baru**
   - Klik "Hotels" di navigation
   - Klik tombol "+ Add New Hotel"
   - Isi semua informasi hotel (sama seperti admin)
   - **Catatan:** Hotel yang dibuat oleh hotel owner akan berstatus **Inactive** dan perlu **approval dari admin** sebelum muncul di website

4. **Admin perlu mengaktifkan hotel** agar muncul di website

## Cara Mengelola Rooms

1. **Akses Hotel Management**
   - Dari dashboard, klik "Hotels"
   - Pilih hotel yang ingin dikelola

2. **Tambah Room**
   - Klik "Rooms" pada hotel yang dipilih
   - Klik "+ Add New Room"
   - Isi informasi:
     - Pilih tipe room (Standard, Deluxe, Suite, Executive)
     - Nomor kamar (unik per hotel)
     - Harga per malam
     - Quantity (jumlah kamar dengan tipe yang sama)
     - Deskripsi (opsional)
     - Upload gambar (opsional)
     - Pilih amenities kamar
   - Klik "Create Room"

3. **Edit Room**
   - Dari daftar rooms, klik "Edit"
   - Ubah informasi yang diperlukan
   - Klik "Update Room"

4. **Hapus Room**
   - Klik "Delete" pada room yang ingin dihapus
   - Konfirmasi penghapusan

## Fitur Dashboard

### Untuk Admin:
- Melihat semua hotel di sistem
- Melihat semua bookings
- Total revenue dari semua hotel
- Recent bookings dari semua hotel

### Untuk Hotel Owner:
- Melihat hanya hotel miliknya
- Melihat bookings untuk hotel miliknya
- Total revenue dari hotel miliknya
- Recent bookings untuk hotel miliknya

## Workflow Hotel Owner

1. **Register/Login** sebagai hotel owner
2. **Tambah Hotel** - Hotel akan berstatus Inactive
3. **Tambah Rooms** untuk hotel tersebut
4. **Admin mengaktifkan hotel** - Hotel muncul di website
5. **Customer bisa booking** hotel tersebut

## Workflow Admin

1. **Login** sebagai admin
2. **Tambah Hotel** langsung aktif, atau
3. **Approve Hotel** dari hotel owner (ubah status menjadi Active)
4. **Monitor semua bookings** dan revenue
5. **Kelola semua hotel** di sistem

## Catatan Penting

- **Hotel Owner** tidak bisa mengaktifkan/menonaktifkan hotel sendiri (perlu admin)
- **Admin** memiliki akses penuh ke semua hotel
- **Room Number** harus unik per hotel
- **Upload gambar** akan disimpan di `storage/app/public/hotels` dan `storage/app/public/rooms`
- Pastikan sudah menjalankan `php artisan storage:link` untuk akses gambar

## URL Routes

- **Admin Dashboard:** `/admin/dashboard`
- **Manage Hotels:** `/admin/hotels`
- **Add Hotel:** `/admin/hotels/create`
- **Edit Hotel:** `/admin/hotels/{id}/edit`
- **Manage Rooms:** `/admin/hotels/{hotelId}/rooms`
- **Add Room:** `/admin/hotels/{hotelId}/rooms/create`
- **Edit Room:** `/admin/hotels/{hotelId}/rooms/{roomId}/edit`

