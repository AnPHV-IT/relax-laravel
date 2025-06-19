<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('users.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where(["id" => $id])->firstOrFail();
        $categories = Category::all();
        return view('users.products.show', compact('product', "categories"));
    }
}
