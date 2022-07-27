<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function subject()
    {
        return $this->belongsTo(Subject::class)->withDefault();
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
