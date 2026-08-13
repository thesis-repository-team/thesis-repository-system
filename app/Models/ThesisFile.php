<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisFile extends Model
{
    //
    protected $fillable = [
        'thesis_id',
        'file_name',
        'file_type',
        'file_path',
        'uploaded_at',
    ];


    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }
    
    // public function files()
    // {
    //     return $this->hasMany(ThesisFile::class);
    // }

    // public function thesis()
    // {
    //     return $this->belongsTo(Thesis::class);
    // }
}