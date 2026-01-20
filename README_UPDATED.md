# 🎓 E-Rapor - Sistem Manajemen Rapor Digital

Sistem manajemen rapor digital yang modern, responsif, dan user-friendly untuk institusi pendidikan. Kelola nilai, kelas, siswa, dan guru dengan mudah.

## ✨ Fitur Utama

### 📊 Dashboard
- **Admin Dashboard** - Statistik lengkap (total kelas, guru, siswa, mata pelajaran)
- **Teacher Dashboard** - Manajemen nilai siswa
- **Student Dashboard** - Lihat nilai dan rapor pribadi

### 📚 Manajemen Data
- **Kelas** - CRUD kelas dengan wali kelas
- **Mata Pelajaran** - CRUD mata pelajaran
- **Siswa** - Manajemen data siswa
- **Guru/User** - Manajemen pengguna dengan role berbeda
- **Nilai** - Input dan tracking nilai siswa

### 📄 Cetak & Export
- **PDF Rapor Individual** - Cetak rapor siswa single
- **PDF Rapor Kelas** - Cetak rapor seluruh kelas
- **Print-to-PDF** - Gunakan fitur print browser untuk download PDF
- **Professional Layout** - Formatting rapor yang rapi dan profesional

### 🎨 UI/UX Modern
- **Gradient Design** - Design modern dengan gradient purple
- **Responsive** - Fully responsive di desktop, tablet, mobile
- **Animations** - Smooth animations dan transitions
- **Professional** - Desain profesional dan clean

## 🚀 Quick Start

### 1. Setup
```bash
# Clone repository
git clone <repository-url>
cd e-rapor-Copy

# Install dependencies
composer install
npm install

# Create .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Migrate database
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### 2. Run Application
```bash
# Start Laravel server
php artisan serve

# Browser: http://127.0.0.1:8000
```

### 3. Login
- **Default User:** 
  - Email: admin@rapor.test
  - Password: password

### 4. Gunakan Fitur PDF Export
1. Navigate ke Report section
2. Klik "View Report" untuk student/class
3. Klik tombol "🖨️ Cetak / Download PDF"
4. Press Ctrl+P (Windows) atau Cmd+P (Mac)
5. Select "Save as PDF"
6. Download selesai! 📄

## 📦 Tech Stack

- **Backend:** Laravel 8.x
- **Frontend:** Blade Templates + Custom CSS
- **Database:** MySQL/SQLite
- **PHP:** 8.0+
- **Font:** Poppins (Google Fonts)

## 📂 Project Structure

```
e-rapor-Copy/
├── app/
│   ├── Http/Controllers/
│   │   ├── ClassController.php
│   │   ├── SubjectController.php
│   │   ├── UserController.php
│   │   ├── GradeController.php
│   │   └── ReportController.php
│   └── Models/
│       ├── User.php
│       ├── Student.php
│       ├── StudyClass.php
│       ├── Subject.php
│       └── Grade.php
├── resources/
│   ├── views/
│   │   ├── auth/ (Login & Register)
│   │   ├── dashboards/ (Admin, Teacher, Student)
│   │   ├── classes/ (CRUD)
│   │   ├── subjects/ (CRUD)
│   │   ├── users/ (CRUD)
│   │   ├── reports/ (PDF Templates)
│   │   └── welcome.blade.php (Landing Page)
│   └── css/
├── routes/
│   ├── web.php (Web routes)
│   └── auth.php (Auth routes)
├── database/
│   ├── migrations/
│   └── seeders/
└── public/
```

## 🎨 Design System

### Colors
- Primary: `#667eea` (Purple)
- Secondary: `#764ba2` (Dark Purple)
- Success: `#28a745` (Green)
- Error: `#e74c3c` (Red)

### Fonts
- Primary: Poppins (Google Fonts)
- Secondary: Arial (for print)

### Gradients
- Main: `linear-gradient(135deg, #667eea 0%, #764ba2 100%)`
- Secondary: `linear-gradient(135deg, #007bff 0%, #0056b3 100%)`

## 📝 Key Routes

### Authentication
- `GET /login` - Login page
- `GET /register` - Register page
- `POST /login` - Submit login
- `POST /register` - Submit registration
- `POST /logout` - Logout

### Dashboard
- `GET /dashboard` - Role-based dashboard

### Resources
- `GET /classes` - List classes
- `POST /classes` - Create class
- `GET /classes/{id}/edit` - Edit class
- `PUT /classes/{id}` - Update class
- `DELETE /classes/{id}` - Delete class

*Similar routes for subjects, users, grades*

### Reports
- `GET /reports/student/{studentId}/view` - Student report
- `GET /reports/class/{classId}/view` - Class report
- `GET /reports/all/view` - All students report

## 🔐 User Roles

### Admin
- Full access to all features
- Manage classes, subjects, users
- View all reports
- System settings

### Teacher
- Create and manage grades
- View class reports
- Access own dashboard

### Student
- View own grades and report
- Access own dashboard
- Download own report card

## 🖨️ PDF Export Guide

Lihat `PDF_EXPORT_GUIDE.md` untuk panduan lengkap cara menggunakan fitur PDF export.

**TL;DR:**
1. Navigate ke report page
2. Klik "🖨️ Cetak / Download PDF"
3. Press Ctrl+P (or Cmd+P)
4. Select "Save as PDF"
5. Download! 

## 🐛 Troubleshooting

### Register Error
**Fixed!** Register page error sudah diperbaiki. Page sekarang bersih dan profesional.

### Port 8000 sudah terpakai
```bash
# Gunakan port berbeda
php artisan serve --port=8001
```

### Database error
```bash
# Check .env database config
# Run migration
php artisan migrate:fresh --seed
```

### Print dialog tidak muncul
- Disable browser popup blocker
- Gunakan browser terbaru (Chrome/Firefox recommended)
- Check console untuk error messages

## 📚 Documentation

- `IMPLEMENTATION_SUMMARY.md` - Summary implementasi fitur
- `PDF_EXPORT_GUIDE.md` - Panduan lengkap PDF export
- `README.md` - File ini

## 🚀 Future Enhancements

- [ ] Email integration untuk send report
- [ ] Digital signature dari kepala sekolah
- [ ] QR code untuk verifikasi rapor
- [ ] Custom report templates
- [ ] Bulk export for multiple students
- [ ] DOMPDF integration untuk auto-download
- [ ] Multi-language support
- [ ] Mobile app version

## 📞 Support

Untuk pertanyaan atau bug reports:
1. Check dokumentasi di folder project
2. Review file implementation summary
3. Check error logs di `storage/logs/`

## 📄 License

This project is open source. Feel free to use and modify.

---

**Version:** 1.0.0  
**Last Updated:** December 29, 2025  
**Status:** ✅ Production Ready
