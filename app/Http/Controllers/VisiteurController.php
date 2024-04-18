<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\dao\ServiceVisiteur;
use MonException;
class VisiteurController extends Controller
{
    public function signIn(Request $request)
    {
        try {
            $login = $request->input('login');
            $pwd = $request->input('pwd');

            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                if (session()->get('type') === 'p') {
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
        return view('Vues/formLogin');
    }

}
