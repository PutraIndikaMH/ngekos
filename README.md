# 🏠 NgeKos - Platform Booking Kos Modern

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.3-FF7C02?style=for-the-badge)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Sistem Booking Kos-kosan Modern dengan Integrasi Payment Gateway & Notifikasi WhatsApp**

</div>

---

## 📋 Daftar Isi

-   [Tentang Proyek](#-tentang-proyek)
-   [Fitur Utama](#-fitur-utama)
-   [Tech Stack](#️-tech-stack)
-   [Screenshots](#-screenshots)
-   [Developer](#-developer)

---

## 🎯 Tentang Proyek

**NgeKos** adalah aplikasi web full-stack yang komprehensif untuk mempermudah proses booking kos-kosan di Indonesia. Dibangun dengan teknologi modern dan best practices, platform ini memberikan pengalaman yang seamless untuk pemilik kos maupun pencari kos.

### 💡 Permasalahan yang Diselesaikan

Mencari dan booking kos-kosan di Indonesia seringkali merepotkan dengan banyak percakapan WhatsApp, harga yang tidak jelas, dan konfirmasi pembayaran manual. NgeKos menyelesaikan masalah ini dengan menyediakan:

-   ✅ Daftar kos terpusat dengan informasi lengkap
-   ✅ Sistem booking otomatis dengan ketersediaan real-time
-   ✅ Proses pembayaran online yang aman via Midtrans
-   ✅ Notifikasi WhatsApp instan via Twilio
-   ✅ Panel admin untuk manajemen properti yang efisien

---

## ✨ Fitur Utama

### 🔐 Fitur User

-   **Pencarian & Filter Cerdas**: Telusuri kos berdasarkan kota, kategori, dan rentang harga
-   **Detail Properti Lengkap**: Gambar berkualitas tinggi, fasilitas, lokasi, dan testimoni asli
-   **Ketersediaan Real-time**: Cek ketersediaan kamar secara instan
-   **Proses Booking Aman**: Booking bertahap dengan validasi informasi pelanggan
-   **Metode Pembayaran Lengkap**: Kartu kredit, transfer bank, e-wallet via integrasi Midtrans
-   **Tracking Booking**: Lacak status booking dengan kode booking unik
-   **Notifikasi WhatsApp**: Terima konfirmasi pembayaran instan via WhatsApp

### 🛠️ Fitur Admin (Filament)

-   **Dashboard Analytics**: Overview menyeluruh dari booking, revenue, dan tingkat okupansi
-   **Manajemen Properti**: Operasi CRUD untuk kos, kamar, dan fasilitas
-   **Manajemen Transaksi**: Monitor dan kelola semua transaksi
-   **Manajemen Konten**: Kelola kategori, kota, testimoni, dan bonus
-   **Manajemen User**: Kontrol akses admin user

### 💳 Payment & Notifikasi

-   **Integrasi Midtrans**: Payment gateway aman dengan berbagai channel pembayaran
-   **Automated Payment Callbacks**: Update status pembayaran real-time
-   **Twilio WhatsApp API**: Konfirmasi booking otomatis dikirim via WhatsApp
-   **Transaction Logging**: Audit trail lengkap untuk semua transaksi

---

## 🛠️ Tech Stack

### Backend

-   **Framework**: Laravel 11.x
-   **PHP**: 8.2+
-   **Database**: MySQL
-   **Admin Panel**: Filament 3.3
-   **Payment Gateway**: Midtrans PHP SDK
-   **Messaging**: Twilio SDK (WhatsApp)

### Frontend

-   **CSS Framework**: TailwindCSS 3.x
-   **Build Tool**: Vite
-   **Templating**: Blade (Laravel)

### Arsitektur Pattern

-   **Repository Pattern**: Pemisahan logic akses data yang clean
-   **Service Layer**: Abstraksi business logic
-   **Interface-Driven Design**: Untuk dependency injection dan testability
-   **Soft Deletes**: Integritas dan recovery data

### Development Tools

-   **Composer**: Manajemen dependensi PHP
-   **NPM**: Manajemen package frontend
-   **Laravel Pint**: Code style fixer
-   **PHPUnit**: Testing framework

---

## 📸 Screenshots

### Sistem Notifikasi WhatsApp

![WhatsApp Notification](docs/images/whatsapp-notification.png)
_Konfirmasi booking otomatis dikirim via WhatsApp setelah pembayaran berhasil_

> Screenshot menunjukkan sistem notifikasi WhatsApp terintegrasi dengan Twilio yang mengirimkan konfirmasi booking instan dengan:
>
> -   Kode booking untuk referensi
> -   Total jumlah pembayaran
> -   Detail properti dan alamat
> -   Tanggal check-in
> -   Sapaan personal

---

## 📜 License

Proyek ini dilisensikan di bawah MIT License - lihat file [LICENSE](LICENSE) untuk detail.

---

## 👨‍💻 Developer

**Nama Anda**

-   LinkedIn: [Your LinkedIn](#)
-   GitHub: [@yourusername](#)
-   Email: your.email@example.com
-   Portfolio: [yourportfolio.com](#)

---

## 🙏 Teknologi yang Digunakan

-   [Laravel](https://laravel.com/) - The PHP Framework
-   [Filament](https://filamentphp.com/) - Admin Panel Framework
-   [Midtrans](https://midtrans.com/) - Payment Gateway
-   [Twilio](https://www.twilio.com/) - WhatsApp API
-   [TailwindCSS](https://tailwindcss.com/) - CSS Framework

---

## 📞 Kontak

Jika ada pertanyaan atau butuh bantuan, silakan hubungi:

-   📧 Email: your.email@example.com
-   💬 Buka issue di GitHub
-   📱 Connect di LinkedIn

---

<div align="center">

### ⭐ Jika proyek ini bermanfaat, berikan star!

**Dibuat dengan ❤️ menggunakan Laravel & Modern Web Technologies**

</div>
