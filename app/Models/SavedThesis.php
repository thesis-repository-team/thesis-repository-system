<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedThesis extends Model
{

    protected $fillable = [
        'student_id',
        'thesis_id',
        'saved_at'
    ];

    protected $casts = [
        'saved_at' => 'datetime',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function thesis(){
        return $this->belongsTo(Thesis::class,'thesis_id');
    }
}
