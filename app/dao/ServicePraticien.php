<?php

namespace App\dao;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;

class ServicePraticien
{

    //Liste
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


    //Recherche par nom de praticien
    public function recherchePraticienParNom($nomPraticien)
    {
        try {
            $praticiens = DB::table('praticien')
                ->join('posseder', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                ->join('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->where('praticien.nom_praticien', 'LIKE', "%$nomPraticien%")
                ->select('praticien.nom_praticien', DB::raw('MAX(praticien.prenom_praticien) as prenom_praticien'), 'specialite.lib_specialite')
                ->groupBy('praticien.nom_praticien', 'specialite.lib_specialite') // Inclure specialite.lib_specialite dans GROUP BY
                ->get();

            return $praticiens;
        } catch (QueryException $e) {
            throw new MonException("Erreur : " . $e->getMessage());
        }
    }


    // Ajoute de specialite
    public function insertSpecialites($diplome,$coef_prescription, $id_praticien, $id_specialite )
    {
        try {
            DB::table('posseder')->insert(
                ['diplome' => $diplome,
                    'coef_prescription' => $coef_prescription,
                    'id_praticien'=> $id_praticien,
                    'id_specialite'=> $id_specialite,
                ]
            );
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


}

