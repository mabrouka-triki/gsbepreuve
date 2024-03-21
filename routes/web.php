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


// Afficher le formulaire d'ajout de spécialité
Route::get('/ajoutSpecialite', [\App\Http\Controllers\PraticienController::class, '']);

// Ajouter la spécialité à un praticien
Route::post('/ajoutSpecialite', [\App\Http\Controllers\PraticienController::class, '']);

// Validation du formulaire d'ajout de spécialité
Route::post('/postAjoutSpecialite', [\App\Http\Controllers\PraticienController::class, '']);



