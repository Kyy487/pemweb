# E-Rapor Quick Reference Guide

## 🚀 Quick Start

### Start the Server
```bash
cd "d:\laragon\www\e-rapor-Copy"
php artisan serve
```
Then visit: `http://localhost:8000`

---

## 👥 Login Credentials (After Seeding)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Teacher | teacher@example.com | password |
| Student | student@example.com | password |

---

## 📊 Dashboard Features by Role

### 🛡️ Admin Dashboard `/dashboard`
**What You See**:
- 4 Statistics cards (Classes, Teachers, Students, Subjects)
- Quick action buttons for management
- Report export options

**What You Can Do**:
- `/classes` - Manage classes (Create, Edit, Delete)
- `/subjects` - Manage subjects (Create, Edit, Delete)
- `/users` - Manage users (Create, Edit, Delete)
- `/grades` - View all grades
- `/reports/all/view` - Download all reports

---

### 👨‍🏫 Teacher Dashboard `/dashboard`
**What You See**:
- Statistics (Subjects, Classes, Students, Grades)
- List of your classes
- Grade input options

**What You Can Do**:
- `/grades` - Input student grades
- `/reports/all/view` - Download report
- View your assigned classes and subjects

---

### 👨‍🎓 Student Dashboard `/dashboard`
**What You See**:
- Your personal information
- Your grades for all subjects
- Grade statistics (average, status)
- Attendance information

**What You Can Do**:
- View your grades
- `/reports/student/{id}/view` - Download your report
- Print report (Ctrl+P)

---

## 🔗 All Available Routes

### Dashboard & Auth
```
GET  /                    → Landing page
GET  /login               → Login page
GET  /register            → Register page
GET  /dashboard           → Role-based dashboard
POST /logout              → Logout
```

### Class Management
```
GET    /classes            → List all classes
GET    /classes/create     → Create class form
POST   /classes            → Save new class
GET    /classes/{id}/edit  → Edit class form
PUT    /classes/{id}       → Update class
DELETE /classes/{id}       → Delete class
```

### Subject Management
```
GET    /subjects           → List all subjects
GET    /subjects/create    → Create subject form
POST   /subjects           → Save new subject
GET    /subjects/{id}/edit → Edit subject form
PUT    /subjects/{id}      → Update subject
DELETE /subjects/{id}      → Delete subject
```

### User Management
```
GET    /users              → List all users
GET    /users/create       → Create user form
POST   /users              → Save new user
GET    /users/{id}/edit    → Edit user form
PUT    /users/{id}         → Update user
DELETE /users/{id}         → Delete user
```

### Grade Management
```
GET    /grades             → List grades
GET    /grades/create      → Input grade form
POST   /grades             → Save new grade
GET    /grades/{id}/edit   → Edit grade form
PUT    /grades/{id}        → Update grade
DELETE /grades/{id}        → Delete grade
```

### Reports
```
GET /reports/student/{id}/view → View student report
GET /reports/class/{id}/view   → View class report
GET /reports/all/view          → View all students report
```

---

## 🎨 Design Colors

- **Primary Purple**: #667eea → #764ba2
- **Success Green**: #10b981
- **Danger Red**: #ef4444
- **Background**: #f5f7fa
- **Text**: #333333

---

## 📱 Responsive Breakpoints

| Screen Size | Behavior |
|------------|----------|
| < 768px | Mobile - Single column, simplified layout |
| 768px - 1200px | Tablet - Adjusted grid, readable |
| > 1200px | Desktop - Full layout with all features |

---

## 🎯 Common Tasks

### Create a New Class
1. Go to `/classes`
2. Click "Tambah Kelas" button
3. Fill in class name and other details
4. Click "Simpan"

### Input Student Grades
1. Login as Teacher
2. Go to Dashboard
3. Click "Input Nilai Baru"
4. Select class and subject
5. Enter grades for students
6. Click "Simpan Nilai"

### Download Student Report
1. Login as Student
2. Go to Dashboard
3. Click "Download Rapor" button
4. Or click "Cetak Rapor" to print directly

### Export All Student Data
1. Login as Admin
2. Go to Dashboard
3. Click "Export Semua Siswa"
4. Save PDF or print

---

## 🔧 Troubleshooting

### Dashboard Not Loading
```bash
# Clear cache
php artisan cache:clear

# Restart server
# (Stop and run: php artisan serve again)
```

### Database Error
```bash
# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed
```

### Styles Not Loading
```bash
# Check that CSS file is linked in blade files
# Or rebuild frontend assets
npm run dev
```

### Route Not Found
```bash
# Check routes are registered
php artisan route:list

# Check route spelling matches exactly
```

---

## 📋 File Locations

| What | Where |
|------|-------|
| Dashboard views | `resources/views/dashboards/` |
| Class views | `resources/views/classes/` |
| Subject views | `resources/views/subjects/` |
| User views | `resources/views/users/` |
| Report views | `resources/views/reports/` |
| Auth pages | `resources/views/auth/` |
| Controllers | `app/Http/Controllers/` |
| Models | `app/Models/` |
| Routes | `routes/web.php` |
| Database | `database/migrations/` |

---

## 🔐 Security Features

✅ CSRF Token Protection  
✅ Password Hashing (bcrypt)  
✅ Role-based Access Control  
✅ Middleware Authentication  
✅ Input Validation  
✅ SQL Injection Prevention (Eloquent ORM)  

---

## 🎓 Database Schema

### Users Table
```sql
id | name | email | password | role | created_at | updated_at
```

### Study Classes Table
```sql
id | name | grade | homeroom_teacher_id | created_at | updated_at
```

### Subjects Table
```sql
id | name | code | description | created_at | updated_at
```

### Students Table
```sql
id | user_id | study_class_id | student_id | created_at | updated_at
```

### Grades Table
```sql
id | student_id | subject_id | grade | teacher_id | created_at | updated_at
```

---

## 📊 Statistics Explained

| Metric | How It's Calculated |
|--------|---------------------|
| Total Classes | COUNT(study_classes) |
| Total Teachers | COUNT(users WHERE role='teacher') |
| Total Students | COUNT(students) |
| Total Subjects | COUNT(subjects) |
| Average Grade | AVG(grades.grade) |
| Grades Entered | COUNT(grades) |
| Pass/Fail | grade >= 70 ? 'Pass' : 'Fail' |

---

## 🖨️ Print & PDF Options

### To Print Dashboard
1. Press `Ctrl + P`
2. Click "Print" or "Save as PDF"
3. Choose destination and save

### Print-Optimized Pages
- All dashboards (responsive print style)
- All reports (`/reports/...`)
- All data tables

---

## 🔄 Update Checklist

When deploying to production:
- [ ] Update `.env` file with production values
- [ ] Set `APP_DEBUG=false`
- [ ] Run database migrations: `php artisan migrate --env=production`
- [ ] Clear cache: `php artisan cache:clear`
- [ ] Compile assets: `npm run build`
- [ ] Set proper file permissions
- [ ] Configure SSL/HTTPS

---

## 📞 Support Resources

1. **Laravel Documentation**: https://laravel.com/docs/8.x
2. **Bootstrap Icons**: https://icons.getbootstrap.com
3. **Poppins Font**: https://fonts.google.com/specimen/Poppins
4. **E-Rapor Docs**: Check documentation files in project root

---

## 🎯 Key Keyboard Shortcuts

| Shortcut | Action |
|----------|--------|
| Ctrl+P | Print/Save as PDF |
| Ctrl+Shift+C | Clear browser cache |
| F12 | Developer Tools |
| Alt+Left | Browser back |
| Alt+Right | Browser forward |

---

**Quick Reference v1.0**  
**Last Updated**: 2025-01-12  
✅ Ready to Use
