<?php

namespace App\Http\Controllers;

use App\User;

use App\File;
use App\Models\Assurance;
use App\Models\TypeAssures;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AssureController extends Controller
{
    
    public function checkIfExistsEmail($email)
    {

        // Chercher l'utilisateur' correspondant à cet email
        $email_exists = User::where('email', $email)->first();

        // Retourner le resultat
        return $email_exists;

    }

    /**
     * Display a listing of the resource.
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function dashAdminAssuranceAssures(Request $request)
    {

    	$page_title = "Nos Assurés";

        $users = User::where('assurance_id', Auth::user()->assurance_id)
                        ->Where(function ($query) {
                            $query->where('role', 'Assure');
                        })->get();

        $typeassures = TypeAssures::where('assurance_id', Auth::user()->assurance_id)->get();

        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceAssures', compact('page_title', 'users', 'typeassures', 'assurances'));

    }

    /**
     * Display a listing of the resource.
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function updateAssureAdminAssurance(Request $request)
    {
        // Recuperer l'utilisateur correspondante
        $utilisateur = User::find($request->input('id'));

        // Verification email
        if($request->input('password') != $request->input('confirm_password')){

            // Redirection
            return redirect()->back()->with('failed', 'Les mots de passe ne sont pas identiques !');

        }
//        dd($new_ass);
        $filename = '';

        // Get new data
        $utilisateur->name = $request->input('name');
        $utilisateur->type_assure_id = $request->input('type_assure_id');
        $utilisateur->email = $request->input('email');
        $utilisateur->datenaiss = $request->input('datenaiss');
        $utilisateur->numero_assure = $request->input('numero_assure');     
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->assurance_id = Auth::user()->assurance_id;    
        $utilisateur->password = Hash::make($request->input('password'));

        if ($request->file('picass') !== null) {
            $file = $request->file('picass');

            if ($request->hasFile('picass')) {
                $path = public_path('assets/photos/agents/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('nom'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/agents/'. $filename;
                $file->move($path, $filename);
                $utilisateur->photo_url = $location;
            }
        }

        if ($request->file('picass') !== null) {
            $file = $request->file('picass');

            if ($request->hasFile('picass')) {
                $path = public_path('assets/photos/agents/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('nom'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/agents/'. $filename;
                $file->move($path, $filename);
                $utilisateur->signature_patient = $location;
            }
        }

        if($utilisateur->save()){
            // Redirection
            return redirect()->back()->with('success', 'Acte modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet acte !');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAssureAdminAssurance(Request $request)
    {
        // Verifier si les mots de passe sont identiques
        if($request->input('password') == $request->input('confirm_password')){    

            $new_user = new User();

            // Verification email
            if($this->checkIfExistsEmail($request->input('email')) && $request->input('email') != $new_user->email){

                // Redirection
                return redirect()->back()->with('failed', 'Cet email existe déjà dans la base de données !');

            }

            // Get new data 
            $new_user->name = $request->input('name');
            $new_user->type_assure_id = $request->input('type_assure_id');
            $new_user->email = $request->input('email');
            $new_user->datenaiss = $request->input('datenaiss');
            $new_user->numero_assure = $request->input('numero_assure'); 
            $new_user->telephone = $request->input('telephone');
            $new_user->adresse = $request->input('adresse');
            $new_user->role = $request->input('role');
            $new_user->assurance_id = Auth::user()->assurance_id;    
            $new_user->password = Hash::make($request->input('password'));
            $new_user->api_token = Str::random(100);
            $new_user->active = 1;

            if ($request->file('picass') !== null) {
                $file = $request->file('picass');
    
                if ($request->hasFile('photo_url')) {
                    $path = public_path('assets/photos/agents/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();
    
                    $location = '/photos/agents/'. $filename;
                    $file->move($path, $filename);
                    $new_user->photo_url = $location;
                }
            }
            
            if ($request->file('picass') !== null) {
                $file = $request->file('picass');

                if ($request->hasFile('signature_patient')) {
                    $path = public_path('assets/photos/agents/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                    $location = '/photos/agents/'. $filename;
                    $file->move($path, $filename);
                    $new_user->signature_patient = $location;
                }
            }

            if($new_user->save()){

                // Redirection
                return redirect()->back()->with('success', 'Nouveau compte crée avec succès !');
            }

            // Redirection
            return redirect()->back()->with('failed', 'Impossible de créer ce nouveau compte !');
         }
    }
}