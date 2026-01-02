<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RoleHelper
{
    /**
     * Check jika user adalah Admin
     * 
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Check jika user adalah Guru (Teacher)
     * 
     * @return bool
     */
    public static function isTeacher(): bool
    {
        return Auth::check() && Auth::user()->role === 'teacher';
    }

    /**
     * Check jika user adalah Siswa (Student)
     * 
     * @return bool
     */
    public static function isStudent(): bool
    {
        return Auth::check() && Auth::user()->role === 'student';
    }

    /**
     * Check jika user memiliki role tertentu
     * 
     * @param string $role
     * @return bool
     */
    public static function hasRole(string $role): bool
    {
        return Auth::check() && Auth::user()->role === $role;
    }

    /**
     * Check jika user memiliki salah satu dari beberapa role
     * 
     * @param string ...$roles
     * @return bool
     */
    public static function hasAnyRole(...$roles): bool
    {
        return Auth::check() && in_array(Auth::user()->role, $roles);
    }

    /**
     * Check jika user memiliki semua dari role yang diberikan
     * 
     * @param string ...$roles
     * @return bool
     */
    public static function hasAllRoles(...$roles): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return in_array(Auth::user()->role, $roles);
    }

    /**
     * Get role name dalam Bahasa Indonesia
     * 
     * @param string|null $role
     * @return string
     */
    public static function getRoleName(?string $role = null): string
    {
        $currentRole = $role ?? (Auth::check() ? Auth::user()->role : null);

        $roleNames = [
            'admin' => 'Admin',
            'teacher' => 'Guru',
            'student' => 'Siswa',
        ];

        return $roleNames[$currentRole] ?? 'Unknown';
    }

    /**
     * Get semua available roles
     * 
     * @return array
     */
    public static function getAllRoles(): array
    {
        return ['admin', 'teacher', 'student'];
    }

    /**
     * Get role options untuk select dropdown
     * 
     * @return array
     */
    public static function getRoleOptions(): array
    {
        return [
            'admin' => 'Admin',
            'teacher' => 'Guru (Teacher)',
            'student' => 'Siswa (Student)',
        ];
    }

    /**
     * Check jika user bisa akses dashboard
     * 
     * @param string $dashboard
     * @return bool
     */
    public static function canAccessDashboard(string $dashboard): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $dashboards = [
            'admin' => 'admin',
            'teacher' => 'teacher',
            'student' => 'student',
        ];

        return Auth::user()->role === $dashboards[$dashboard] ?? false;
    }

    /**
     * Get dashboard URL untuk user yang sedang login
     * 
     * @return string
     */
    public static function getDashboardUrl(): string
    {
        if (!Auth::check()) {
            return '/';
        }

        $dashboards = [
            'admin' => '/admin/dashboard',
            'teacher' => '/teacher/dashboard',
            'student' => '/student/dashboard',
        ];

        return $dashboards[Auth::user()->role] ?? '/';
    }

    /**
     * Check jika user bisa edit user lain berdasarkan role
     * 
     * @param \App\Models\User $targetUser
     * @return bool
     */
    public static function canEditUser($targetUser): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $currentUser = Auth::user();

        // Admin bisa edit siapa saja
        if ($currentUser->role === 'admin') {
            return true;
        }

        // Teacher tidak bisa edit siapa saja
        if ($currentUser->role === 'teacher') {
            return false;
        }

        // Student hanya bisa edit diri sendiri
        if ($currentUser->role === 'student') {
            return $currentUser->id === $targetUser->id;
        }

        return false;
    }
}
