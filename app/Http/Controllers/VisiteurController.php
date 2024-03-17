<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;
use Exception;


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
                return view('Vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            // Traitez l'exception ici
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        }
    }


    public function getLogin()
    {
        try {
            $erreur = "";
            return view('Vues/formLogin', compact('erreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        }
    }

    public function singOut()
    {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }



}
