<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'abstract',
        'description',
        'department_id',
        'author_name',
        'submitted_by',
        'published_by',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function publishedBy()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function files()
    {
        return $this->hasMany(ThesisFile::class);
    }

    //Update for using query 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

