# 🎯 QUICK START - SISTEM LOGIN & REGISTER BERBASIS ROLE

## 🚀 Setup Cepat (5 Menit)

### 1️⃣ Clear Cache (Jika perlu)
```bash
php artisan config:cache
php artisan view:cache
```

### 2️⃣ Jalankan Migration (Jika users table belum ada)
```bash
php artisan migrate
```

### 3️⃣ Seed Test Users (Opsional - untuk testing)
```bash
php artisan db:seed --class=TestUsersSeeder
```

## 🧪 Testing dengan Test Users

### Login Credentials

| Role | Email | Password |
|------|-------|----------|
| 🔐 Admin | `admin@erapor.local` | `password123` |
| 🧑‍🏫 Guru | `guru.matematika@erapor.local` | `password123` |
| 👨‍🎓 Siswa | `siswa1@erapor.local` | `password123` |

### Atau Buat Akun Baru via Web
1. Buka: `http://localhost/register`
2. Isi nama, email, pilih role
3. Buat password
4. Klik DAFTAR

Setelah daftar, Anda akan otomatis di-redirect ke dashboard sesuai role!

## 📋 Fitur yang Sudah Diimplementasikan

✅ **Register dengan Pilihan Role**
- Admin
- Guru (Teacher)
- Siswa (Student)

✅ **Auto-Redirect Setelah Login**
- Admin → `/admin/dashboard`
- Guru → `/teacher/dashboard`
- Siswa → `/student/dashboard`

✅ **Route Protection**
- Route hanya bisa diakses oleh role yang sesuai
- Middleware `checkRole` untuk proteksi

✅ **Error Handling**
- Validasi role yang ketat
- Pesan error yang informatif
- Graceful redirect jika akses ditolak

## 🔒 Cara Melindungi Route

### Contoh 1: Single Role
```php
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});
```

### Contoh 2: Multiple Roles
```php
Route::middleware(['auth', 'checkRole:admin,teacher'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index']);
});
```

### Contoh 3: Semua Route Authenticated
```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

## 📂 File-File yang Diubah

| File | Perubahan |
|------|-----------|
| `resources/views/auth/register.blade.php` | ✅ Tambah role selector |
| `app/Http/Controllers/Auth/RegisteredUserController.php` | ✅ Proses role input |
| `app/Http/Controllers/Auth/AuthenticatedSessionController.php` | ✅ Redirect berbasis role |
| `app/Http/Middleware/CheckRole.php` | ✅ Baru - Validasi role |
| `app/Http/Kernel.php` | ✅ Daftarkan middleware |

## 📚 Dokumentasi Lengkap

Baca file ini untuk dokumentasi detail:
- **ROLE_BASED_AUTH_GUIDE.md** - Panduan komprehensif
- **IMPLEMENTATION_CHECKLIST.md** - Checklist implementasi
- **routes/web-role-based-example.php** - Contoh route

## 🐛 Troubleshooting

### Problem: Role tidak tersimpan
**Solusi:** Check bahwa User model memiliki 'role' di `$fillable`
```php
protected $fillable = ['name', 'email', 'password', 'role'];
```

### Problem: Redirect tidak ke dashboard yang benar
**Solusi:** Verifikasi route dashboard sudah dibuat:
```php
Route::get('/admin/dashboard', ...);
Route::get('/teacher/dashboard', ...);
Route::get('/student/dashboard', ...);
```

### Problem: Middleware error
**Solusi:** Pastikan CheckRole middleware terdaftar di `app/Http/Kernel.php`:
```php
'checkRole' => \App\Http\Middleware\CheckRole::class,
```

## ✨ Tips

1. **Gunakan Helper** - Buat helper function untuk cek role di blade:
```blade
@if(auth()->user()->role === 'admin')
    <!-- Konten admin -->
@endif
```

2. **Contoh Seeder** - Gunakan TestUsersSeeder untuk test:
```bash
php artisan db:seed --class=TestUsersSeeder
```

3. **Policy** - Untuk kontrol akses lebih granular, gunakan Laravel Policies

## 📞 Need Help?

Lihat dokumentasi di:
- `ROLE_BASED_AUTH_GUIDE.md` - Full guide
- `routes/web-role-based-example.php` - Route examples
- `IMPLEMENTATION_CHECKLIST.md` - Complete checklist

---

**🎉 Semua siap digunakan!**

Mulai test dengan daftar akun baru atau login dengan test users yang sudah dibuat.
