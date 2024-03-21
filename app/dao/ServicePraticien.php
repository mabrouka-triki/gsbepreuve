<?php

namespace App\dao;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;

class ServicePraticien{



    public function getPraticiens()
    {
        try {
            $mesPraticiens = DB::table('praticien')
                ->join('posseder', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                ->join('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->select('praticien.id_praticien', 'praticien.nom_praticien', 'praticien.prenom_praticien', 'praticien.cp_praticien', 'specialite.lib_specialite')
                ->get();
            return $mesPraticiens;
        } catch (QueryException $e) {
            throw new MonException("Erreur lors de la récupération des praticiens : " . $e->getMessage(), 5);
        }
    }

    public function getById($id_praticien)
    {
        try {
            $praticien = DB::table('praticien')
                ->select()
                ->where('id_praticien', '=', $id_praticien)
                ->first();
            return $praticien;
        } catch (QueryException $e) {
            throw new MonException("Erreur lors de la récupération du praticien : " . $e->getMessage(), 5);
        }
    }
    public function ajouterSpecialiteAuPraticien($praticienId, $specialiteId)
    {
        $posseder = DB::table('posseder');
        $posseder->id_praticien = $praticienId;
        $posseder->id_specialite = $specialiteId;
        $posseder->save();
        return $posseder;
    }

}
