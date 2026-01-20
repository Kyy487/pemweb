# Panduan Sistem Login & Register Berbasis Role

## Fitur Baru yang Ditambahkan

### 1. **Pilihan Role saat Registrasi**
User bisa memilih role mereka saat mendaftar:
- **Admin** - Akses penuh ke sistem
- **Guru (Teacher)** - Akses ke fitur guru
- **Siswa (Student)** - Akses ke fitur siswa

### 2. **Redirect Otomatis Berbasis Role**
Setelah login, user akan diarahkan ke dashboard sesuai role mereka:
- Admin → `/admin/dashboard`
- Guru → `/teacher/dashboard`
- Siswa → `/student/dashboard`

### 3. **Middleware Proteksi Route**
Gunakan middleware `checkRole` untuk melindungi route:

```php
// Di routes/web.php
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    // Route hanya untuk admin
    Route::get('/admin/dashboard', ...);
});

Route::middleware(['auth', 'checkRole:teacher'])->group(function () {
    // Route hanya untuk guru
    Route::get('/teacher/dashboard', ...);
});

Route::middleware(['auth', 'checkRole:student'])->group(function () {
    // Route hanya untuk siswa
    Route::get('/student/dashboard', ...);
});

// Untuk multiple roles
Route::middleware(['auth', 'checkRole:admin,teacher'])->group(function () {
    // Route untuk admin dan guru
    Route::get('/reports', ...);
});
```

## File yang Diubah

### 1. **resources/views/auth/register.blade.php**
- ✅ Tambah input select untuk pilihan role
- ✅ Update styling untuk select element

### 2. **app/Http/Controllers/Auth/RegisteredUserController.php**
- ✅ Tambah validasi field 'role' (required, in:admin,teacher,student)
- ✅ Simpan role yang dipilih user ke database

### 3. **app/Http/Controllers/Auth/AuthenticatedSessionController.php**
- ✅ Tambah logika redirect berbasis role
- ✅ Setiap role diarahkan ke dashboard masing-masing

### 4. **app/Http/Middleware/CheckRole.php** (BARU)
- ✅ Middleware untuk validasi role pada protected routes
- ✅ Redirect otomatis jika user tidak punya akses

### 5. **app/Http/Kernel.php**
- ✅ Daftarkan middleware `checkRole` ke route middleware

## Cara Menggunakan

### Setup Route Berdasarkan Role

Buat route groups untuk setiap role di `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;

// Routes untuk Admin
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('/users', UserController::class);
    // ... routes admin lainnya
});

// Routes untuk Guru
Route::middleware(['auth', 'checkRole:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index']);
    Route::resource('/classes', ClassController::class);
    // ... routes guru lainnya
});

// Routes untuk Siswa
Route::middleware(['auth', 'checkRole:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/grades', [StudentGradeController::class, 'index']);
    // ... routes siswa lainnya
});

// Routes publik (tidak perlu auth)
Route::get('/', function () {
    return view('welcome');
});
```

## Validasi Model User

Pastikan User model memiliki field 'role' di migration:

```php
// Sudah ada di: database/migrations/2014_10_12_000000_create_users_table.php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('role')->default('student'); // PENTING!
    $table->rememberToken();
    $table->timestamps();
});
```

## Testing

### 1. Test Registrasi
```
1. Buka: http://localhost/register
2. Isi formulir dengan:
   - Nama: Admin Test
   - Email: admin@test.com
   - Role: Admin
   - Password: password123
3. Klik DAFTAR
4. Seharusnya redirect ke /admin/dashboard
```

### 2. Test Login
```
1. Login dengan akun admin
2. Seharusnya redirect ke /admin/dashboard

1. Login dengan akun guru
2. Seharusnya redirect ke /teacher/dashboard

1. Login dengan akun siswa
2. Seharusnya redirect ke /student/dashboard
```

### 3. Test Proteksi Route
```
1. Login sebagai admin
2. Coba akses /teacher/dashboard
3. Seharusnya redirect kembali ke /admin/dashboard dengan pesan error
```

## Helper Functions (Opsional)

Tambahkan ke `app/Helpers/AuthHelper.php`:

```php
<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    public static function isTeacher(): bool
    {
        return Auth::check() && Auth::user()->role === 'teacher';
    }

    public static function isStudent(): bool
    {
        return Auth::check() && Auth::user()->role === 'student';
    }

    public static function hasRole($role): bool
    {
        return Auth::check() && Auth::user()->role === $role;
    }

    public static function hasAnyRole(...$roles): bool
    {
        return Auth::check() && in_array(Auth::user()->role, $roles);
    }
}
```

Gunakan di view:
```blade
@if (AuthHelper::isAdmin())
    <!-- Konten untuk admin -->
@endif

@if (AuthHelper::hasAnyRole('admin', 'teacher'))
    <!-- Konten untuk admin dan guru -->
@endif
```

## Troubleshooting

### Issue: Role tidak tersimpan
**Solusi:** Pastikan field 'role' ada di `$fillable` di User model

### Issue: Redirect tidak berfungsi
**Solusi:** Pastikan dashboard route sudah dibuat dan middleware terdaftar dengan benar

### Issue: Middleware tidak berfungsi
**Solusi:** Verify middleware namespace di Kernel.php: `\App\Http\Middleware\CheckRole::class`

## Perubahan Keamanan yang Perlu Ditambahkan

1. **Authorization Policy** - Gunakan Laravel Policies untuk kontrol akses yang lebih granular
2. **Two-Factor Authentication** - Untuk admin
3. **IP Whitelisting** - Untuk admin
4. **Activity Logging** - Log semua action penting

---

**Status:** ✅ Selesai  
**Tanggal:** 31 Desember 2025
