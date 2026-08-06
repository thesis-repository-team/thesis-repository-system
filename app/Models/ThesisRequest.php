<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisRequest extends Model
{
    protected $fillable = [
        'author_name',
        'submitted_by',
        'department_id',
        'thesis_id',
        'title',
        'abstract',
        'description',
        'pdf_file',
        'status',
        'remarks',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }
}