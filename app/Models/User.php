<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // HasApiTokens dihapus dari sini agar tidak error di hosting
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Tambahan standar Laravel terbaru
    ];

    /**
     * Get the user's role.
     */
    public function getRoleNameAttribute()
    {
        return $this->role;
    }

    /**
     * Get the student record for this user (if exists)
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }
}