<?php

use App\Http\Controllers\Api\AdressIPController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AdressIp;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/valider-ip/{id}',[AdressIPController::class,'validerNouvelleAppreil']);
Route::get('/refuser-ip/{id}',[AdressIPController::class,'refuserNouvelleAppreil']);



