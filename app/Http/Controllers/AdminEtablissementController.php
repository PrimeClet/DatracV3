<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\MedicamentEtablissements;
use App\Models\ExamenEtablissements;
use App\Models\PrestationEtablissements;
use App\Models\AppareillageEtablissements;
use App\Models\Prestations;
use App\Models\Etablissements;
use App\Models\Medicament;
use App\Models\Examens;
use App\Models\Appareillages;
use App\Models\Specialites;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminEtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashAdminEtablissement(Request $request)
    {

    	$page_title = "Tableau de bord";

    	$user_id = Auth::user()->id;
        $adminetablissement_id = Auth::user()->etablissement_id;
    	$adminetablissement = User::find($user_id);
        $adminetab = Etablissements::find($adminetablissement_id);

        // Count users
        $count_users = User::where('role', 'ManagerEtablissement')
        ->orWhere('role', 'ComptableEtablissement')
        ->orWhere('role', 'TiersPayantEtablissement')
        ->orWhere('role', 'CaisseEtablissement')
        ->orWhere('role', 'PharmacienEtablissement')
        ->orWhere('role', 'PraticienEtablissement')
        ->orWhere('role', 'InfirmierEtablissement')
        ->orWhere('role', 'LaborantinEtablissement')
        ->get()->count();

        // Count examens
        $count_examens = ExamenEtablissements::all()->count();

        // Count prestations
        $count_prestations = PrestationEtablissements::all()->count();

        // Count appareillages
        $count_appareillages = AppareillageEtablissements::all()->count();

        // Count affections
        $count_medicaments = MedicamentEtablissements::all()->count();

	    return view('backend.adminetablissement.dashAdminEtablissement', compact('page_title', 'count_users', 'adminetab', 'count_examens', 'count_appareillages', 'count_medicaments', 'count_prestations'));

    }

         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfExistsEmail($email)
    {

        // Chercher l'utilisateur' correspondant à cet email
        $email_exists = User::where('email', $email)->first();

        // Retourner le resultat
        return $email_exists;

    }


        	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  DASH ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashAdminEtablissementAgents(Request $request)
    {

    	$page_title = "Nos Agents";

    	$users = User::where('etablissement_id', Auth::user()->etablissement_id)
                        ->Where(function ($query) {
                            $query->where('role', 'ManagerEtablissement')
                            ->orWhere('role', 'ComptableEtablissement')
                            ->orWhere('role', 'TiersPayantEtablissement')
                            ->orWhere('role', 'CaisseEtablissement');
                        })->get();

       // dd($users); 
        $etablissements = Etablissements::all();

        return view('backend.adminetablissement.dashAdminEtablissementAgents', compact('page_title', 'users', 'etablissements'));

    }

    public function dashAdminEtablissementPraticiens(Request $request)
    {

    	$page_title = "Nos Praticiens";

    	$users = User::where('etablissement_id', Auth::user()->etablissement_id)
                        ->Where(function ($query) {
                            $query->where('role', 'PharmacienEtablissement')
                            ->orWhere('role', 'PraticienEtablissement')
                            ->orWhere('role', 'InfirmierEtablissement')
                            ->orWhere('role', 'LaborantinEtablissement');
                        })->get();

        $etablissements = Etablissements::all();
        $specialites = Specialites::all();

        return view('backend.adminetablissement.dashAdminEtablissementAgents', compact('page_title', 'users', 'etablissements', 'specialites'));

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashAdminEtablissementMedicaments(Request $request)
    {

    	$page_title = "Nos Medicaments";

    	$medicamentEtablissements = MedicamentEtablissements::all();
        $medicaments = Medicament::all();

        return view('backend.adminetablissement.dashAdminEtablissementMedicaments', compact('page_title', 'medicamentEtablissements','medicaments'));

    }

    public function dashAdminEtablissementPrestations(Request $request)
    {

    	$page_title = "Nos Prestations";

    	$prestationEtablissements = PrestationEtablissements::all();
        $prestations = Prestations::all();

        return view('backend.adminetablissement.dashAdminEtablissementPrestations', compact('page_title', 'prestationEtablissements','prestations'));

    }

    public function dashAdminEtablissementExamens(Request $request)
    {

    	$page_title = "Nos Examens";

    	$examenEtablissements = ExamenEtablissements::all();
        $examens = Examens::all();

        return view('backend.adminetablissement.dashAdminEtablissementExamens', compact('page_title', 'examenEtablissements','examens'));

    }

    public function dashAdminEtablissementAppareillages(Request $request)
    {

    	$page_title = "Nos Appareillages";

    	$appareillageEtablissements = AppareillageEtablissements::all();
        $appareillages = Appareillages::all();

        return view('backend.adminetablissement.dashAdminEtablissementAppareillages', compact('page_title', 'appareillageEtablissements','appareillages'));

    }

    
    	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAgentAdminEtablissement(Request $request)
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
            $new_user->codeAgent = $request->input('codeAgent');
            $new_user->email = $request->input('email'); 
            $new_user->telephone = $request->input('telephone');
            $new_user->adresse = $request->input('adresse');
            $new_user->role = $request->input('role');
            $new_user->etablissement_id = Auth::user()->etablissement_id;    
            $new_user->password = Hash::make($request->input('password'));
            $new_user->api_token = Str::random(100);
            $new_user->active = 1;

            if ($request->file('file') !== null) {
                $file = $request->file('photo_url');
    
                if ($request->hasFile('photo_url')) {
                    $path = public_path('assets/photos/agents/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();
    
                    $location = '/photos/agents/'. $filename;
                    $file->move($path, $filename);
                    $new_user->photo_url = $location;
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

    public function newPraticienAdminEtablissement(Request $request)
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
            $new_user->codeAgent = $request->input('codeAgent');
            $new_user->email = $request->input('email'); 
            $new_user->telephone = $request->input('telephone');
            $new_user->adresse = $request->input('adresse');
            $new_user->role = $request->input('role');
            $new_user->specialite_id = $request->input('specialite_id');
            $new_user->etablissement_id = Auth::user()->etablissement_id;    
            $new_user->password = Hash::make($request->input('password'));
            $new_user->api_token = Str::random(100);
            $new_user->active = 1;

            if ($request->file('photo_url') !== null) {
                $file = $request->file('photo_url');
    
                if ($request->hasFile('photo_url')) {
                    $path = public_path('assets/photos/agents/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();
    
                    $location = '/photos/agents/'. $filename;
                    $file->move($path, $filename);
                    $new_user->photo_url = $location;
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


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newMedicamentAdminEtablissement(Request $request)
    {

        $new_medicament = new MedicamentEtablissements();

    	// Get new data 
        $new_medicament->tarif_structure = $request->input('tarif_structure');
        $new_medicament->medicament_id = $request->input('medicament_id');

        if($new_medicament->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Medicament crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Medicament !');

    }

    public function newPrestationAdminEtablissement(Request $request)
    {

        $new_prestation = new PrestationEtablissements();

    	// Get new data 
        $new_prestation->tarif_structure = $request->input('tarif_structure');
        $new_prestation->prestation_id = $request->input('prestation_id');

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prestation crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prestation !');

    }

    public function newExamenAdminEtablissement(Request $request)
    {

        $new_examen = new ExamenEtablissements();

    	// Get new data 
        $new_examen->tarif_structure = $request->input('tarif_structure');
        $new_examen->examen_id = $request->input('examen_id');

        if($new_examen->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Examen crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Examen !');

    }

    public function newAppareillageAdminEtablissement(Request $request)
    {

        $new_appareillage = new AppareillageEtablissements();

    	// Get new data 
        $new_appareillage->tarif_structure = $request->input('tarif_structure');
        $new_appareillage->appareillage_id = $request->input('appareillage_id');

        if($new_appareillage->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Appareillage crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Appareillage !');

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMedicamentAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Medicament";

    	$medicamentEtablissement = MedicamentEtablissements::find($id);

        return view('backend.adminetablissement.showMedicamentAdminEtablissement', compact('medicamentEtablissement', 'page_title'));

    }

    public function showPrestationAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestation";

    	$prestationEtablissement = PrestationEtablissements::find($id);

        return view('backend.adminetablissement.showPrestationAdminEtablissement', compact('prestationEtablissement', 'page_title'));

    }

    public function showExamenAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Examen";

    	$examenEtablissement = ExamenEtablissements::find($id);

        return view('backend.adminetablissement.showExamenAdminEtablissement', compact('examenEtablissement', 'page_title'));

    }

    public function showAppareillageAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Appareillage";

    	$appareillageEtablissement = AppareillageEtablissements::find($id);

        return view('backend.adminetablissement.showAppareillageAdminEtablissement', compact('appareillageEtablissement', 'page_title'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMedicamentAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Medicament";

    	$medicamentEtablissement = MedicamentEtablissements::find($id);

        return view('backend.adminetablissement.editMedicamentAdminEtablissement', compact('medicamentEtablissement', 'page_title'));

    }

    public function editPrestationAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestationEtablissement = PrestationEtablissements::find($id);

        return view('backend.adminetablissement.editPrestationAdminEtablissement', compact('prestationEtablissement', 'page_title'));

    }

    public function editExamenAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Examen";

    	$examenEtablissement = ExamenEtablissements::find($id);

        return view('backend.adminetablissement.editExamenAdminEtablissement', compact('examenEtablissement', 'page_title'));

    }

    public function editAppareillageAdminEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Appareillage";

    	$appareillageEtablissement = AppareillageEtablissements::find($id);

        return view('backend.adminetablissement.editAppareillageAdminEtablissement', compact('appareillageEtablissement', 'page_title'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                              #
    #                                                                                            #
    ##############################################################################################


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function updateAgentAdminEtablissement(Request $request)
    {
        // Recuperer l'utilisateur correspondante
        $utilisateur = User::find($request->input('id'));

        // Verification email
        if($request->input('password') != $request->input('confirm_password')){

            // Redirection
            return redirect()->back()->with('failed', 'Les mots de passe ne sont pas identiques !');

        }

        // Préparer la requete
        $utilisateur->name = $request->input('name');
        $utilisateur->codeAgent = $request->input('codeAgent');
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->role = $request->input('role');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->etablissement_id = Auth::user()->etablissement_id;
        $utilisateur->password = Hash::make($request->input('password'));

        if ($request->file('photo_url') !== null) {
            $file = $request->file('photo_url');

            if ($request->hasFile('photo_url')) {
                $path = public_path('assets/photos/agents/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/agents/'. $filename;
                $file->move($path, $filename);
                $utilisateur->photo_url = $location;
            }
        }

        // Sauvegarde
        if($utilisateur->save()){

            // Redirection
            return redirect()->back()->with('success', 'Utilisateur modifié avec succès !');
        }
        return redirect()->back()->with('failed', 'Impossible de modifier cet utilisateur !');
    }
    
        
    public function updatePraticienAdminEtablissement(Request $request)
    {
        // Recuperer l'utilisateur correspondante
        $utilisateur = User::find($request->input('id'));

        // Verification email
        if($request->input('password') != $request->input('confirm_password')){

            // Redirection
            return redirect()->back()->with('failed', 'Les mots de passe ne sont pas identiques !');

        }

        // Préparer la requete
        $utilisateur->name = $request->input('name');
        $utilisateur->codeAgent = $request->input('codeAgent');
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->role = $request->input('role');
        $utilisateur->specialite_id = $request->input('specialite_id');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->etablissement_id = Auth::user()->etablissement_id;
        $utilisateur->password = Hash::make($request->input('password'));

        if ($request->file('photo_url') !== null) {
            $file = $request->file('photo_url');

            if ($request->hasFile('photo_url')) {
                $path = public_path('assets/photos/agents/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/agents/'. $filename;
                $file->move($path, $filename);
                $utilisateur->photo_url = $location;
            }
        }

        // Sauvegarde
        if($utilisateur->save()){

            // Redirection
            return redirect()->back()->with('success', 'Utilisateur modifié avec succès !');
        }
        return redirect()->back()->with('failed', 'Impossible de modifier cet utilisateur !');
    }

     public function updateMedicamentAdminEtablissement(Request $request)
    {

    	$medicamentEtablissement_id = $request->input('medicamentEtablissement_id');
    	$new_medicament = MedicamentEtablissements::find($medicamentEtablissement_id);

    	// Get new data 
        $new_medicament->tarif_structure = $request->input('tarif_structure');
        $new_medicament->medicament_id = $request->input('medicament_id');

        if($new_medicament->save()){

            // Redirection
            return redirect()->back()->with('success', 'Medicament modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet Medicament !');

    }

    public function updatePrestationAdminEtablissement(Request $request)
    {

    	$prestationEtablissement_id = $request->input('prestationEtablissement_id');
    	$new_prestation = PrestationEtablissements::find($prestationEtablissement_id);

    	// Get new data 
        $new_prestation->tarif_structure = $request->input('tarif_structure');
        $new_prestation->medicament_id = $request->input('prestation_id');

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'prestation modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cette prestation !');

    }

    public function updateExamenAdminEtablissement(Request $request)
    {

    	$examenEtablissement_id = $request->input('examenEtablissement_id');
    	$new_examen = ExamenEtablissements::find($examenEtablissement_id);

    	// Get new data 
        $new_examen->tarif_structure = $request->input('tarif_structure');
        $new_examen->medicament_id = $request->input('examen_id');

        if($new_examen->save()){

            // Redirection
            return redirect()->back()->with('success', 'examen modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet examen !');

    }

    public function updateAppareillageAdminEtablissement(Request $request)
    {

    	$appareillageEtablissement_id = $request->input('appareillageEtablissement_id');
    	$new_appareillage = AppareillageEtablissements::find($appareillageEtablissement_id);

    	// Get new data 
        $new_appareillage->tarif_structure = $request->input('tarif_structure');
        $new_appareillage->medicament_id = $request->input('appareillage_id');

        if($new_appareillage->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }



}