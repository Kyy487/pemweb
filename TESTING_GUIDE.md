# PANDUAN TESTING E-RAPOR - Kontrol Akses Berbasis Role

## 🎯 TUJUAN TESTING

Memastikan bahwa semua fitur CRUD hanya dapat diakses oleh role yang sesuai, dan data yang ditampilkan sudah di-filter dengan benar.

---

## 👤 SETUP TEST ACCOUNTS

Sebelum testing, pastikan sudah ada 3 user untuk test:

### 1. Admin Account
- Email: `admin@test.com`
- Password: `password`
- Role: `admin`

### 2. Teacher Account  
- Email: `guru@test.com`
- Password: `password`
- Role: `teacher`

### 3. Student Account
- Email: `siswa@test.com`
- Password: `password`
- Role: `student`

### Cara membuat test accounts:

**Via Laravel Tinker:**
```bash
cd "d:\laragon\www\e-rapor-Copy"
php artisan tinker
```

```php
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

// Admin
User::create([
    'name' => 'Admin Test',
    'email' => 'admin@test.com',
    'password' => Hash::make('password'),
    'role' => 'admin'
]);

// Teacher
User::create([
    'name' => 'Guru Test',
    'email' => 'guru@test.com',
    'password' => Hash::make('password'),
    'role' => 'teacher'
]);

// Student
$user = User::create([
    'name' => 'Siswa Test',
    'email' => 'siswa@test.com',
    'password' => Hash::make('password'),
    'role' => 'student'
]);

Student::create([
    'name' => 'Siswa Test',
    'nisn' => '12345678901',
    'user_id' => $user->id,
    'study_class_id' => 1 // Sesuaikan dengan ID kelas yang ada
]);

exit
```

---

## 📋 TEST CASES

### ✅ TEST 1: Login & Dashboard

#### Login sebagai Admin
- [ ] Buka halaman login
- [ ] Masukkan email: `admin@test.com`
- [ ] Masukkan password: `password`
- [ ] Click tombol Login
- **Expected:** Masuk ke dashboard admin dengan statistik (Total Kelas, Guru, Siswa, Mapel)

#### Login sebagai Teacher
- [ ] Logout dulu
- [ ] Masukkan email: `guru@test.com`, password: `password`
- **Expected:** Masuk ke dashboard guru

#### Login sebagai Student
- [ ] Logout dulu
- [ ] Masukkan email: `siswa@test.com`, password: `password`
- **Expected:** Masuk ke dashboard siswa dengan data pribadi & nilai mereka

---

### ✅ TEST 2: Navigation Menu (Sidebar)

#### Admin Navigation
- [ ] Login sebagai admin
- [ ] Sidebar harus menampilkan:
  - [ ] Dashboard
  - [ ] Kelas
  - [ ] Mata Pelajaran
  - [ ] Pengguna
  - [ ] Nilai
  - [ ] Logout button
- [ ] Semua link harus berfungsi
- **Expected:** Admin bisa akses semua menu

#### Teacher Navigation
- [ ] Login sebagai teacher
- [ ] Sidebar harus HANYA menampilkan:
  - [ ] Dashboard
  - [ ] Input Nilai
  - [ ] Data Nilai
  - [ ] Logout button
- [ ] Menu Kelas, Mata Pelajaran, Pengguna TIDAK boleh ada
- **Expected:** Teacher tidak melihat admin menu

#### Student Navigation
- [ ] Login sebagai student
- [ ] Sidebar harus HANYA menampilkan:
  - [ ] Dashboard
  - [ ] Nilai Saya
  - [ ] Logout button
- **Expected:** Student hanya akses menu terbatas

---

### ✅ TEST 3: Kelola Pengguna (Users Management)

#### Access Control
- [ ] Login sebagai Admin → buka `/users` → ✅ Harus bisa
- [ ] Login sebagai Teacher → buka `/users` → ❌ Harus dapat error 403
- [ ] Login sebagai Student → buka `/users` → ❌ Harus dapat error 403

#### Buat User Baru (Admin hanya)

**Test: Create Admin User**
- [ ] Login sebagai admin
- [ ] Klik "Tambah Pengguna"
- [ ] Isi form:
  - Nama: "Admin Baru"
  - Email: "admin2@test.com"
  - Password: "password123"
  - Konfirmasi Password: "password123"
  - Role: Admin
- [ ] Click "Simpan Pengguna"
- **Expected:** User berhasil dibuat, redirect ke halaman users, muncul pesan sukses

**Test: Create Teacher User**
- [ ] Klik "Tambah Pengguna"
- [ ] Isi form:
  - Nama: "Guru Baru"
  - Email: "guru2@test.com"
  - Password: "password123"
  - Konfirmasi Password: "password123"
  - Role: Guru
- [ ] Click "Simpan Pengguna"
- **Expected:** User berhasil dibuat (tidak ada fields NISN & Kelas)

**Test: Create Student User** ⭐ IMPORTANT
- [ ] Klik "Tambah Pengguna"
- [ ] Isi form:
  - Nama: "Siswa Baru"
  - Email: "siswa2@test.com"
  - Password: "password123"
  - Konfirmasi Password: "password123"
  - Role: Siswa
- [ ] **PERHATIAN:** Saat pilih Role "Siswa", harus muncul 2 fields baru:
  - [ ] NISN field (text input)
  - [ ] Kelas dropdown
- [ ] Isi NISN: "98765432101"
- [ ] Pilih Kelas dari dropdown
- [ ] Click "Simpan Pengguna"
- **Expected:** 
  - User berhasil dibuat
  - Student record otomatis dibuat dengan nisn & kelas
  - Verifikasi dengan query di tinker:
    ```php
    $user = User::where('email', 'siswa2@test.com')->first();
    $user->id; // cari student dengan user_id ini
    Student::where('user_id', $user->id)->first(); // harus ada
    ```

#### Edit User

**Test: Change Student to Teacher**
- [ ] Buka halaman Users
- [ ] Klik edit untuk user "Siswa Baru"
- [ ] Ubah Role dari "Siswa" ke "Guru"
- [ ] **PERHATIAN:** NISN & Kelas fields harus hilang
- [ ] Click "Simpan Perubahan"
- **Expected:**
  - User role berubah jadi teacher
  - Student record dihapus dari database
  - Verifikasi:
    ```php
    Student::where('user_id', $user->id)->first(); // harus null
    ```

**Test: Change Teacher to Student**
- [ ] Edit user dengan role Teacher
- [ ] Ubah Role ke "Siswa"
- [ ] **PERHATIAN:** NISN & Kelas fields harus muncul
- [ ] Isi NISN & pilih Kelas
- [ ] Click "Simpan Perubahan"
- **Expected:**
  - User role berubah jadi student
  - Student record otomatis dibuat

#### Delete User

**Test: Delete Student User**
- [ ] Buka halaman Users
- [ ] Cari user dengan role "Siswa"
- [ ] Klik tombol "Hapus"
- [ ] Confirm di dialog
- **Expected:**
  - User dihapus
  - Student record juga dihapus
  - Verifikasi di tinker:
    ```php
    Student::where('user_id', $deletedUserId)->first(); // harus null
    ```

---

### ✅ TEST 4: Kelola Kelas (Admin Only)

#### Access Control
- [ ] Admin → `/classes` → ✅ Harus bisa
- [ ] Teacher → `/classes` → ❌ Error 403
- [ ] Student → `/classes` → ❌ Error 403

#### Buat Kelas Baru
- [ ] Login sebagai admin
- [ ] Buka halaman Kelas
- [ ] Klik "Tambah Kelas"
- [ ] Isi form:
  - Nama Kelas: "X-A"
  - Guru Wali Kelas: (dropdown harus HANYA menampilkan guru)
- **IMPORTANT:** Dropdown guru harus filter hanya user dengan role 'teacher'
- [ ] Pilih guru dari dropdown
- [ ] Click "Simpan Kelas"
- **Expected:**
  - Kelas berhasil dibuat
  - Guru yang dipilih sudah jadi wali kelas

#### Edit Kelas
- [ ] Klik edit pada kelas
- [ ] Ubah guru wali kelas
- [ ] **IMPORTANT:** Dropdown harus HANYA guru
- [ ] Click "Simpan Perubahan"
- **Expected:** Kelas berhasil diupdate

---

### ✅ TEST 5: Kelola Mata Pelajaran (Admin Only)

#### Access Control
- [ ] Admin → `/subjects` → ✅ Harus bisa
- [ ] Teacher → `/subjects` → ❌ Error 403
- [ ] Student → `/subjects` → ❌ Error 403

#### Buat Mata Pelajaran
- [ ] Login sebagai admin
- [ ] Klik "Tambah Mata Pelajaran"
- [ ] Isi:
  - Nama: "Matematika"
  - Code: "MTH"
- [ ] Click "Simpan"
- **Expected:** Mata pelajaran berhasil dibuat

---

### ✅ TEST 6: Manajemen Nilai (Berbeda per Role)

#### Admin - Lihat Semua Nilai
- [ ] Login sebagai admin
- [ ] Buka halaman Nilai (`/grades`)
- [ ] **HARUS MELIHAT:**
  - [ ] Tabel dengan SEMUA nilai dari semua siswa
  - [ ] Button "Tambah Nilai"
  - [ ] Button "Cetak Semua"
  - [ ] Button "Edit" di setiap row
  - [ ] Button "Hapus" di setiap row

#### Admin - Tambah Nilai Manual
- [ ] Klik "Tambah Nilai"
- [ ] Isi form:
  - Siswa: (dropdown semua siswa)
  - Mata Pelajaran: (dropdown semua mapel)
  - Nilai: 85
- [ ] Click "Simpan"
- **Expected:** Nilai berhasil ditambahkan

#### Admin - Edit Nilai
- [ ] Klik "Edit" pada sebuah nilai
- [ ] Ubah nilai (contoh: 85 → 90)
- [ ] Click "Simpan Perubahan"
- **Expected:** Nilai berhasil diupdate

#### Admin - Hapus Nilai
- [ ] Klik "Hapus" pada sebuah nilai
- [ ] Confirm dialog
- **Expected:** Nilai berhasil dihapus

#### Teacher - Lihat Nilai Siswa Kelas Mereka
- [ ] Login sebagai guru
- [ ] Buka `/grades`
- [ ] **HARUS MELIHAT:**
  - [ ] HANYA nilai siswa dari kelas yang mereka teach
  - [ ] TIDAK ada button "Tambah Nilai"
  - [ ] TIDAK ada button "Cetak Semua"
  - [ ] Button "Edit" hanya untuk siswa kelas mereka
  - [ ] TIDAK ada button "Hapus"
- **Expected:** Guru hanya lihat data yang relevan

#### Teacher - Input Nilai via Form
- [ ] Login sebagai guru
- [ ] Klik "Input Nilai" di sidebar
- [ ] Pilih Kelas dari dropdown
- [ ] Pilih Mata Pelajaran dari dropdown
- [ ] **HARUS MELIHAT:** Daftar siswa dari kelas yang dipilih
- [ ] Input nilai untuk setiap siswa
- [ ] Click "Simpan"
- **Expected:** Nilai berhasil disimpan untuk siswa di kelas tersebut

#### Teacher - Edit Nilai
- [ ] Di halaman Data Nilai, klik "Edit"
- [ ] Ubah nilai
- [ ] Click "Simpan Perubahan"
- **Expected:** Nilai berhasil diupdate
- **❌ NEGATIVE TEST:** 
  - [ ] Guru tidak boleh bisa edit nilai siswa dari kelas lain
  - [ ] Buka URL manual: `/grades/{id}/edit` dengan id siswa dari kelas lain
  - [ ] **Expected:** Error 403 atau redirect

#### Student - Lihat Nilai Sendiri
- [ ] Login sebagai siswa
- [ ] Buka `/grades`
- [ ] **HARUS MELIHAT:**
  - [ ] HANYA nilai pribadi
  - [ ] TIDAK ada button "Tambah Nilai", "Edit", "Hapus"
  - [ ] Hanya button "Cetak" untuk rapor pribadi
- **Expected:** Siswa hanya lihat nilai mereka

#### Student - TIDAK boleh akses create/edit
- [ ] Login sebagai siswa
- [ ] Buka URL: `/grades/create`
- [ ] **Expected:** Error 403 atau redirect
- [ ] Buka URL: `/grades/{id}/edit` (any grade)
- [ ] **Expected:** Error 403

---

### ✅ TEST 7: Button & UI Rendering

#### Admin View
- [ ] Klik "Cetak Semua" → harus bisa cetak semua nilai
- [ ] Klik "Tambah Nilai" → form untuk input nilai manual
- [ ] Edit/Delete buttons visible untuk semua nilai

#### Teacher View
- [ ] Button "Tambah Nilai" TIDAK ada
- [ ] Button "Cetak Semua" TIDAK ada
- [ ] Edit button hanya untuk siswa kelas mereka
- [ ] Delete button TIDAK ada

#### Student View
- [ ] TIDAK ada button edit
- [ ] TIDAK ada button delete
- [ ] TIDAK ada button tambah
- [ ] Hanya button cetak rapor pribadi

---

### ✅ TEST 8: Data Filtering

#### Guru Input Nilai - Filter Siswa
- [ ] Login sebagai guru
- [ ] Buka "Input Nilai"
- [ ] Pilih Kelas X-A
- [ ] **Expected:** Dropdown siswa hanya tampil siswa dari Kelas X-A
- [ ] Pilih Kelas X-B
- [ ] **Expected:** Dropdown siswa update dan hanya tampil siswa X-B

#### Guru Lihat Nilai - Filter
- [ ] Login sebagai guru
- [ ] Di halaman Data Nilai, lihat tabel
- [ ] **Expected:** Hanya nilai siswa dari kelas guru tersebut
- [ ] Guru tidak boleh lihat nilai siswa dari kelas lain

#### Siswa Lihat Nilai - Filter
- [ ] Login sebagai siswa
- [ ] Di halaman Nilai Saya
- [ ] **Expected:** Hanya nilai pribadi siswa tersebut
- [ ] Siswa tidak boleh lihat nilai siswa lain

---

### ✅ TEST 9: Error & Security

#### Unauthorized Access
- [ ] Login sebagai teacher
- [ ] Buka URL: `/users` → ❌ Error 403
- [ ] Buka URL: `/classes` → ❌ Error 403
- [ ] Buka URL: `/subjects` → ❌ Error 403
- [ ] Buka URL: `/grades/create` (guru bisa create tidak?) → Check logs
- **Expected:** 403 Forbidden error

#### Invalid Data
- [ ] Login sebagai admin
- [ ] Buka "Tambah User"
- [ ] Isi Role: Student
- [ ] **JANGAN isi** NISN dan Kelas
- [ ] Click "Simpan"
- [ ] **Expected:** Error validation: "NISN wajib diisi untuk siswa", "Kelas wajib dipilih"

#### Duplicate NISN
- [ ] Buat siswa dengan NISN: "12345"
- [ ] Buat siswa baru dengan NISN sama: "12345"
- [ ] Click "Simpan"
- [ ] **Expected:** Error: "NISN sudah digunakan"

---

## 📊 TEST RESULT TRACKING

Buat tabel untuk track hasil testing:

```
| Test Case | Admin | Teacher | Student | Status |
|-----------|-------|---------|---------|--------|
| Login Dashboard | ✅ | ✅ | ✅ | PASS |
| Navigation Menu | ✅ | ✅ | ✅ | PASS |
| Access /users | ✅ | ❌ | ❌ | PASS |
| Create User | ✅ | ❌ | ❌ | PASS |
| View Grades | ✅ (all) | ✅ (own class) | ✅ (own) | PASS |
| Edit Grade | Admin, Teacher | Teacher (own class) | ❌ | PASS |
| Delete Grade | ✅ | ❌ | ❌ | PASS |
```

---

## 🐛 JIKA ADA MASALAH

1. **Sidebar tidak muncul menu yang benar**
   - Check: `@if(Auth::user()->role === 'admin')`
   - Pastikan user sudah login dengan role yang benar

2. **Fields NISN & Kelas tidak muncul saat create student**
   - Check: JavaScript function `toggleStudentFields()`
   - Buka console browser (F12) dan lihat error

3. **Guru bisa lihat nilai siswa kelas lain**
   - Check: `GradeController.php` filter logic
   - Pastikan relationship student → studyClass benar

4. **Button edit/delete muncul tapi error saat diklik**
   - Check: authorization logic di controller
   - Harus ada validasi: `if ($user->role !== 'teacher') abort(403)`

5. **Cascading delete tidak bekerja**
   - Check: `UserController.destroy()` harus delete Student record
   - Verifikasi di database bahwa Student record sudah dihapus

---

## ✅ CHECKLIST LENGKAP SEBELUM PRODUCTION

- [ ] Semua test cases sudah dijalankan
- [ ] Tidak ada error 500 (server error)
- [ ] Semua akses control bekerja (403 untuk unauthorized)
- [ ] Data filtering bekerja (guru hanya lihat kelas mereka, dll)
- [ ] UI buttons sesuai dengan permission
- [ ] Cascading delete bekerja
- [ ] Validasi form bekerja (NISN unique, kelas required, dll)
- [ ] Sidebar menu dinamis per role
- [ ] Tidak ada data leak (siswa bisa lihat nilai siswa lain, dll)

---

**Selamat Testing! 🚀**
