<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maize\Markable\Markable;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Favorite;

class Book extends Model
{
    use HasFactory, SoftDeletes, Markable;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'author_name',
    ];

    protected static $marks = [
        Like::class,
        Favorite::class,
    ];

    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
