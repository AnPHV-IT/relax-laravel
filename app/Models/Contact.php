<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company',
        'address',
        'phone',
        'email',
        'message' // Ngày hết hạn nếu có
    ];
}
