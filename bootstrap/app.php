<?php

use App\Http\Middleware\AdminProtected;
use App\Http\Middleware\products\CreateProductValidate;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\products\ValidateProductUpdate;
use App\Http\Middleware\users\CreateUserValidate;
use App\Http\Middleware\users\SignInValidate;
use App\Http\Middleware\users\ValidateAddToCart;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "validate.create.user" => CreateUserValidate::class,
            "validate.signIn" => SignInValidate::class,
            "validate.product.create" => CreateProductValidate::class,
            "validate.product.update" => ValidateProductUpdate::class,
            "validate.cart.add" => ValidateAddToCart::class,
            'auth' => Authenticate::class,
            'auth___admin' => AdminProtected::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
