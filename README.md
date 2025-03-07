# Sistem Kehadiran

Sistem Kehadiran adalah aplikasi berbasis web yang dibangun dengan Laravel untuk mencatat dan mengelola data kehadiran pengguna.

## 🚀 Fitur  
- Login & Register (hanya untuk admin)  
- Role-based access control (Admin, Guru, Siswa)  
- Pencatatan kehadiran harian  
- Export laporan kehadiran  

## 🛠️ Instalasi  
1. Clone repository:  
   ```sh
   git clone https://github.com/gilbert32342/sistem-kehadiran.git
   cd sistem-kehadiran

2. Install dependensi:
sh
Copy
composer install
npm install

3. Copy file environment:
sh
Copy
cp .env.example .env

4. Generate application key:
sh
Copy
php artisan key:generate

5. Buat database dan migrasi:
sh
Copy
php artisan migrate --seed

6. Jalankan server:
sh
Copy
php artisan serve

🔑 Akun Default
Admin: admin@example.com | password123
Guru: guru@example.com | password123
Siswa: siswa@example.com | password123

📝 Lisensi
Proyek ini menggunakan lisensi MIT. Silakan gunakan dan modifikasi sesuai kebutuhan.