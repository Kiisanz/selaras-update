# Selaras - Aplikasi CRM Penjualan Jasa Jahit

## Deskripsi
**Selaras** adalah aplikasi CRM (Customer Relationship Management) yang dirancang khusus untuk bisnis penjualan jasa jahit. Aplikasi ini membantu dalam mengelola pesanan pelanggan, menyediakan fitur toko online, serta memungkinkan pelanggan untuk melakukan kustomisasi produk dan pemesanan langsung.

## Fitur
- **Custom Produk** - Pelanggan dapat melakukan kustomisasi produk sesuai keinginan.
- **Pemesanan Langsung** - Memudahkan pelanggan dalam melakukan pemesanan jasa jahit.
- **Manajemen Jasa Jahit** - Kelola berbagai jenis layanan jahit dengan mudah.
- **Toko Online** - Menyediakan katalog produk dan jasa yang dapat dibeli langsung oleh pelanggan.

## Tech Stack
Aplikasi **Selaras** dikembangkan menggunakan teknologi berikut:
- **CodeIgniter 3 (CI3)** - Framework PHP ringan dan cepat untuk pengembangan backend.
- **MySQL** - Basis data untuk menyimpan informasi pelanggan, pesanan, dan produk.
- **Bootstrap** - Untuk desain tampilan yang responsif dan modern.
- **jQuery** - Mempermudah interaksi UI dengan pengguna.

## Instalasi
1. **Clone Repository**
   ```sh
   git clone https://github.com/kiisanz/selaras-update.git
   cd selaras-crm
   ```

2. **Konfigurasi Database**
   - Buat database baru di MySQL.
   - Import file `database.sql` yang tersedia di folder `db`.
   - Edit konfigurasi database di `application/config/database.php`.

3. **Konfigurasi Base URL**
   - Edit `application/config/config.php` dan ubah bagian berikut:
     ```php
     $config['base_url'] = 'http://localhost/selaras-crm';
     ```

4. **Menjalankan Aplikasi**
   - Pastikan server lokal (XAMPP/LAMP) berjalan.
   - Akses aplikasi melalui browser dengan URL yang telah dikonfigurasi.

## Kontribusi
Kami menerima kontribusi untuk pengembangan aplikasi ini lebih lanjut. Silakan fork repository ini dan buat pull request.

## Lisensi
Aplikasi ini dirilis di bawah lisensi MIT. Silakan lihat file `LICENSE` untuk informasi lebih lanjut.
