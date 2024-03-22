<?php

namespace App\Http\Controllers;
use App\dao\ServiceFrais;
use Illuminate\Support\Facades\DB;
use App\dao\ServicePraticien;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;
class PraticienController
{
    public function getPraticien()
    {
        try {
            $erreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServicePraticiens = new ServicePraticien();
            $mesPraticiens = $unServicePraticiens->getPraticiens();
            $erreur = '';
            return view('Vues/listePraticiens', compact('mesPraticiens', 'erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }






    public function addSpecialite(Request $request) //
    {
        try {
            $praticienId = request::input('id_praticien'); // Modifier pour récupérer les valeurs des champs correctement
            $specialiteId = request::input('id_specialite');
            $diplome = request::input('diplome');
            $coefPrescription = request::input('coef_prescription');

            $unServicePraticien = new ServicePraticien();
            $unServicePraticien->insertSpecialite($praticienId, $specialiteId, $diplome, $coefPrescription);

            return redirect('/listePraticiens')->with('success', 'Spécialité ajoutée avec succès.');
        } catch (\Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
}





