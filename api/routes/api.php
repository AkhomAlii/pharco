<?php

use App\Http\Controllers\Api\CreditorsController;
use App\Http\Controllers\Api\PaymentsController;
use App\Models\Creditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



///////////////////////// Creditors /////////////////////////
Route::resource('creditors', CreditorsController::class)->only(['index', 'show']);

Route::get('creditor/{name}', function($name){
    return response()->json([
        'status' => 200,
        'creditors' => Creditor::without('payments')
                        ->where('name', 'LIKE', "%{$name}%")
                        ->get()
    ], 200);
});

////////////////////////////// Payments /////////////////////////
Route::resource('payments', PaymentsController::class)->only(['store', 'update', 'destroy']);
