<?php

namespace App\dao;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;

class ServicePraticien
{
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
    public function insertSpecialite($praticienId, $specialiteId, $diplome, $coefPrescription)
    {
        try {
            DB::table('posseder')->insert([
                'id_praticien' => $praticienId,
                'id_specialite' => $specialiteId,
                'diplome' => $diplome,
                'coef_prescription' => $coefPrescription,
            ]);
        } catch (QueryException $e) {
            throw new MonException("Erreur lors de l'insertion de la spécialité : " . $e->getMessage());
        }
    }

    public function getAllPraticiens()
    {
        try {
            $praticiens = DB::table('praticien')
                ->select('id_praticien', 'nom_praticien', 'prenom_praticien')
                ->get();
            return $praticiens;
        } catch (\Exception $e) {
            throw new MonException("Erreur lors de la récupération des praticiens : " . $e->getMessage(), 5);
        }
    }

    public function getAllSpecialites()
    {
        try {
            $specialites = DB::table('specialite')
                ->select('id_specialite', 'lib_specialite')
                ->get();
            return $specialites;
        } catch (\Exception $e) {
            throw new MonException("Erreur lors de la récupération des spécialités : " . $e->getMessage(), 5);
        }
    }
}

