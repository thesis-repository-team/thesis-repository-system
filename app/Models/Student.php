<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'full_name',
        'user_id',
        'department_id',
        'upload_permission',
        'started_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
