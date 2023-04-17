<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login and Register
Route::get('/',[AuthController::class,'welcome'])->middleware('AlreadyLogin');
Route::get('/login',[AuthController::class,'login'])->middleware('AlreadyLogin');
Route::get('/register',[AuthController::class,'register'])->middleware('AlreadyLogin');
Route::post('/registeruser',[AuthController::class,'registeruser']);
Route::post('/loginuser',[AuthController::class,'loginuser']);
Route::get('/dashboard',[AuthController::class,'dashboard']);
Route::get('/logout',[AuthController::class,'logout']);
Route::post('/fetchstate',[AuthController::class,'fetchstate']);
Route::post('/fetchcity',[AuthController::class,'fetchcity']);

// Crud Operation + searching + pagination + column sorting
// Auth::routes(['verify'=>true]);
Route::get('/list',[CRUDController::class,'getData'])->middleware(['AuthCheck']);
Route::get('/add',[CRUDController::class,'addData'])->middleware('AuthCheck');
Route::post('/save',[CRUDController::class,'saveData']);
Route::get('/edit/{id}',[CRUDController::class,'editData'])->middleware('AuthCheck');
Route::post('/edit',[CRUDController::class,'updateData']);
Route::get('/delete/{id}',[CRUDController::class,'deleteData'])->middleware('AuthCheck');
Route::post('/edit/fetchstateedit',[CRUDController::class,'fetchstateedit']);
Route::post('/edit/fetchcityedit',[CRUDController::class,'fetchcityedit']);

//country state and city dropdown
// Route::get('/register',[AuthController::class,'cscdropdown']);
// Route::post('/fetchstate',[CRUDController::class,'fetchstate']);
// Route::post('/fetchcity',[CRUDController::class,'fetchcity']);

