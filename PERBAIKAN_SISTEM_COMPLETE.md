# DAFTAR PERBAIKAN SISTEM E-RAPOR

## 📋 Ringkasan Perbaikan
Semua fitur CRUD telah diperbaiki dan disesuaikan dengan kontrol akses berbasis role. Sistem sekarang memiliki pembatasan akses yang ketat untuk setiap role (Admin, Guru, Siswa).

---

## 🔐 KONTROL AKSES BERDASARKAN ROLE

### **ADMIN**
✅ Dapat mengakses:
- Dashboard Admin (statistik keseluruhan)
- Kelola Kelas (CRUD lengkap)
- Kelola Mata Pelajaran (CRUD lengkap)
- Kelola Pengguna (CRUD lengkap + membuat Siswa baru)
- Manajemen Nilai (lihat semua, edit manual, hapus)

### **GURU (Teacher)**
✅ Dapat mengakses:
- Dashboard Guru
- Input Nilai (formulir khusus untuk kelas mereka)
- Data Nilai (lihat nilai siswa di kelas mereka)
- Edit nilai siswa di kelas mereka
- Cetak rapor siswa

❌ TIDAK dapat mengakses:
- Kelola Kelas, Mata Pelajaran, Pengguna
- Menghapus nilai
- Ubah data siswa

### **SISWA (Student)**
✅ Dapat mengakses:
- Dashboard Siswa (data pribadi & nilai)
- Lihat Nilai Saya (hanya nilai mereka sendiri)
- Cetak rapor pribadi

❌ TIDAK dapat mengakses:
- Menu admin/guru
- Edit/hapus nilai
- Lihat data pengguna lain

---

## 📝 PERUBAHAN FILE YANG DILAKUKAN

### 1. **routes/web.php** ✅
**Perubahan:**
- Tambah middleware `role:admin` untuk routes: classes, subjects, users
- Tambah middleware `role:teacher` untuk: grades.input.form, grades.store-batch
- Grade resources accessible untuk semua (dengan filter di controller)

**Sebelum:**
```php
Route::resource('classes', ClassController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('users', UserController::class);
Route::resource('grades', GradeController::class);
```

**Sesudah:**
```php
Route::middleware('role:admin')->group(function () {
    Route::resource('classes', ClassController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('users', UserController::class);
});

Route::middleware('role:teacher')->group(function () {
    Route::get('/grades/input', [GradeController::class, 'showInputForm'])->name('grades.input.form');
    Route::post('/grades/store-batch', [GradeController::class, 'storeGrades'])->name('grades.store.batch');
});
```

---

### 2. **app/Http/Controllers/UserController.php** ✅
**Perubahan Utama:**
- ✅ Tambah constructor untuk validasi role admin
- ✅ Saat membuat User dengan role 'student', otomatis membuat Student record
- ✅ Saat edit User jadi 'student', Student record dibuat/diupdate
- ✅ Saat menghapus User, Student record juga dihapus
- ✅ Tambah validasi: NISN (unik) dan study_class_id (required untuk student)

**Fitur Baru:**
```php
// Otomatis membuat Student record
if ($request->role === 'student') {
    Student::create([
        'name' => $request->name,
        'nisn' => $request->nisn,
        'user_id' => $user->id,
        'study_class_id' => $request->study_class_id,
    ]);
}
```

---

### 3. **app/Http/Controllers/GradeController.php** ✅
**Perubahan Utama:**
- ✅ Method `index()` sekarang filter berdasarkan role:
  - Admin → lihat semua nilai
  - Teacher → lihat nilai dari siswa di kelas mereka saja
  - Student → lihat nilai mereka sendiri
- ✅ Method `create()` hanya untuk admin
- ✅ Method `edit()` → Admin OR Guru dari kelas tersebut
- ✅ Method `destroy()` hanya untuk admin

**Filter untuk Teacher:**
```php
if ($user->role === 'teacher') {
    $grades = Grade::with(['student', 'subject'])
        ->whereHas('student', function ($query) {
            $query->whereIn('study_class_id', 
                StudyClass::where('homeroom_teacher_id', Auth::id())->pluck('id')
            );
        })->paginate(15);
}
```

---

### 4. **app/Http/Controllers/ClassController.php** ✅
**Perubahan:**
- ✅ Tambah constructor untuk validasi role admin
- ✅ Validasi bahwa homeroom_teacher harus user dengan role 'teacher'
- ✅ Pass `$teachers` list ke view create/edit

**Validasi:**
```php
$teacher = User::find($request->homeroom_teacher_id);
if (!$teacher || $teacher->role !== 'teacher') {
    return back()->withErrors(['homeroom_teacher_id' => 'Wali kelas harus role Guru']);
}
```

---

### 5. **app/Http/Controllers/SubjectController.php** ✅
**Perubahan:**
- ✅ Tambah constructor untuk validasi role admin only

---

### 6. **resources/views/users/create.blade.php** ✅
**Perubahan:**
- ✅ Tambah fields: NISN dan Kelas untuk role 'student'
- ✅ Tambah JavaScript untuk toggle fields berdasarkan role
- ✅ Pass `$classes` dari controller

**Form dinamis:**
```blade
<div id="student-fields" style="display: none;">
    <div class="form-group">
        <label for="nisn">NISN *</label>
        <input type="text" id="nisn" name="nisn" ...>
    </div>
    <div class="form-group">
        <label for="study_class_id">Kelas *</label>
        <select id="study_class_id" name="study_class_id">
            @foreach($classes as $class)...
        </select>
    </div>
</div>

<script>
function toggleStudentFields() {
    const roleSelect = document.getElementById('role');
    const studentFields = document.getElementById('student-fields');
    if (roleSelect.value === 'student') {
        studentFields.style.display = 'block';
    } else {
        studentFields.style.display = 'none';
    }
}
</script>
```

---

### 7. **resources/views/users/edit.blade.php** ✅
**Perubahan:** Sama seperti create.blade.php + pre-fill data Student

---

### 8. **resources/views/classes/create.blade.php** ✅
**Perubahan:**
- ✅ Gunakan `$teachers` dari controller (bukan query di view)
- ✅ Hapus logika blade yang mequery database

---

### 9. **resources/views/classes/edit.blade.php** ✅
**Perubahan:** Sama seperti create.blade.php

---

### 10. **resources/views/grades/index.blade.php** ✅
**Perubahan:**
- ✅ Sidebar menu dinamis berdasarkan role:
  - Admin: lihat semua menu
  - Teacher: Input Nilai + Data Nilai
  - Student: Nilai Saya
- ✅ Button "Tambah Nilai" hanya untuk admin
- ✅ Button "Cetak Semua" hanya untuk admin
- ✅ Edit/Hapus berdasarkan akses

**Sidebar dinamis:**
```blade
@if(Auth::user()->role === 'admin')
    <li><a href="{{ route('classes.index') }}">Kelas</a></li>
    <li><a href="{{ route('subjects.index') }}">Mata Pelajaran</a></li>
    <li><a href="{{ route('users.index') }}">Pengguna</a></li>
@elseif(Auth::user()->role === 'teacher')
    <li><a href="{{ route('grades.input.form') }}">Input Nilai</a></li>
@else
    <li><a href="{{ route('grades.index') }}">Nilai Saya</a></li>
@endif
```

---

### 11. **resources/views/users/index.blade.php** ✅
**Perubahan:** Sidebar dinamis (admin only dapat akses halaman ini)

---

### 12. **resources/views/classes/index.blade.php** ✅
**Perubahan:** Sidebar dinamis (admin only)

---

### 13. **resources/views/subjects/index.blade.php** ✅
**Perubahan:** Sidebar dinamis (admin only)

---

### 14. **resources/views/components/sidebar.blade.php** ✅ (BARU)
**Dibuat:** Component reusable untuk sidebar (optional, untuk refactor di masa depan)

---

## 🎯 FITUR-FITUR YANG DIPERBAIKI

### ✅ 1. Penambahan Siswa
**Masalah sebelumnya:** Tidak ada mekanisme untuk membuat siswa baru
**Solusi:**
- Saat user dibuat dengan role 'student', otomatis membuat record di tabel Students
- Admin harus memilih NISN dan Kelas untuk setiap siswa baru
- Student record secara otomatis dikaitkan ke User

### ✅ 2. Pemilihan Guru untuk Kelas
**Masalah sebelumnya:** Dropdown guru menampilkan semua user
**Solusi:**
- Filter hanya menampilkan user dengan role 'teacher'
- Validasi di backend: homeroom_teacher harus role 'teacher'

### ✅ 3. Akses Nilai Guru
**Masalah sebelumnya:** Guru bisa lihat semua nilai
**Solusi:**
- Guru hanya lihat nilai siswa dari kelas mereka
- Guru hanya bisa edit nilai di kelas mereka
- Guru tidak bisa hapus nilai (hanya admin)

### ✅ 4. Akses Nilai Siswa
**Masalah sebelumnya:** Siswa tidak bisa filter nilai mereka
**Solusi:**
- Siswa hanya lihat nilai mereka sendiri
- Student record di-filter berdasarkan user_id yang login

### ✅ 5. Menu Navigasi
**Masalah sebelumnya:** Semua menu ditampilkan ke semua role
**Solusi:**
- Sidebar dinamis berdasarkan role
- Admin: akses semua fitur
- Teacher: akses input nilai dan data nilai
- Student: akses nilai mereka saja

### ✅ 6. Proteksi Route
**Masalah sebelumnya:** Siapa saja bisa akses route admin
**Solusi:**
- Tambah middleware `role:admin` untuk admin routes
- Tambah middleware `role:teacher` untuk teacher routes
- HTTP 403 error jika akses tidak diizinkan

---

## 🧪 TESTING CHECKLIST

Silakan test fitur-fitur berikut:

### Admin
- [ ] Login sebagai admin
- [ ] Dashboard menampilkan statistik
- [ ] Buat user baru dengan role student
  - [ ] Isi NISN dan pilih kelas
  - [ ] Cek Student record terbuat
- [ ] Edit user dari student ke teacher
  - [ ] Cek Student record dihapus
- [ ] Tambah kelas
  - [ ] Pastikan hanya guru yang bisa dipilih
- [ ] Lihat semua nilai
- [ ] Edit nilai siswa
- [ ] Hapus nilai
- [ ] Cetak semua nilai

### Teacher
- [ ] Login sebagai teacher
- [ ] Dashboard guru muncul
- [ ] Sidebar hanya tampil "Input Nilai" dan "Data Nilai"
- [ ] Input Nilai
  - [ ] Filter kelas dan mata pelajaran mereka
  - [ ] Input nilai untuk siswa
- [ ] Data Nilai
  - [ ] Hanya tampil nilai siswa dari kelas mereka
  - [ ] Bisa edit nilai mereka
  - [ ] Tidak bisa hapus nilai
  - [ ] Tidak bisa tambah nilai manual
- [ ] Akses /users/create → Error 403

### Student
- [ ] Login sebagai student
- [ ] Dashboard menampilkan data pribadi & nilai
- [ ] Sidebar hanya tampil "Nilai Saya"
- [ ] Lihat nilai pribadi
- [ ] Tidak bisa edit/hapus nilai
- [ ] Akses /users/create → Error 403
- [ ] Akses /grades/create → Error 403

---

## 📊 STRUKTUR DATABASE

Pastikan table students sudah ada dengan kolom:
```sql
CREATE TABLE students (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    nisn VARCHAR(20) UNIQUE,
    user_id BIGINT UNSIGNED,
    study_class_id BIGINT UNSIGNED,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (study_class_id) REFERENCES study_classes(id)
);
```

---

## 📌 CATATAN PENTING

1. **Unique NISN**: Setiap siswa harus punya NISN unik
2. **Student Record**: Otomatis dibuat saat user dibuat/diubah ke role student
3. **Cascading Delete**: Saat user dihapus, Student record juga dihapus
4. **Role Filtering**: Semua controller sudah menggunakan Auth::user()->role untuk filter akses
5. **Sidebar Menu**: Setiap view punya sidebar yang berbeda per role

---

## 🔍 NEXT STEPS (Opsional Improvement)

1. Tambah Blade Component untuk sidebar yang reusable
2. Tambah permission middleware untuk kontrol akses lebih granular
3. Tambah audit log untuk melacak perubahan nilai
4. Tambah validasi: siswa hanya bisa lihat nilai yang aktif
5. Tambah fitur: export data ke Excel

---

**Status:** ✅ SELESAI - Siap untuk testing
**Last Updated:** {{ now() }}
