<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\AuthUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Routes that require authentication
Route::middleware([ApiAuthMiddleware::class])->group(function () {
    Route::get('/users/current', [UserController::class, 'get']);
    Route::patch('/users/current', [UserController::class, 'update']);
    Route::delete('/users/logout', [UserController::class, 'logout']);

    Route::get('/get-unit', [UnitController::class, 'allData']);
    Route::get('/get-unit/{id_unit}', [UnitController::class, 'detailData']);
    Route::post('/create-unit', [UnitController::class, 'store']);
    Route::put('/update-unit/{id_unit}', [UnitController::class, 'update']);
    Route::delete('/delete-unit/{id_unit}', [UnitController::class, 'destroy']);
});
