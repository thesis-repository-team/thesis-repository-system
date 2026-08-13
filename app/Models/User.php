<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // protected $primaryKey = 'user_id';

    protected $fillable = [
        'email',
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function hod()
    {
        return $this->hasOne(Hod::class,'user_id');
    }

    public function getNameAttribute()
    {
        return match ($this->role) {
            'student' => $this->student?->full_name,
            'hod' => $this->hod?->full_name,
            'admin' => $this->username,
            default => null,
        };
    }
}
