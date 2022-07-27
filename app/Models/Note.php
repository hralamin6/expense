<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function chapter()
    {
        return $this->belongsTo(Chapter::class)->withDefault();
    }
    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }
}
