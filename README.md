Berikut adalah README yang telah diperbaiki dengan format yang lebih rapi dan konsisten:  

---

# **Sistem Kehadiran**  

Sistem Kehadiran adalah aplikasi berbasis web yang dibangun dengan Laravel untuk mencatat dan mengelola data kehadiran pengguna.  

## 🚀 **Fitur**  
- **Login & Register** (hanya untuk admin)  
- **Role-based access control** (Admin, Guru, Siswa)  
- **Pencatatan kehadiran harian**  
- **Export laporan kehadiran (Excel/PDF)**  

## 🛠️ **Instalasi**  

1. **Clone repository:**  
   ```sh
   git clone https://github.com/gilbert32342/sistem-kehadiran.git
   cd sistem-kehadiran
   ```

2. **Install dependensi:**  
   ```sh
   composer install  
   npm install  
   ```

3. **Copy file environment:**  
   ```sh
   cp .env.example .env  
   ```

4. **Generate application key:**  
   ```sh
   php artisan key:generate  
   ```

5. **Buat database dan jalankan migrasi:**  
   ```sh
   php artisan migrate --seed  
   ```

6. **Jalankan server:**  
   ```sh
   php artisan serve  
   ```

## 🔑 **Akun Default**  
| Role   | Nis/Nip        | Password |  
|--------|----------------|----------|  
| **Admin** | 1234567890  | admin123 |  
| **Guru**  | 9876543210  | guru123  |  
| **Siswa** | 2200112233  | siswa123 |  

## 📝 **Lisensi**  
Proyek ini menggunakan lisensi **MIT**. Silakan gunakan dan modifikasi sesuai kebutuhan.  
