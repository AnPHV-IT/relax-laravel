<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'productId',
        'userId',
        'colorId',
        'categoryId',
        'amount',
        "status",
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
