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


    public function addSpecialite()
    {
        try {

            $praticienId = request::input('id_praticien');
            $specialiteId = request::input('id_specialite');
            $diplome = request::input('diplome');
            $coefPrescription = request::input('coef_prescription');

            if ($praticienId === null) {
                throw new \Exception("Veuillez sélectionner un praticien.");
            }

            $unServicePraticien = new ServicePraticien();
            $unServicePraticien->insertSpecialite($praticienId, $specialiteId, $diplome, $coefPrescription);


            return view('Vues/addSpePraticien')->with('success', 'Spécialité ajoutée avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, retourner à la vue avec un message d'erreur
            return view('Vues/error')->with('error', $e->getMessage());
        }
    }



    public function updateSpecialite($id_Praticien)
    {
        try {
            // Instancier le service Praticien
            $servicePraticien = new ServicePraticien();

            // Obtenir les détails du praticien par son ID
            $praticien = $servicePraticien->getById($id_Praticien);

            // Obtenir toutes les spécialités pour afficher dans la liste déroulante
            $specialites = $servicePraticien->getAllSpecialite();

            // Passer les données récupérées à la vue du formulaire de modification
            return view('Vues/modifierSpePraticien', compact('praticien', 'specialites'));

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }





    public function rechercherPraticien()
    {
        $nomPraticien = request::input('nom_praticien');

        $servicePraticien = new ServicePraticien();
        $praticiens = $servicePraticien->recherchePraticienParNom($nomPraticien);

        return view('vues/rechercherPraticien', compact('praticiens'));
    }
}


