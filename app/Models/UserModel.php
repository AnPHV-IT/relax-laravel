<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        "name",
        "email",
        "password",
        "address"
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'userId');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'userId');
    }


    public function colors()
    {
        return $this->hasManyThrough(Color::class, Cart::class, 'userId', 'id', 'id', 'colorId');
    }
}
