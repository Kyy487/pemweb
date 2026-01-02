# Fitur Kelola Siswa (Student Management)

## Deskripsi Fitur
Fitur "Kelola Siswa" memungkinkan admin untuk mengassign siswa yang sudah terdaftar di sistem ke kelas-kelas yang telah disiapkan, beserta wali kelasnya (homeroom teacher).

## Alur Penggunaan

### 1. Membuat Siswa (Pre-requisite)
Sebelum dapat diassign ke kelas, siswa harus dibuat terlebih dahulu melalui menu "Pengguna":
- Admin pergi ke **Pengguna** > **Tambah Pengguna**
- Pilih role **Siswa**
- Isi nama, email, password
- Tentukan kelas awal dan NISN
- User siswa akan secara otomatis mendapat Student record

### 2. Assign Siswa ke Kelas (Kelola Siswa)
Setelah siswa terbuat atau untuk mengubah penempatan:
- Admin pergi ke **Kelola Siswa** > **Tambah Siswa ke Kelas**
- Pilih siswa dari dropdown (hanya menampilkan siswa yang belum diassign)
- Pilih kelas yang tersedia dengan wali kelasnya
- Klik **Simpan**

### 3. Edit Penempatan Siswa
Untuk mengubah kelas siswa:
- Admin pergi ke **Kelola Siswa**
- Cari siswa di tabel dan klik **Edit**
- Ubah kelas yang diinginkan
- Klik **Simpan Perubahan**

### 4. Hapus Siswa dari Kelas
Untuk menghapus siswa dari kelas (siswa tetap ada di sistem):
- Admin pergi ke **Kelola Siswa**
- Cari siswa di tabel dan klik **Hapus**
- Konfirmasi penghapusan
- Siswa akan dihapus dari kelas

## Struktur Database

### Tabel: students
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | INT | Primary Key |
| name | VARCHAR | Nama siswa |
| nisn | VARCHAR(20) UNIQUE | Nomor Induk Siswa Nasional |
| user_id | INT FK | Foreign key ke users table |
| study_class_id | INT FK | Foreign key ke study_classes table |
| created_at | TIMESTAMP | Waktu pembuatan |
| updated_at | TIMESTAMP | Waktu update |

## Model & Controller

### Model: Student
- **File**: `app/Models/Student.php`
- **Relationships**:
  - `user()` - BelongsTo User
  - `studyClass()` - BelongsTo StudyClass
  - `grades()` - HasMany Grade

### Controller: StudentController
- **File**: `app/Http/Controllers/StudentController.php`
- **Methods**:
  - `index()` - Tampilkan semua siswa dengan kelas dan wali kelasnya
  - `create()` - Form untuk assign siswa (hanya menampilkan siswa yang belum diassign)
  - `store()` - Simpan assignment siswa ke kelas
  - `edit($student)` - Form untuk edit/reassign siswa ke kelas lain
  - `update($student)` - Update assignment siswa
  - `destroy($student)` - Hapus siswa dari kelas

**Authorization**: Hanya role **admin** yang dapat mengakses semua method

## Routes

```php
Route::resource('students', StudentController::class);
// Menghasilkan:
// GET    /students              -> index
// GET    /students/create       -> create
// POST   /students              -> store
// GET    /students/{id}/edit    -> edit
// PUT    /students/{id}         -> update
// DELETE /students/{id}         -> destroy
```

Routes ini hanya tersedia untuk admin (middleware: `role:admin`)

## Views

### 1. students/index.blade.php
- Menampilkan tabel semua siswa
- Kolom: Nama Siswa, NISN, Kelas, Wali Kelas, Aksi
- Tombol: Tambah Siswa ke Kelas, Edit, Hapus
- Empty state: Jika belum ada siswa yang diassign

### 2. students/create.blade.php
- Form untuk assign siswa baru ke kelas
- Field:
  - **Pilih Siswa** (dropdown) - Hanya menampilkan User dengan role='student' yang belum punya Student record
  - **Pilih Kelas** (dropdown) - Semua kelas yang tersedia dengan info wali kelasnya
- Tombol: Simpan, Batal

### 3. students/edit.blade.php
- Form untuk reassign siswa ke kelas lain
- Menampilkan info siswa (name, NISN) sebagai read-only
- Field yang dapat diubah:
  - **Pilih Kelas Baru** (dropdown)
- Tombol: Simpan Perubahan, Batal

## Validasi

### Create/Store Validasi
- `user_id`: Required, exists di users table, unique di students table
- `study_class_id`: Required, exists di study_classes table

### Update Validasi
- `study_class_id`: Required, exists di study_classes table

## Data Flow

```
1. Admin membuat User (role='student')
   ↓
2. System auto-create Student record
   ↓
3. Admin buka Kelola Siswa → Tambah Siswa ke Kelas
   ↓
4. Pilih siswa + kelas
   ↓
5. System validate & create/update assignment
   ↓
6. Siswa sekarang terlihat di kelas dengan wali kelasnya
```

## Integrasi dengan Feature Lain

- **Grade Management**: Nilai siswa diambil dari Student record (via student_id)
- **Kelas**: Siswa ditampilkan dalam jumlah di halaman Kelas
- **User Management**: Siswa dibuat dari User dengan role='student'

## Notes

- Satu siswa hanya bisa diassign ke satu kelas pada satu waktu
- NISN bersifat unique dan tidak dapat diubah setelah pembuatan
- Saat siswa dihapus dari kelas, nilai mereka tetap tersimpan di grade table
- Dropdown "Pilih Siswa" di create form hanya menampilkan User yang belum punya Student record (fresh students)
- Edit form hanya memungkinkan perubahan kelas, bukan siswa atau NISN
