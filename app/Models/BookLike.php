<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLike extends Model
{
    use HasFactory;

    public function likes(): HasMany
    {
        return $this->hasMany(BookLike::class);
    }
}
