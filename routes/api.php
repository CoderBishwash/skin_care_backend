<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('products', [ProductController::class, 'index']);      // List all products
Route::get('products/{id}', [ProductController::class, 'show']);  // Get single product

Route::get('doctors', [DoctorController::class, 'index']); // get all doctors
Route::get('doctor/{id}', [DoctorController::class, 'show']); // get single doctor with products
Route::get('doctors/{id}/products', [DoctorController::class, 'productsByDoctor']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [UserController::class, 'show']); // get profile

    Route::put('/profile', [UserController::class, 'update']); // update profile
    
});
