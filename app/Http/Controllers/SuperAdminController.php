<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Models\Actes;
use App\Models\Examens;
use App\Models\Villes;
use App\Models\Provinces;
use App\Models\Specialites;
use App\Models\Appareillages;
use App\Models\Affections;
use App\Models\Etablissements;
use App\Models\Assurance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashSuperAdmin(Request $request)
    {

    	$page_title = "Tableau de bord";

    	$superadmin_id = Auth::user()->id;
    	$superadmin = User::find($superadmin_id);

        
        // Count users
        $count_users = User::where('role', 'SuperAdmin')
        ->orWhere('role', 'AdminEtablissement')
        ->orWhere('role', 'AdminAssurance')
        ->get()->count();

        // Count actes
        $count_actes = Actes::all()->count();

        // Count assurances
        $count_assurances = Assurance::all()->count();

        // Count etabblissements
        $count_etablissements = Etablissements::all()->count();

        // Count examens
        $count_examens = Examens::all()->count();

        // Count villes
        $count_villes = Villes::all()->count();

        // Count specialites
        $count_specialites = Specialites::all()->count();

        // Count appareillages
        $count_appareillages = Appareillages::all()->count();

        // Count affections
        $count_affections = Affections::all()->count();

	    return view('backend.superadmin.dashSuperAdmin', compact('page_title', 'count_users', 'count_actes', 'count_examens', 
        'count_villes', 'count_specialites', 'count_appareillages', 'count_affections', 'count_assurances', 'count_etablissements'));

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profilSuperAdmin(Request $request)
    {
        // Récupérer utilisateur connecté
        $superadmin = Auth::user();

        return view('backend.superadmin.profilSuperAdmin', compact('root'));
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

    
    public function deleteSuperSuperAdmin(User $user)
    {
      $user->delete();
      $this->meesage('message','User deleted successfully!');
      return redirect()->back();
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
    public function dashSuperAdminSuper(Request $request)
    {

    	$page_title = "Nos Administrateurs";

    	$users = User::where('role', 'SuperAdmin')->get();

        return view('backend.superadmin.dashSuperAdminSuper', compact('page_title', 'users'));

    }

    public function dashSuperAdminEtab(Request $request)
    {

    	$page_title = "Nos Administrateurs";

    	$users = User::where('role', 'AdminEtablissement')->get();
        $etablissements = Etablissements::all();

        return view('backend.superadmin.dashSuperAdminEtab', compact('page_title', 'users', 'etablissements'));

    }

    public function dashSuperAdminAssu(Request $request)
    {

    	$page_title = "Nos Administrateurs";

    	$users = User::where('role', 'AdminAssurance')->get();
        $assurances = Assurance::all();

        return view('backend.superadmin.dashSuperAdminAssu', compact('page_title', 'users', 'assurances'));

    }

    public function dashSuperAdminActes(Request $request)
    {

    	$page_title = "Nos Actes";

    	$actes = Actes::all();

        return view('backend.superadmin.dashSuperAdminActes', compact('page_title', 'actes'));

    }

    public function dashSuperAdminExamens(Request $request)
    {

    	$page_title = "Nos Examens";

    	$examens = Examens::all();

        return view('backend.superadmin.dashSuperAdminExamens', compact('page_title', 'examens'));

    }

    public function dashSuperAdminVilles(Request $request)
    {

    	$page_title = "Nos Villes";

    	$villes = Villes::all();
        $provinces = Provinces::all();
        return view('backend.superadmin.dashSuperAdminVilles', compact('page_title', 'villes', 'provinces'));

    }

    public function dashSuperAdminSpecialites(Request $request)
    {

    	$page_title = "Nos Specialités";

        $specialites = Specialites::all();
        return view('backend.superadmin.dashSuperAdminSpecialites', compact('page_title', 'specialites'));

    }

    public function dashSuperAdminAppareillages(Request $request)
    {

    	$page_title = "Nos Appareillages";

        $appareillages = Appareillages::all();
        return view('backend.superadmin.dashSuperAdminAppareillages', compact('page_title', 'appareillages'));

    }

    public function dashSuperAdminAffections(Request $request)
    {

    	$page_title = "Nos Affections";

        $affections = Affections::all();
        return view('backend.superadmin.dashSuperAdminAffections', compact('page_title', 'affections'));

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
    public function newSuperAdminSuper(Request $request)
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
            $new_user->email = $request->input('email');
            $new_user->telephone = $request->input('telephone');
            $new_user->adresse = $request->input('adresse');
            $new_user->role = $request->input('role');
            $new_user->password = Hash::make($request->input('password'));
            $new_user->api_token = Str::random(100);
            $new_user->active = 1;

            if ($request->file('photo_url') !== null) {
                $file = $request->file('photo_url');
    
                if ($request->hasFile('photo_url')) {
                    $path = public_path('assets/photos/roots/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();
    
                    $location = '/photos/roots/'. $filename;
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

    public function newSuperAdminEtab(Request $request)
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
            $new_user->email = $request->input('email');
            $new_user->telephone = $request->input('telephone');
            $new_user->adresse = $request->input('adresse');
            $new_user->role = $request->input('role');
            $new_user->etablissement_id = $request->input('etablissement_id');
            $new_user->password = Hash::make($request->input('password'));
            $new_user->api_token = Str::random(100);
            $new_user->active = 1;

            if ($request->file('photo_url') !== null) {
                $file = $request->file('photo_url');
    
                if ($request->hasFile('photo_url')) {
                    $path = public_path('assets/photos/roots/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();
    
                    $location = '/photos/roots/'. $filename;
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

    public function newSuperAdminAssu(Request $request)
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
            $new_user->email = $request->input('email');
            $new_user->telephone = $request->input('telephone');
            $new_user->adresse = $request->input('adresse');
            $new_user->role = $request->input('role');
            $new_user->assurance_id = $request->input('assurance_id');
            $new_user->password = Hash::make($request->input('password'));
            $new_user->api_token = Str::random(100);
            $new_user->active = 1;

            if ($request->file('photo_url') !== null) {
                $file = $request->file('photo_url');
    
                if ($request->hasFile('photo_url')) {
                    $path = public_path('assets/photos/roots/');
                    // foreach ($files as $file) {
                    $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();
    
                    $location = '/photos/roots/'. $filename;
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
    public function newActeSuperAdmin(Request $request)
    {

        $new_acte = new Actes();

    	// Get new data 
        $new_acte->code = $request->input('code');
        $new_acte->designation = $request->input('designation');

        if($new_acte->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel acte crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet acte !');

    }

    public function newExamenSuperAdmin(Request $request)
    {

        $new_examen = new Examens();

    	// Get new data 
        $new_examen->designation = $request->input('designation');
        $new_examen->cotation = $request->input('cotation');

        if($new_examen->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel examen crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet examen !');

    }

    public function newVilleSuperAdmin(Request $request)
    {

        $new_ville = new Villes();

    	// Get new data 
        $new_ville->libelle = $request->input('libelle');
        $new_ville->province_id = $request->input('province_id');

        if($new_ville->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel ville crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet ville !');

    }

    public function newSpecialiteSuperAdmin(Request $request)
    {

        $new_specialite = new Specialites();

    	// Get new data 
        $new_specialite->libelle = $request->input('libelle');
        $new_specialite->description = $request->input('description');

        if($new_specialite->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel specialite crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet specialite !');

    }

    public function newAppareillageSuperAdmin(Request $request)
    {

        $new_appareillage = new Appareillages();

    	// Get new data 
        $new_appareillage->libelle = $request->input('libelle');
        $new_appareillage->description = $request->input('description');

        if($new_appareillage->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel appareillage crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet appareillage !');

    }

    public function newAffectionSuperAdmin(Request $request)
    {

        $new_affection = new Affections();

    	// Get new data 
        $new_affection->code = $request->input('code');
        $new_affection->titre = $request->input('titre');

        if($new_affection->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvelle affection crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette affection !');

    }

        	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  SHOW ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showActeSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Acte";

    	$acte = Actes::find($id);

        return view('backend.superadmin.showActeSuperAdmin', compact('acte', 'page_title'));

    }

    public function showExamenSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Examen";

    	$examen = Examens::find($id);

        return view('backend.superadmin.showExamenSuperAdmin', compact('examen', 'page_title'));

    }

    public function showVilleSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Ville";

    	$ville = Villes::find($id);

        return view('backend.superadmin.showVilleSuperAdmin', compact('ville', 'page_title'));

    }

    public function showSpecialiteSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Specialite";

    	$specialite = Specialites::find($id);

        return view('backend.superadmin.showSpecialiteSuperAdmin', compact('specialite', 'page_title'));

    }

    public function showAppareillageSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Appareillage";

    	$appareillage = Appareillages::find($id);

        return view('backend.superadmin.showAppareillageSuperAdmin', compact('appareillage', 'page_title'));

    }

    public function showAffectionSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Affection";

    	$affection = Affections::find($id);

        return view('backend.superadmin.showAffectionSuperAdmin', compact('affection', 'page_title'));

    }

        	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  EDIT ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editActeSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Acte";

    	$acte = Actes::find($id);

        return view('backend.superadmin.editActeSuperAdmin', compact('acte', 'page_title'));

    }

    public function editExamenSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Examen";

    	$examen = Examens::find($id);

        return view('backend.superadmin.editExamenSuperAdmin', compact('examen', 'page_title'));

    }

    public function editVilleSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Ville";

    	$ville = Villes::find($id);

        return view('backend.superadmin.editVilleSuperAdmin', compact('ville', 'page_title'));

    }

    public function editSpecialiteSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Specialité";

    	$specialite = Specialites::find($id);

        return view('backend.superadmin.editSpecialiteSuperAdmin', compact('specialite', 'page_title'));

    }

    public function editAppareillageSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Appareillage";

    	$appareillage = Appareillages::find($id);

        return view('backend.superadmin.editAppareillageSuperAdmin', compact('appareillage', 'page_title'));

    }

    public function editAffectionSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Affection";

    	$affection = Affections::find($id);

        return view('backend.superadmin.editAffectionSuperAdmin', compact('affection', 'page_title'));

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
    public function updateThemesuperadmin(Request $request)
    {

    	$acte_id = $request->input('acte_id');
    	$new_acte = Actes::find($acte_id);

    	// Get new data 
        $new_acte->code = $request->input('code');
        $new_acte->designation = $request->input('designation');

        if($new_acte->save()){

            // Redirection
            return redirect()->back()->with('success', 'Acte modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet acte !');

    }

    public function updateSuperAdminSuper(Request $request)
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
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->role = $request->input('role');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->password = Hash::make($request->input('password'));

        if ($request->file('photo_url') !== null) {
            $file = $request->file('photo_url');

            if ($request->hasFile('photo_url')) {
                $path = public_path('assets/photos/roots/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/roots/'. $filename;
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

    public function updateSuperAdminEtab(Request $request)
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
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->role = $request->input('role');
        $utilisateur->etablissement_id = $request->input('etablissement_id');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->password = Hash::make($request->input('password'));

        if ($request->file('photo_url') !== null) {
            $file = $request->file('photo_url');

            if ($request->hasFile('photo_url')) {
                $path = public_path('assets/photos/roots/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/roots/'. $filename;
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

    public function updateSuperAdminAssu(Request $request)
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
        $utilisateur->telephone = $request->input('telephone');
        $utilisateur->role = $request->input('role');
        $utilisateur->assurance_id = $request->input('assurance_id');
        $utilisateur->adresse = $request->input('adresse');
        $utilisateur->password = Hash::make($request->input('password'));

        if ($request->file('photo_url') !== null) {
            $file = $request->file('photo_url');

            if ($request->hasFile('photo_url')) {
                $path = public_path('assets/photos/roots/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/roots/'. $filename;
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

    public function updateExamensuperadmin(Request $request)
    {

    	$examen_id = $request->input('examen_id');
    	$new_examen = Examens::find($examen_id);

    	// Get new data 
        $new_examen->designation = $request->input('designation');
        $new_examen->cotation = $request->input('cotation');

        if($new_examen->save()){

            // Redirection
            return redirect()->back()->with('success', 'Examen modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet examen !');

    }

    public function updateVillesuperadmin(Request $request)
    {

    	$ville_id = $request->input('ville_id');
    	$new_ville = Villes::find($ville_id);

    	// Get new data 
        $new_ville->libelle = $request->input('libelle');
        $new_ville->acte_id = $request->input('province_id');

        if($new_ville->save()){

            // Redirection
            return redirect()->back()->with('success', 'ville modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet ville !');

    }

    public function updateSpecialitesuperadmin(Request $request)
    {

    	$specialite_id = $request->input('specialite_id');
    	$new_specialite = Specialites::find($specialite_id);

    	// Get new data 
        $new_specialite->libelle = $request->input('libelle');
        $new_specialite->description = $request->input('description');

        if($new_specialite->save()){

            // Redirection
            return redirect()->back()->with('success', 'specialite modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet specialite !');

    }

    public function updateAppareillageSuperAdmin(Request $request)
    {

    	$appareillage_id = $request->input('appareillage_id');
    	$new_appareillage = Appareillages::find($appareillage_id);

    	// Get new data 
        $new_appareillage->libelle = $request->input('libelle');
        $new_appareillage->description = $request->input('description');

        if($new_appareillage->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }

    public function updateAffectionSuperAdmin(Request $request)
    {

    	$affection_id = $request->input('affection_id');
    	$new_affection = Affections::find($affection_id);

    	// Get new data 
        $new_affection->code = $request->input('code');
        $new_affection->titre = $request->input('titre');

        if($new_affection->save()){

            // Redirection
            return redirect()->back()->with('success', 'affection modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cette affection !');

    }













}
