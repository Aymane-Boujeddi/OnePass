<?php

<<<<<<< HEAD
use App\Http\Controllers\Api\AdressIPController;
use App\Http\Controllers\AuthController;
=======

use App\Http\Controllers\Api\MotPassController;



use App\Http\Controllers\Api\AuthController;

>>>>>>> 2f7792fabe30401e99fa90c24aa4ec82c8081fad
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AdressIp;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

<<<<<<< HEAD

Route::get('/valider-ip/{id}',[AdressIPController::class,'validerNouvelleAppreil']);
Route::get('/refuser-ip/{id}',[AdressIPController::class,'refuserNouvelleAppreil']);



=======
// Route::post('/create',[MotPassController::class,'store']);
// Route::Post('/update',[MotPassController::class],'update');
// Route::Post('/delete'[MotPassController::class],'destroy');
// Route::Get('/Show',[MotPassController::class],'show');
// Route::Get('/Index',[MotPassController::class],'index');

Route::apiResource('password',MotPassController::class);
>>>>>>> 2f7792fabe30401e99fa90c24aa4ec82c8081fad
