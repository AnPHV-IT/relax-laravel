<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminController;


Route::post("/v3/user", [UserController::class, "CreateUser"])
    ->name('CreateUser')
    ->middleware("validate.create.user");
Route::post('/login', [UserController::class, "SignIn"])
    ->name("login")
    ->middleware(middleware: "validate.signIn");

// Pages
Route::get('/sign-up', [UserController::class, "signUpPage"])
    ->name('signUpPage');
Route::get('/login', [UserController::class, "signInPage"])
    ->name('login');

///--------------------------------------------------------------Users----------------------------------------------------------------------

//Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
// Product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
//Showroom
Route::get('/showroom', [ShowroomController::class, 'index'])->name('showroom');
//Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
//Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

///--------------------------------------------------------------admin----------------------------------------------------------------------
Route::middleware('auth___admin')->prefix('admin')->group(function () {

    // Route dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/categories/{id}/edit', [AdminController::class, 'categoriesEditView'])->name('categoriesEditView');
    Route::get('/categories/create', [AdminController::class, 'categoriesCreate'])->name('categoriesCreate');
    Route::post('/categories/create', [AdminController::class, 'categoriesCreateAdmin'])->name('categoriesCreateAdmin');
    Route::delete('/categories/{id}/destroy', [AdminController::class, 'categoriesDestroy'])->name('categoriesDestroy');
    Route::patch('/categories/{id}/edit', [AdminController::class, 'categoriesEdit'])->name('categoriesEdit');

    Route::get('/contacts', [AdminController::class, 'IndexContact'])->name('admin.contacts');
    // Route quản lý sản phẩm
    Route::get('/products', [AdminController::class, 'productsIndex'])->name('productsIndex');
    Route::get('/products/create', [AdminController::class, 'productsCreate'])->name('products.create');

    Route::post('/products/create', [AdminController::class, 'productsStore'])
        ->name('products.store')
        ->middleware('validate.product.create');

    Route::get('/products/{id}/edit', [AdminController::class, 'productsEdit'])
        ->name('products.edit');

    Route::put('/products/{id}/update', [AdminController::class, 'productsUpdate'])
        ->name('products.update')
        ->middleware("validate.product.update");

    Route::delete('/products/{productId}/colors/{colorId}/delete', [AdminController::class, 'productsColorDelete'])
        ->name('products.colors.delete');

    Route::delete('/products/{productId}/destroy', [AdminController::class, 'productsDestroy'])->name('products.destroy');

    // Order Management
    Route::get('/orders', [AdminController::class, 'ordersIndex'])->name('orders.index');
    Route::get('/orders/{id}', [AdminController::class, 'ordersShow'])->name('orders.show');
    Route::patch("/orders/{orderId}/confirm", [AdminController::class, 'OrderConfirm'])->name('OrderConfirm');
    Route::patch("/orders/{orderId}/cancel", [AdminController::class, 'OrderCancel'])->name('OrderCancel');

    Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
    Route::get('/users/{id}', [AdminController::class, 'usersShow'])->name('users.show');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('users.destroy');
});

///------------------------------------------------------------------------------------------------------------------------------------

// Authentication routes
// Protected route
// Routes bảo vệ bởi middleware auth
Route::middleware('auth')->group(function () {
    // Trang chính của người dùng


    //Cart
    Route::get('/dashboard', [UserController::class, "main"])->name('main');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add', [CartController::class, "addTocart"])
        ->name("addTocart")
        ->middleware("validate.cart.add");

    Route::delete('/carts/{cartId}/destroy', [CartController::class, "cartDelete"])
        ->name("cartDelete");

    Route::post('/orders', [CartController::class, "AddOrder"])
        ->name("AddOrder");

    Route::get('/orders', [CartController::class, "OrderView"])
        ->name("OrderView");


    // Các route khác cần thiết cho người dùng đã đăng nhập
});
