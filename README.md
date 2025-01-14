# Goocomerce / Go Komersil Umum Daring
_Ini adalah hasil dari pembelajaran_

## Depensi
Diperlukan:
- Git
- Aplikasi Web Server semial Apache, `lighttpd`, atau Nginx
- PHP versi 8 (8.3 ke atas dapat digunakan)
- Composer
- Laravel
- NodeJS versi LTS (di mulai versi 18)

Opsional:
- MySQL (sering digunakan)

## Untuk menginstall/pemasangan
1. Gunakan Code > Download ZIP unduh unduh atau _clone_ dari URI repo ini<br/>
   Misal: `git clone https://github.com/AbyanMNA/PPL-IF5A-Trunojoyo2024-02/ folder_foo`
3. Ke folder/direktori yang sudah diklon
4. Salin `.env.example` dengan cara `copy .env.example .env` atau `cp .env.example .env`
5. Konfigurasi `vite.config.js` dan `.env` dengan teks editor biasa
6. Pada `.env`, konfigurasi harus hati-hati dalam isian `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai dengan server terpilih yang akan dijalankan.<br/>
   Untuk menggunakan SQLite, isian `DB_DATABASE` adalah alamat berkas lokal server tersebut. Misalkan `E:\\UthabitiKachinaDatabase\\kachina.kachina` atau misal `/home/uthabitikachina/database/kachina.sqlite`. Bisa didapatkan dengan cara komentarkan `DB_DATABASE=` menjadi `#DB_DATABASE=` untuk DBMS dengan SQLite.
8. Jalankan `composer install`
9. Jalankan `npm install`
10. Untuk selain SQLite atau SQL yang berbasis berkas jalankan server SQL terlebih dahulu, lalu jalankan perintah `php artisan migrate` dan `php artisan key:generate`
11. Untuk `storage` bisa dilakukan dengan `php artisan storage:link` untuk mengatasi masalah
12. Jalankan `npm run dev` atau `npm run build`, kemudian jalankan`php artisan serve`
13. Buka peramban, dan ketik alamat pada informasi `php artisan serve` yang telah dijalankan
14. Untuk deploy, tutup semua dengan `Ctrl-C` lalu coba menyesuaikan dengan server. Lihat di [https://laravel.com/docs/11.x/deployment](https://laravel.com/docs/11.x/deployment)

## Permasalahan
- Jika menggunakan branch bawahan bermasalah, langkah pertama ditambahkan dengan `--branch ArieNew`
- Tampilan bermasalah? Apakah NodeJS berjalan? Apakah konfigurasi `vite.config.js` sudah benar? Untuk contoh untuk masalah host pada konfigurasi tersebut:<br/>
  ```js
  export default defineConfig({
  server: {
    host: '0.0.0.0'
    }
  });
  ```
- Admin tidak ada, tidak bisa? Sebenarnya pengguna admin tidak ada. Jadi isi manual, untuk passwd harus telah terenkripsi dengan Bcrypt.
- Masalah `php artisan migrate` pada kasus databse berkaitan SQLite akibat berkas database (`.sqlite`) tidak ditemukan? Dalam berkas `.env` seharusnya
  ```.env
  DB_CONNECTION=sqlite
  # DB_HOST=localhost
  # DB_PORT=3306
  # DB_DATABASE=
  # DB_USERNAME=root
  # DB_PASSWORD=
  ```
