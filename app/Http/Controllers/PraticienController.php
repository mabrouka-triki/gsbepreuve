<?php

namespace App\Http\Controllers;
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

    public function ajouterSpecialite(Request $request, $praticienId)
    {
        // Valider les données du formulaire
        $request->validate([
            'specialite_id' => 'required|exists:specialites,id',
        ]);

        // Trouver le praticien
        $praticien = Praticien::findOrFail($praticienId);

        // Créer une nouvelle instance de la relation posseder
        $posseder = new Posseder();
        $posseder->id_praticien = $praticienId;
        $posseder->id_specialite = $request->specialite_id;
        $posseder->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Spécialité ajoutée avec succès au praticien.');
    }

}



