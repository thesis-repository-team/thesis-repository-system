<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedThesis extends Model
{

    protected $fillable = [
        'user_id',
        'thesis_id',
        'saved_at'
    ];

    protected $casts = [
        'saved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class, 'thesis_id');
    }
}
