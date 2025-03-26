<?php

use App\Http\Controllers\Api\MotPassController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::post('/create',[MotPassController::class,'store']);
// Route::Post('/update',[MotPassController::class],'update');
// Route::Post('/delete'[MotPassController::class],'destroy');
// Route::Get('/Show',[MotPassController::class],'show');
// Route::Get('/Index',[MotPassController::class],'index');

Route::apiResource('password',MotPassController::class);