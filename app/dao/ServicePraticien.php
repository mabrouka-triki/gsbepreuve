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
            $mesPraticiens = DB::table('posseder')
                ->join('praticien', 'posseder.id_praticien', '=', 'praticien.id_praticien')
                ->join('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->select('praticien.nom_praticien', 'praticien.prenom_praticien', 'praticien.id_praticien', DB::raw('GROUP_CONCAT(specialite.lib_specialite SEPARATOR ", ") AS specialites'))
                ->groupBy('praticien.id_praticien', 'praticien.nom_praticien', 'praticien.prenom_praticien') // Inclure les colonnes non agrégées dans GROUP BY
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
    public function insertSpecialite($diplome, $coef_prescription, $id_praticien, $id_specialite)
    {

        try {
            DB::table('posseder')->insert(
                ['diplome' => $diplome,
                    'coef_prescription' => $coef_prescription,
                    'id_praticien' => $id_praticien,
                    'id_specialite' => $id_specialite,
                ]
            );

        } catch (QueryException $e) {

            echo $e->getMessage();

            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deroulantinsertSpecialites()
    {
        try {
            $praticiens = DB::table('praticien')
                ->select('id_praticien', DB::raw("CONCAT(id_praticien, ' - ', nom_praticien, ' ', prenom_praticien) AS full_name"))
                ->get();
            $specialites = DB::table('specialite')
                ->select('id_specialite', DB::raw("CONCAT(lib_specialite) AS full_name"))
                ->get();

            return [
                'praticiens' => $praticiens,
                'specialites' => $specialites,
            ];
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


    public function verifierSpecialitePraticien($id_praticien, $id_specialite)
    {
        // pour  Vérifier  si le praticien a déjà cette spécialité
        $specialiteExistante = DB::table('posseder')
            ->where('id_praticien', $id_praticien)
            ->where('id_specialite', $id_specialite)
            ->exists();

        return $specialiteExistante;
    }


    //modifier
    public function updateSpecialites($id_specialite, $id_praticien, $nouvelspe)
    {
        try {
            DB::table('posseder')
                ->where('id_specialite', $id_specialite)
                ->where('id_praticien', $id_praticien)
                ->update(['id_specialite' => $nouvelspe]);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getSpecialite($id_praticien)
    {
        try {
            $uneSpecialite = DB::table('praticien')
                ->select()
                ->where('id_praticien', '=', $id_praticien)
                ->first();
            return $uneSpecialite;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deroulantupdateSpecialites()
    {
        try {
            $praticiens = DB::table('praticien')
                ->select('id_praticien', DB::raw("CONCAT(id_praticien, ' - ', nom_praticien, ' ', prenom_praticien) AS full_name"))
                ->get();

            $specialites = DB::table('posseder')
                ->join('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
                ->select('posseder.id_praticien', 'specialite.id_specialite', DB::raw("CONCAT(lib_specialite) AS full_name"))
                ->get()
                ->groupBy('id_praticien');

            $toutesSpecialites = DB::table('specialite')
                ->select('id_specialite', DB::raw("CONCAT(lib_specialite) AS full_name"))
                ->get();

            return compact('praticiens', 'specialites', 'toutesSpecialites');
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    //supprimer

    public function supprimerSpecialite($id_praticien, $id_specialite)
    {
        try {
            DB::table('posseder')
                ->where('id_specialite', $id_specialite)
                ->where('id_praticien', $id_praticien)
                ->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}

