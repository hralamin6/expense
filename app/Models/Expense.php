<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
        protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function storage()
    {
        return $this->belongsTo(Storage::class)->withDefault();
    }
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

}
