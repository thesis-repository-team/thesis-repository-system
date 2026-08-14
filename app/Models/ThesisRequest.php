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
        'reviewed_by',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
        ];
    }

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
    
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}