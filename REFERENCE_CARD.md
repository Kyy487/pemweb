# 📱 REFERENCE CARD - QUICK COMMANDS & USAGE

## ⚡ QUICK COMMANDS

### Setup
```bash
# Seed test users
php artisan db:seed --class=TestUsersSeeder

# Clear cache
php artisan config:cache && php artisan view:cache
```

### Test
```bash
# Login with:
admin@erapor.local / password123
guru.matematika@erapor.local / password123
siswa1@erapor.local / password123

# Register at:
http://localhost/register
```

---

## 📖 QUICK SYNTAX

### Check Role (Blade)
```blade
@if(\App\Helpers\RoleHelper::isAdmin())
    Admin content
@endif

@if(\App\Helpers\RoleHelper::hasAnyRole('admin','teacher'))
    Admin or Teacher content
@endif
```

### Check Role (Controller)
```php
if (\App\Helpers\RoleHelper::isAdmin()) {
    // Admin logic
}
```

### Protect Routes
```php
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', ...);
});

// Multiple roles
Route::middleware(['auth', 'checkRole:admin,teacher'])->group(function () {
    Route::get('/reports', ...);
});
```

---

## 🎯 HELPER METHODS

| Method | Usage | Returns |
|--------|-------|---------|
| `isAdmin()` | Check if user is admin | bool |
| `isTeacher()` | Check if user is teacher | bool |
| `isStudent()` | Check if user is student | bool |
| `hasRole('admin')` | Check specific role | bool |
| `hasAnyRole('admin','teacher')` | Check if any role matches | bool |
| `getRoleName()` | Get role name in Indonesian | string |
| `getDashboardUrl()` | Get dashboard URL for user | string |
| `getallRoles()` | Get all available roles | array |
| `getRoleOptions()` | Get role options for select | array |
| `canEditUser($user)` | Check permission | bool |

---

## 🔑 ROLES

```
'admin'   → Admin
'teacher' → Guru
'student' → Siswa
```

---

## 🔗 REDIRECTS

After successful login:
```
Admin   → /admin/dashboard
Teacher → /teacher/dashboard
Student → /student/dashboard
```

---

## 📋 FILES TO REMEMBER

| Purpose | File |
|---------|------|
| Helper | `app/Helpers/RoleHelper.php` |
| Middleware | `app/Http/Middleware/CheckRole.php` |
| Register Logic | `app/Http/Controllers/Auth/RegisteredUserController.php` |
| Login Logic | `app/Http/Controllers/Auth/AuthenticatedSessionController.php` |
| Register Form | `resources/views/auth/register.blade.php` |
| Test Users | `database/seeders/TestUsersSeeder.php` |
| Doc | `QUICK_START_ROLE_AUTH.md` |

---

## ✅ CHECKLIST

- [ ] Seeds users (php artisan db:seed --class=TestUsersSeeder)
- [ ] Test register (http://localhost/register)
- [ ] Test login (3 different roles)
- [ ] Test route protection
- [ ] Setup routes in web.php
- [ ] Use helpers in blade/controller

---

**Print this & keep handy!** 🖨️
