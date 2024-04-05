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

    // pour lister
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




// Rechercher par nom de praticien  , qu'il va nous affixher son prenom
// et specialite

    public function rechercherPraticien()
    {
        $nomPraticien = request::input('nom_praticien');

        $servicePraticien = new ServicePraticien();
        $praticiens = $servicePraticien->recherchePraticienParNom($nomPraticien);

        return view('vues/rechercherPraticien', compact('praticiens'));
    }


    //ajout
    public function insertSpecialite()
    {

        try {
            $diplome = Request::input("diplome");
            $id_specialite = Request::input("id_specialite");
            $id_praticien = Request::input("id_praticien");
            $coef_prescription = Request::input("coef_prescription");

            // pour  Vérifier si le praticien a déjà cette spécialité
            $servicePraticien = new ServicePraticien();
            $specialiteExistante = $servicePraticien->verifierSpecialitePraticien($id_praticien, $id_specialite);
            if ($specialiteExistante) {
                return redirect()->back()->with('error', 'Le praticien a déjà cette spécialité.');
            }

            // Insérer la spécialité si le praticien n'a pas déjà cette spécialité
            $servicePraticien->insertSpecialite($diplome, $coef_prescription, $id_praticien, $id_specialite);

            // Retourner une réponse de réussite ou rediriger vers une autre page si nécessaire
            return redirect()->route('home')->with('success', 'Spécialité ajoutée avec succès.');

        } catch (MonException $e) {
            return view('vues/error', ['monErreur' => $e->getMessage()]);
        } catch (Exception $e) {
            return view('vues/error', ['monErreur' => $e->getMessage()]);
        }
    }


    public function deroulantinsertSpecialite()
    {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $uneSpecialite = new ServicePraticien();
            $mesSpecialites = $uneSpecialite->deroulantinsertSpecialites();
            return view('vues/addSpePraticien', compact('mesSpecialites', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }


// Pour modifier une specialite on recupere le nom et prenom et il va nous afficher la
//specialité choisie et on selectionne la spe qu'on souhaite modifier


    public function updateSpecialite($id_praticien)
    {
        try {
            $servicePraticien = new ServicePraticien(); // Instanciation du service pour manipuler les praticiens
            $praticien = $servicePraticien->getById($id_praticien); // Récupération du praticien par son ID

            $specialitesDisponibles = ["Spécialité 1", "Spécialité 2", "Spécialité 3"]; // Liste des spécialités disponibles

            // Vous pouvez également récupérer les spécialités disponibles depuis la base de données ou toute autre source

            $titreVue = "Modification de la spécialité d'un praticien";
            return view('vues/ModifSpePraticien', compact('praticien', 'titreVue', 'specialitesDisponibles'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
}



