<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
        protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function source()
    {
        return $this->belongsTo(Source::class)->withDefault();
    }
    public function storage()
    {
        return $this->belongsTo(Storage::class)->withDefault();
    }

}
