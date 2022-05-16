<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotpassword()
    {
    	// Afficher reinitpage
        return view('auth.forgotpassword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reinitPage()
    {
    	// Afficher reinitpage
        return view('auth.reinitPage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {

        // Recuperer le code secret
        $code_secret = $request->input('code_secret');

        // Recuperer l'utilisateur qui possède ce numéro
        $utilisateur = User::where('code_secret', $code_secret)->first();

        // Verification
        if($utilisateur){

	        // Recuperer les mots de passe
        	$password = $request->input('password');
        	$new_password = $request->input('new_password');

        	// Verification sur les mots de passe
        	if($password == $new_password){

        		// Mettre à jour le mot de passe de l'utilisateur
		        $utilisateur->password = Hash::make($request->input('password'));

		        // Sauvegarder les modifications
		        if($utilisateur->save()){

	        		// redirection vers page de réinitialisation
	        		return redirect()->route('login')->with('success', 'Hello Mr/Mme ' . $utilisateur->name . ', votre mot de passe a été modifié avec succès. veuillez vous connecter svp !');;

		        } 
	        	return redirect()->back()->with('failed', 'Une érreur s\'est produite lors de la modification de votre mot de passe. veuillez réessayer svp !');

        	}
        	return redirect()->back()->with('failed', 'Les mots de passe ne sont pas identiques. veuillez réessayer svp !');

        }
        return redirect()->back()->with('failed', 'Code secret non valide. veuillez réessayer svp !');
    }
}
