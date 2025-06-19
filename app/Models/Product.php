<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'public_id',
        "quantity",
        "category_id",
        'image',
    ];

    public function colors()
    {
        return $this->hasMany(Color::class, 'productId');
    }
}
