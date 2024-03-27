<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\CustomersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/customers', [CustomersController::class, 'index']);
Route::get('/customers-detail', [CustomersController::class, 'getById']);
Route::post('/customers-create', [CustomersController::class, 'create']);
Route::post('/customers-update', [CustomersController::class, 'update']);
Route::delete('/customers-delete', [CustomersController::class, 'delete']);