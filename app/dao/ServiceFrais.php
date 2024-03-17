<?php

namespace App\dao;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;

class ServiceFrais
{
    public function getFrais($id_visiteur)
    {
        try {
            $lesFrais = DB::table('frais')
                ->select()
                ->where('frais.id_visiteur', '=', $id_visiteur)
                ->get();
            return $lesFrais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function getById($id_frais)
    {
        try {
            $frais = DB::table('frais')
                ->select()
                ->where('id_frais', '=', $id_frais)
                ->first();
            return $frais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }



    public function updateFrais($id_frais,$anneemois,$nbjustificatifs){

        try {
            $dateJour =date("y-m-d");
            DB::table('frais')
                ->select()
                ->where('id_frais', '=', $id_frais)
                ->update(['anneemois'=>$anneemois,'nbjustificatifs'=>$nbjustificatifs,
                    'datemodification'=>$dateJour,]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function insertFrais($anneemois,$nbjustificatifs,$id_visiteur){

        try {
            DB::table('frais')->insert(
                [
                    'anneemois'=>$anneemois,
                    'nbjustificatifs'=>$nbjustificatifs,
                    'id_etat'=>2,
                    'id_visiteur'=>$id_visiteur,
                    'montantValide'=>0
                ]
            );

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteFrais($id_frais)
    {
        try {
            DB::table('fraishorsforfait')
                ->where('id_frais', '=', $id_frais)->delete();
            DB::table('frais')
                ->where('id_frais', '=', $id_frais)->delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getHorsFrais($idFrais)
    {
        try {
            $unHorsFrais = DB::table('fraishorsforfait')
                ->select()
                ->where('fraishorsforfait.idFrais', '=', $idFrais)
                ->get();
            return $unHorsFrais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
