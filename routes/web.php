<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\PraticienController;

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
Route::get('/getLogout ',[\App\Http\Controllers\VisiteurController::class,'singOut']);


//liste la table praticien avec jointure
Route::get('/listePraticiens ',[\App\Http\Controllers\PraticienController::class,'getPraticien']);







Route::get('/addSpePraticien', [\App\Http\Controllers\PraticienController::class, 'addSpecialite']);
Route::post('/addSpePraticien', [\App\Http\Controllers\PraticienController::class, 'addSpecialite']);


Route::get('/rechercherPraticien', [\App\Http\Controllers\PraticienController::class, 'rechercherPraticien'])->name('rechercherPraticien');






Route::get('/ModififSpePraticien', [\App\Http\Controllers\PraticienController::class, 'updateSpecialite']);
Route::post('/postmodifierSpe', [\App\Http\Controllers\PraticienController::class, 'updateSpecialite'])->name('postmodifierSpe');
