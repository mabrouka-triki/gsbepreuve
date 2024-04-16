<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;

class VisiteurController extends Controller
{
    public function signIn()
    {
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');

            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') === 'p') {
                    return view('home');
                } else {
                    return view('home');
                }
            } else {
                $erreur = "Login ou mot de passe inconnu !!";
                return view('vues.formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.formLogin', compact('erreur'));
        }
    }

    public function getLogin()
    {
        try {
            $erreur = "";
            return view('vues.formLogin', compact('erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues.formLogin', compact('erreur'));
        }
    }

    public function signOut()
    {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }
}
