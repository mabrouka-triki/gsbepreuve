<?php

namespace App\dao;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Hash;

/*
 * Authentifie Le visiteur sur son Login et Mdp
 * Si c'est OK, son id est enregistrer dans La session
 * Cela lui donne accès au menu général (voir page master)
 * @param  type $login : Login du visiteur
 * @paran  type $pwd : Mdp du visiteur
 * @return boolean : True or false
 */

class ServiceVisiteur
{
    public function login($login, $pwd)
    {
        $connected = false;
        try {
            $visiteur = DB::table('visiteur')
                ->select()
                ->where('login_visiteur', '=', $login)
                ->first();

            if($visiteur && Hash::check($pwd, $visiteur->pwd_visiteur)) {
                    Session::put('id', $visiteur->id_visiteur);
                    Session::put('type', $visiteur->type_visiteur);
                    $connected = true;
                }
        } catch (QueryException $e) {
            echo $e->getMessage();
            throw new MonException($e->getMessage(), 5);
        }
        return $connected;
    }
    public function logout(){

        session::put('id',0);

    }

}
