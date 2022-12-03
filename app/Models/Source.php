<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
        protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

}
