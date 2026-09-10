<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;

// class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail
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
        return $this->hasOne(Hod::class, 'user_id');
    }

    public function getNameAttribute()
    {
        return match ($this->role) {
            'student' => $this->student?->full_name,
            'hod' => $this->hod?->full_name,
            'admin' => $this->username,
            'guest' => $this->username,
            default => null,
        };
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
}