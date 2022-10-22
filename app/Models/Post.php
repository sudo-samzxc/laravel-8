<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $directory = '/images/';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'path',
    ];

    /**
     * Query scope
     */
     public static function scopeLatest($query)
     {
        return $query->orderBy('id', 'asc');
     }

     public function getPathAttribute($value)
     {
        return $this->directory . $value;
     }
}