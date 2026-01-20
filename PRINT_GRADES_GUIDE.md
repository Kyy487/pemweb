# 🖨️ FITUR CETAK NILAI - DOCUMENTATION

## ✨ Fitur yang Ditambahkan

Sistem E-Rapor sekarang memiliki fitur cetak nilai lengkap dengan beberapa opsi:

### 1. **Cetak Semua Nilai**
- **URL**: `/grades/print/all`
- **Akses**: Halaman Manajemen Nilai → Tombol "Cetak Semua"
- **Fitur**:
  - Menampilkan daftar semua nilai siswa
  - Statistik: Total nilai, lulus, tidak lulus, rata-rata
  - Tabel lengkap dengan nama siswa, mapel, guru, nilai, status
  - Print-friendly layout
  - Bisa di-download sebagai PDF via browser print

### 2. **Cetak Nilai Per Siswa**
- **Akses**: Halaman Manajemen Nilai → Klik "Cetak" di setiap baris
- **Fitur**:
  - Menampilkan rapor siswa individual
  - Detail: Nama, NISN, kelas, email
  - Daftar semua mapel dengan nilai
  - Statistik: Total mapel, rata-rata, tanggal cetak
  - Professional report format

### 3. **Cetak Halaman (Browser Print)**
- **Akses**: Halaman Manajemen Nilai → Tombol "Cetak"
- **Fitur**:
  - Cetak halaman saat ini apa adanya
  - Sidebar & tombol otomatis disembunyikan saat print
  - Optimized untuk kertas A4

---

## 🎯 Cara Menggunakan

### Cetak Semua Nilai
1. Login sebagai Admin/Teacher
2. Navigasi ke menu **Nilai** atau **Manajemen Nilai**
3. Klik tombol **"Cetak Semua"** (ikon printer berwarna)
4. Halaman baru akan terbuka dengan format laporan
5. Pilih:
   - **Cetak** untuk print ke printer
   - **Download PDF** untuk simpan sebagai file

### Cetak Nilai Siswa Individual
1. Di halaman **Manajemen Nilai**, cari baris siswa
2. Klik tombol **"Cetak"** di kolom Aksi
3. Rapor siswa akan terbuka di tab baru
4. Klik **"Cetak / Download PDF"** button
5. Gunakan browser print dialog untuk save/print

### Cetak Halaman Saat Ini
1. Di halaman **Manajemen Nilai**
2. Klik tombol **"Cetak"** di header
3. Browser print dialog akan muncul
4. Pilih printer atau "Save as PDF"

---

## 📊 Format Laporan

### Laporan Semua Nilai (grades/print/all)
```
LAPORAN NILAI SISWA
Sistem Manajemen Rapor Digital E-Rapor

[STATISTIK CARDS]
- Total Nilai: X
- Lulus: Y
- Tidak Lulus: Z
- Rata-rata: A.BC

[TABEL NILAI]
No. | Siswa | Mata Pelajaran | Guru | Nilai | Status
----|-------|----------------|------|-------|-------
1   | Nama  | Matematika     | Guru | 85   | Lulus
... | ...   | ...            | ...  | ...  | ...

[KETERANGAN]
- Nilai ≥ 70: LULUS
- Nilai < 70: TIDAK LULUS
```

### Rapor Siswa Individual (/reports/student/{id}/view)
```
RAPOR SISWA
Sistem Manajemen Rapor Digital E-Rapor

[INFORMASI SISWA]
Nama Siswa: ...
NISN: ...
Kelas: ...
Email: ...

[NILAI MATA PELAJARAN]
No. | Mata Pelajaran | Nilai | Status
----|----------------|-------|-------
1   | Matematika     | 85    | Lulus
... | ...            | ...   | ...

[RINGKASAN]
- Total Mata Pelajaran: X
- Rata-rata Nilai: Y.YY
- Tanggal Cetak: DD-MM-YYYY
```

---

## 🖥️ Navigasi Routes

| Aksi | Route | Method |
|------|-------|--------|
| List Nilai | `/grades` | GET |
| Tambah Nilai | `/grades/create` | GET |
| Simpan Nilai | `/grades` | POST |
| Edit Nilai | `/grades/{id}/edit` | GET |
| Update Nilai | `/grades/{id}` | PUT |
| Hapus Nilai | `/grades/{id}` | DELETE |
| **Cetak Semua** | `/grades/print/all` | GET |
| **Cetak Siswa** | `/reports/student/{id}/view` | GET |

---

## 🎨 Fitur Print

### Styling Print-Friendly
- ✅ Sidebar otomatis hilang saat print
- ✅ Tombol aksi disembunyikan
- ✅ Warna tetap preserve (untuk tinta warna)
- ✅ Page break otomatis untuk tabel panjang
- ✅ Header tabel repeat di setiap halaman
- ✅ Layout responsive untuk kertas berbeda

### Browser Support
- ✅ Chrome/Chromium
- ✅ Firefox
- ✅ Safari
- ✅ Edge
- ✅ Opera

---

## 📥 Download PDF

### Cara 1: Browser Print Dialog
1. Buka halaman cetak nilai
2. Klik "Cetak" atau tekan `Ctrl+P`
3. Pilih "Save as PDF" sebagai printer
4. Atur setting (landscape untuk tabel lebar)
5. Klik "Save"

### Cara 2: Print to File
1. Print ke printer fisik
2. Atau gunakan "Print to File" option

### Rekomendasi Settings
```
- Paper Size: A4
- Orientation: Portrait (untuk laporan), Landscape (untuk tabel lebar)
- Margins: Default
- Headers/Footers: Disable (opsional)
- Color: Color (untuk warna status)
```

---

## 🔧 File yang Diubah/Ditambah

### Files Created ✅
1. **resources/views/grades/print.blade.php**
   - Halaman cetak semua nilai
   - Layout professional
   - Statistik & tabel lengkap

### Files Modified ✅
1. **resources/views/grades/index.blade.php**
   - Tambah tombol "Cetak Semua"
   - Tambah tombol "Cetak" halaman
   - Tambah link "Cetak" per siswa
   - Tambah @media print CSS

2. **app/Http/Controllers/GradeController.php**
   - Tambah method `print()`
   - Route ke print view

3. **routes/web.php**
   - Tambah route `/grades/print/all`

---

## ✨ Fitur Existing (Sudah Ada)

### Report Pages (Sudah berfungsi)
- ✅ `/reports/student/{id}/view` - Rapor siswa individual
- ✅ `/reports/class/{id}/view` - Rapor kelas
- ✅ `/reports/all/view` - Rapor semua siswa

---

## 🎯 Testing

### Test 1: Cetak Semua Nilai
```
1. Buka: http://localhost/grades
2. Klik "Cetak Semua"
3. Verifikasi:
   - Halaman baru terbuka
   - Statistik tampil (4 cards)
   - Tabel nilai tampil
   - Tombol cetak berfungsi
   - Ctrl+P works
   - Save as PDF berfungsi
```

### Test 2: Cetak Per Siswa
```
1. Di halaman grades
2. Klik "Cetak" di setiap baris
3. Verifikasi:
   - Rapor siswa terbuka
   - Data siswa tepat
   - Nilai-nilai tersedia
   - Print berfungsi
```

### Test 3: Print Styling
```
1. Tekan Ctrl+P untuk preview print
2. Verify:
   - Sidebar hilang
   - Tombol hilang
   - Tabel rapi
   - Warna tetap
```

---

## 💡 Tips & Tricks

### Print Multiple Pages
- Halaman print otomatis page-break di setiap tabel
- Gunakan landscape mode untuk tabel lebar

### Export ke Excel
- Saat ini copy-paste tabel ke Excel
- Atau gunakan browser export HTML ke Excel

### Custom Watermark
- Di print dialog, setting "Headers and footers" untuk custom text

### Print dengan Logo Sekolah
- Bisa di-customize di halaman print dengan menambah logo

---

## 🐛 Troubleshooting

### Print tidak berfungsi
- Pastikan JavaScript enabled di browser
- Coba browser lain (Chrome recommended)
- Cek console untuk errors

### PDF size terlalu besar
- Gunakan "Reduce file size" option di browser save dialog
- Uncheck "Print backgrounds" jika tidak perlu

### Data tidak tampil di print
- Pastikan data grades sudah tersimpan
- Cek database untuk nilai yang ada

---

## 🔐 Security

- ✅ Hanya authenticated users bisa akses
- ✅ Role-based access control (admin/teacher)
- ✅ Student hanya bisa lihat rapor sendiri
- ✅ Tidak ada data sensitive di print plain text

---

## 📞 Support

Untuk bantuan lebih lanjut:
1. Check dokumentasi PDF_EXPORT_GUIDE.md
2. Check QUICK_REFERENCE.md
3. Lihat dokumentasi dashboard

---

**Status**: ✅ FULLY FUNCTIONAL

**Last Updated**: 31 Desember 2025

**Fitur cetak nilai sudah ready untuk production!** 🎉
