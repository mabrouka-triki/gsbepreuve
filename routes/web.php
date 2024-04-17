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

//recherche par nom praticien
Route::get('/rechercherPraticien', [\App\Http\Controllers\PraticienController::class, 'rechercherPraticien'])->name('rechercherPraticien');




//Ajout une specialité liste deroulante de praticien et specialité


Route::post('/postSpecialite', [\App\Http\Controllers\PraticienController::class, 'insertSpecialite']);
Route::get ('/addSpePraticien', [\App\Http\Controllers\PraticienController::class, 'insertSpecialite']);
Route::get ('/ajouterSpecialite', [\App\Http\Controllers\PraticienController::class, 'deroulantinsertSpecialite']);



// Route pour afficher le formulaire de modification de spécialité du praticien
Route::get('/ModifSpePraticien/{id_praticien}', 'App\Http\Controllers\PraticienController@updateSpecialite');

// Route pour traiter la soumission du formulaire de modification de spécialité du praticien
Route::post('/postmodifierSpecialite/{id_praticien}', 'App\Http\Controllers\PraticienController@postmodificationSpecialite')->name('postmodifierSpecialite');

// Route pour afficher le formulaire de choix de spécialité à modifier
Route::get('/ModifSpePraticien', 'App\Http\Controllers\PraticienController@deroulantupdateSpecialite');

// supprimer

// Route pour afficher le formulaire de suppression de spécialité du praticien
Route::get('/supprimerSpecialite/{id_praticien}', 'App\Http\Controllers\PraticienController@formulaireSuppressionSpecialite');

// Route pour traiter la soumission du formulaire de suppression de spécialité du praticien
Route::post('/postSuppressionSpecialite/{id_praticien}', 'App\Http\Controllers\PraticienController@postSuppressionSpecialite')->name('postSuppressionSpecialite');
