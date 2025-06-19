<?php

namespace App\Http\Middleware\products;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ValidateProductUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'price' => ['required', 'numeric'],
                'image' => ['nullable', 'image', 'max:2048'],
                'quantity' => ['required', 'integer'],
                'category' => ['required'],
                'colors' => ['required', 'array', 'min:1'],
                'colors.*.name' => ['required', 'string', 'max:255'],
                'colors.*.id' => ['nullable', 'integer', 'exists:colors,id'],
                'colors.*.image' => ['nullable', 'image', 'max:2048'],
            ]);

            return $next($request);
        } catch (ValidationException $validationErrors) {
            $formattedErrors = [];
            foreach ($validationErrors->errors() as $key => $messages) {
                $formattedErrors["validate.$key"] = $messages;
            }
            return redirect()->back()->withErrors($formattedErrors)->withInput();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
