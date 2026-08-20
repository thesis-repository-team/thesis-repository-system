<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewHistory extends Model
{
    protected $fillable = [
        'user_id',
        'thesis_id',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongTo(User::class, 'user_id');
    }

    public function thesis()
    {
        return $this->belongsTo(Thesis::class, 'thesis_id');
    }
}
