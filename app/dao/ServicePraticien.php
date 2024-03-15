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
                ->select()
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
}
