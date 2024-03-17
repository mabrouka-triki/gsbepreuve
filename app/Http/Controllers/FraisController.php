<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\dao\ServiceFrais;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;


class FraisController extends Controller
{
    public function getFraisVisiteur()
    {
        try {
            $erreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceFrais = new ServiceFrais();
            $id_visiteur = Session::get('id');
            $mesFrais = $unServiceFrais->getFrais($id_visiteur);
            $erreur = '';
            return view('Vues/listeFrais', compact('mesFrais', 'erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }

    public function validateFrais()
    {
        try {
            $id_frais = Request::input('id_frais');
            $anneemois = Request::input('anneemois');
            $nbjustificatifs = Request::input('nbjustificatifs');
            $unServiceFrais = new ServiceFrais();

            if ($id_frais > 0) {
                $unServiceFrais->updateFrais($id_frais, $anneemois, $nbjustificatifs);

            } else {
                $montant = Request::input('montant');
                $id_visiteur = Session::get('id');
                $unServiceFrais->insertFrais($anneemois, $nbjustificatifs, $id_visiteur, $montant);
            }

            return redirect('/listeFrais');
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }


    public function addFrais()
    {
        try {

            $erreur = "";
            $titreVue = "Ajout d'une fiche de frais";
            $unFrais="";

            return view('Vues/ajoutFrais', compact('unFrais', 'titreVue', 'erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/monerror', compact('erreur'));
        } catch (Exception $e) {

            $erreur = $e->getMessage();
            return view('Vues/monerror', compact('erreur'));
        }
    }



    public function updateFrais($id_frais)
    {
        try {
            $erreur="";

            $unServiceFrais = new ServiceFrais();

            $unFrais =  $unServiceFrais -> getById($id_frais);
            $titreVue = "Modification d'une fiche de frais";
            return view('Vues/formFrais', compact('unFrais', 'titreVue', 'erreur'));
        } catch (MonException $e) {
            $erreur  = $e->getMessage();
            return view('vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


    public function ValideFraisHorsForfait()
    {
        try {
            $id_frais = Request::input("id_frais");
            $anneemois = Request::input("anneemois");
            $nbjustificatifs = Request::input("nbjustificatif");
            $unServiceFrais = new ServiceFrais();
            if($id_frais >0){
                $unServiceFrais ->updateFrais($id_frais,$anneemois,$nbjustificatifs);
            }else{
                $montant = Request::input("montant");
                $id_visiteur = Session::get("id");
                $unServiceFrais->insertFrais($anneemois,$nbjustificatifs,$id_visiteur,$montant);
            }
            return redirect('/listeFrais');
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/monerror', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/monerror', compact('erreur'));

        }
    }




    public function supprimerFrais($id_frais)
    {
        try {

            $unServiceFrais = new ServiceFrais();
            $unServiceFrais->deleteFrais($id_frais);

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            Session::put('erreur', 'Impossible de supprimer une fiche ayant des Frais Hors Forfait');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            Session::put('erreur', 'Impossible de supprimer une fiche');
        } finally {
            return redirect('/getlisteFrais');
        }
    }



}
