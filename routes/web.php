<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/formLogin ',[\App\Http\Controllers\VisiteurController::class,'getLogin']);

Route::post('/login ',[\App\Http\Controllers\VisiteurController::class,'signIn']);