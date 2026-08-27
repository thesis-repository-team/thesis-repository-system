<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['keyword_name'];

    public function thesis()
    {
        return $this->belongToMany(Thesis::class);
    }
}
