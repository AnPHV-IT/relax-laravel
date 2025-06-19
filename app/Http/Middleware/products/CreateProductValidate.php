<?php

namespace App\Http\Middleware\products;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CreateProductValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $request->validate([
                'name' => ["required", "max:255"],
                'price' => ["required", "integer"],
                'description' => ["required"],
                'category' => ['required'],
                'quantity' => ['required', 'integer'],
                'image' => ['required', 'image', 'max:2048'],
                'categories' => ["required", "array", "min:1"],
                'categories.*' => ['required', 'string', 'max:255'],
                "colors" => ["required", "array", "min:1"],
                'colors.*.name' => ['required', 'string', 'max:255'],
                'colors.*.image' => ['required', 'image', 'max:2048'],
            ]);

            return $next($request);
        } catch (ValidationException $validationErrors) {
            $formattedErrors = [];
            foreach ($validationErrors->errors() as $key => $messages) {
                $formattedErrors["validate.$key"] = $messages;

                Log::info($messages);
            }
            return redirect()->back()->withErrors($formattedErrors)->withInput();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Intern  al Server Error',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
