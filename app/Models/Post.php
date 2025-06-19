<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use HasFactory;

    // Các thuộc tính có thể gán hàng loạt
    protected $fillable = [
        'title',
        'content',
        'slug',
    ];
}
