# 📋 Fitur PDF Export / Cetak Rapor - E-Rapor

## Deskripsi
Sistem E-Rapor memiliki fitur lengkap untuk mencetak dan mengekspor rapor siswa dalam format PDF yang profesional dan mudah dibagikan.

## 🎯 Fitur-Fitur

### 1. **Export Rapor Siswa Individual**
Cetak rapor siswa dengan detail lengkap meliputi:
- Nama siswa, NISN, kelas
- Daftar semua mata pelajaran dan nilai
- Rata-rata nilai
- Status kelulusan (Lulus/Tidak Lulus)
- Tanggal cetak

**Route:** `GET /reports/student/{studentId}/view`

**Contoh:**
```
http://127.0.0.1:8000/reports/student/1/view
```

### 2. **Export Rapor Kelas**
Cetak rapor untuk seluruh kelas dengan:
- Nama kelas dan wali kelas
- Daftar semua siswa dengan nilai rata-rata mereka
- Jumlah siswa dalam kelas
- Status kelulusan setiap siswa

**Route:** `GET /reports/class/{classId}/view`

**Contoh:**
```
http://127.0.0.1:8000/reports/class/1/view
```

### 3. **Export Semua Siswa**
Cetak laporan lengkap semua siswa dari seluruh sekolah

**Route:** `GET /reports/all/view`

## 🖨️ Cara Menggunakan

### Langkah 1: Buka Laporan
Klik tombol "🖨️ Cetak / Download PDF" pada halaman laporan yang ingin dicetak.

### Langkah 2: Pilih Opsi Print
Tekan `Ctrl+P` (Windows) atau `Cmd+P` (Mac) untuk membuka dialog print browser.

### Langkah 3: Ubah ke PDF
Pada dialog print:
1. **Destination:** Pilih "Save as PDF"
2. **More settings:** Atur margin dan ukuran kertas sesuai kebutuhan
3. **Save:** Klik "Save" untuk mengunduh file PDF

### Alternatif: Print Langsung ke Kertas
1. Pilih printer fisik pada dropdown "Destination"
2. Klik "Print"

## 📊 Format Laporan

### Rapor Siswa Individual
```
╔═══════════════════════════════════════╗
║       📋 RAPOR SISWA                  ║
║  E-Rapor Digital Management System    ║
╚═══════════════════════════════════════╝

INFORMASI SISWA:
├─ Nama Siswa: Andi Pratama
├─ NISN: 1234567890
├─ Kelas: XII IPA 1
└─ Email: andi@sekolah.sch.id

NILAI MATA PELAJARAN:
┌────┬──────────────┬────────┬─────────┐
│ No │ Mata Pelajaran│ Nilai │ Status  │
├────┼──────────────┼────────┼─────────┤
│ 1  │ Matematika   │   85   │ Lulus   │
│ 2  │ Bahasa Indo  │   90   │ Lulus   │
│ 3  │ Bahasa Ingg  │   78   │ Lulus   │
│ 4  │ Fisika       │   88   │ Lulus   │
│ 5  │ Kimia        │   82   │ Lulus   │
└────┴──────────────┴────────┴─────────┘

RINGKASAN:
├─ Total Mata Pelajaran: 5
├─ Rata-rata Nilai: 84.60
└─ Tanggal Cetak: 29-12-2025
```

### Rapor Kelas
```
╔═══════════════════════════════════════╗
║      📊 RAPOR KELAS                   ║
║  E-Rapor Digital Management System    ║
╚═══════════════════════════════════════╝

INFORMASI KELAS:
├─ Nama Kelas: XII IPA 1
├─ Wali Kelas: Ibu Siti Nurhaliza
├─ Jumlah Siswa: 35
└─ Tanggal Cetak: 29-12-2025

DAFTAR NILAI SISWA:
┌────┬─────────────────┬──────────┬──────────┬─────────┬────────┐
│ No │ Nama Siswa      │ NISN     │ Total    │ Rata    │ Status │
│    │                 │          │ Nilai    │ Rata    │        │
├────┼─────────────────┼──────────┼──────────┼─────────┼────────┤
│ 1  │ Andi Pratama    │ 1234567  │ 5        │ 84.60   │ Lulus  │
│ 2  │ Budi Santoso    │ 1234568  │ 5        │ 78.40   │ Lulus  │
│ 3  │ Citra Dewi      │ 1234569  │ 5        │ 92.20   │ Lulus  │
└────┴─────────────────┴──────────┴──────────┴─────────┴────────┘
```

## 🎨 Styling & Design

- **Header:** Gradient biru (667eea → 764ba2)
- **Font:** Arial/Poppins
- **Warna Tabel:** Alternating rows untuk readability
- **Status Badge:** 
  - 🟢 Lulus (Hijau): #d4edda
  - 🔴 Tidak Lulus (Merah): #f8d7da

## 🔧 Teknologi

- **Laravel Framework:** Routing dan Controller
- **Blade Templating:** HTML struktur
- **CSS:** Print-optimized styling
- **Browser Print API:** Native browser printing

## 📝 Catatan Penting

1. **Print Preview:** Selalu preview sebelum cetak untuk memastikan formatting tepat
2. **Margin Settings:** Recommended margin 10mm untuk hasil optimal
3. **Ukuran Kertas:** A4 (default) untuk standar internasional
4. **File Names:** PDF akan otomatis diberi nama berdasarkan data (contoh: `rapor-Andi-Pratama-1234567.pdf`)

## 🚀 Improvement di Masa Depan

- [ ] Integrasi DOMPDF untuk auto-download tanpa print dialog
- [ ] Email PDF langsung ke siswa/orang tua
- [ ] Signature digital dari kepala sekolah
- [ ] QR Code untuk verifikasi rapor
- [ ] Template rapor yang dapat dikustomisasi
- [ ] Batch export untuk multiple students

## 📞 Support

Jika ada pertanyaan atau masalah dengan PDF export:
1. Pastikan browser support print-to-PDF (semua browser modern support)
2. Disable popup blockers untuk print dialog
3. Gunakan browser Chrome/Firefox untuk hasil terbaik
