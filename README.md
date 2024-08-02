# Deskripsi Aplikasi

- Laravel 11
- PHP (8.3.6)
- Composer version 2.5.8 
- NPM version 8.19.4
- Laragon/Xampp

# Instalasi

1. Unzip folder yang sudah didownload 
2. Jalankan `npm install` atau menggunakan `yarn`
3. Jalankan `composer install`
4. Buat database baru (Contoh : db_rental, dengan db_connection MySQL)
5. di file .env (Jika belum ada copy .env.example rename menjadi .env) ubah sesuai database configuration yang sudah dibuat
6. Jalankan `php artisan key:generate`
7. Jalankan `npm run build` untuk mengkompilasi semua file aset seperti SCSS, JS dan menyalin semua gambar ke direktori public
8. Jalankan `php artisan migrate --seed` untuk migrasi database
9. Jalankan `php artisan serve`

# Admin Akses 

Email : admin@mail.com
Password : 12345678

untuk registrasi Pengguna : http://127.0.0.1:8000/register

