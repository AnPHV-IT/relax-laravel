<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'productId',
        'colorId',
        'userId',
        'categoryId',
        'amount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'colorId');
    }
    
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
