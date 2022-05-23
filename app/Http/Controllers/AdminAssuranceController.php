<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\MedicamentAssurances;
use App\Models\ExamenAssurances;
use App\Models\PrestationAssurances;
use App\Models\AppareillageAssurances;
use App\Models\ActeAssurances;
use App\Models\AffectionAssurances;
use App\Models\TicketModerateurs;
use App\Models\Prestations;
use App\Models\Medicament;
use App\Models\Examens;
use App\Models\Appareillages;
use App\Models\Actes;
use App\Models\Affections;
use App\Models\Assurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAssuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashAdminAssurance(Request $request)
    {

    	$page_title = "Tableau de bord";

    	$user_id = Auth::user()->id;
        $adminassurance_id = Auth::user()->assurance_id;
    	$adminassurance = User::find($user_id);
        $adminassu = Assurance::find($adminassurance_id);

        

        // Count users
        $count_users = User::where('role', 'ManagerAssurance')
        ->orWhere('role', 'ComptableAssurance')
        ->orWhere('role', 'TiersPayantAssurance')
        ->orWhere('role', 'MedecinAssurance')
        ->orWhere('role', 'Assure')
        ->get()->count();

        // Count examens
        $count_examens = ExamenAssurances::all()->count();

        // Count prestations
        $count_prestations = PrestationAssurances::all()->count();

        // Count appareillages
        $count_appareillages = AppareillageAssurances::all()->count();

        // Count affections
        $count_medicaments = MedicamentAssurances::all()->count();

        // Count actes
        $count_actes = ActeAssurances::all()->count();
        // dd($count_actes);

	    return view('backend.adminassurance.dashAdminAssurance', compact('page_title', 'count_users', 'count_examens',
    'count_prestations', 'count_appareillages', 'count_medicaments', 'count_actes', 'adminassu'));

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
    public function dashAdminAssuranceAgents(Request $request)
    {

    	$page_title = "Nos Agents";

    	$users = User::where('assurance_id', Auth::user()->assurance_id)
                        ->Where(function ($query) {
                            $query->where('role', 'ManagerAssurance')
                            ->orWhere('role', 'ComptableAssurance')
                            ->orWhere('role', 'TiersPayantAssurance')
                            ->orWhere('role', 'MedecinAssurance');
                        })->get();

        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceAgents', compact('page_title', 'users', 'assurances'));

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashAdminAssuranceMedicaments(Request $request)
    {

    	$page_title = "Nos Medicaments";

    	$medicamentAssurances = MedicamentAssurances::all();
        $medicaments = Medicament::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceMedicaments', compact('page_title', 'medicamentAssurances','medicaments', 'assurances'));

    }

    public function dashAdminAssuranceExamens(Request $request)
    {

    	$page_title = "Nos Examens";

    	$examenAssurances = ExamenAssurances::all();
        $examens = Examens::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceExamens', compact('page_title', 'examenAssurances', 'examens', 'assurances'));

    }

    public function dashAdminAssuranceAppareillages(Request $request)
    {

    	$page_title = "Nos Appareillages";

    	$appareillageAssurances = AppareillageAssurances::all();
        $appareillages = Appareillages::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceAppareillages', compact('page_title', 'appareillageAssurances', 'appareillages', 'assurances'));

    }

    public function dashAdminAssuranceActes(Request $request)
    {

    	$page_title = "Nos Actes";

    	$acteAssurances = ActeAssurances::all();
        $actes = Actes::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceActes', compact('page_title', 'acteAssurances', 'actes', 'assurances'));

    }

    public function dashAdminAssuranceAffections(Request $request)
    {

    	$page_title = "Nos Affections";

    	$affectionAssurances = AffectionAssurances::all();
        $affections = Affections::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceAffections', compact('page_title', 'affectionAssurances', 'affections', 'assurances'));

    }

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
    public function newAgentAdminAssurance(Request $request)
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
            $new_user->assurance_id = Auth::user()->assurance_id;    
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
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newMedicamentAdminAssurance(Request $request)
    {

        $new_medicament = new MedicamentAssurances();

    	// Get new data 
        $new_medicament->tarif_conventionne = $request->input('tarif_conventionne');
        $new_medicament->medicament_id = $request->input('medicament_id');

        $new_medicament->assurance_id = Auth::user()->assurance_id;

        if($new_medicament->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Medicament crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Medicament !');

    }

    public function newExamenAdminAssurance(Request $request)
    {

        $new_examen = new ExamenAssurances();

    	// Get new data 
        $new_examen->tarif_conventionne = $request->input('tarif_conventionne');
        $new_examen->examen_id = $request->input('examen_id');

        $new_examen->assurance_id = Auth::user()->assurance_id;

        if($new_examen->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Examen crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Examen !');

    }

    public function newAppareillageAdminAssurance(Request $request)
    {

        $new_appareillage = new AppareillageAssurances();

    	// Get new data 
        $new_appareillage->tarif_conventionne = $request->input('tarif_conventionne');
        $new_appareillage->appareillage_id = $request->input('appareillage_id');

        $new_appareillage->assurance_id = Auth::user()->assurance_id;

        if($new_appareillage->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Appareillage crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Appareillage !');

    }

    public function newActeAdminAssurance(Request $request)
    {

        $new_acte = new ActeAssurances();

    	// Get new data 
        $new_acte->acte_id = $request->input('acte_id');

        $new_acte->assurance_id = Auth::user()->assurance_id;

        if($new_acte->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Acte crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Acte !');

    }

    public function newAffectionAdminAssurance(Request $request)
    {

        $new_affection = new AffectionAssurances();

    	// Get new data 
        $new_affection->affection_id = $request->input('affection_id');

        $new_affection->assurance_id = Auth::user()->assurance_id;

        if($new_affection->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel affection crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette affection !');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMedicamentAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Medicament";

    	$medicamentAssurance = MedicamentAssurances::find($id);

        return view('backend.adminAssurance.showMedicamentAdminAssurance', compact('medicamentAssurance', 'page_title'));

    }

    public function showExamenAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Examen";

    	$examenAssurance = ExamenAssurances::find($id);

        return view('backend.adminAssurance.showExamenAdminAssurance', compact('examenAssurance', 'page_title'));

    }

    public function showAppareillageAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Appareillage";

    	$appareillageAssurance = AppareillageAssurances::find($id);

        return view('backend.adminAssurance.showAppareillageAdminAssurance', compact('appareillageAssurance', 'page_title'));

    }

    public function showActeAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Acte";

    	$acteAssurance = ActeAssurances::find($id);

        return view('backend.adminAssurance.showActeAdminAssurance', compact('acteAssurance', 'page_title'));

    }

    public function showAffectionAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Affection";

    	$affectionAssurance = AffectionAssurances::find($id);

        return view('backend.adminAssurance.showAffectionAdminAssurance', compact('affectionAssurance', 'page_title'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMedicamentAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Medicament";

    	$medicamentAssurance = MedicamentAssurances::find($id);

        return view('backend.adminAssurance.editMedicamentAdminAssurance', compact('medicamentAssurance', 'page_title'));

    }

    public function editExamenAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Examen";

    	$examenAssurance = ExamenAssurances::find($id);

        return view('backend.adminAssurance.editExamenAdminAssurance', compact('examenAssurance', 'page_title'));

    }

    public function editAppareillageAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Appareillage";

    	$appareillageAssurance = AppareillageAssurances::find($id);

        return view('backend.adminAssurance.editAppareillageAdminAssurance', compact('appareillageAssurance', 'page_title'));

    }

    public function editActeAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Acte";

    	$acteAssurance = ActeAssurances::find($id);

        return view('backend.adminAssurance.editActeAdminAssurance', compact('acteAssurance', 'page_title'));

    }

    public function editAffectionAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Affection";

    	$affectionAssurance = AffectionAssurances::find($id);

        return view('backend.adminAssurance.editAffectionAdminAssurance', compact('affectionAssurance', 'page_title'));

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
    
    public function updateAgentAdminAssurance(Request $request)
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
        $utilisateur->assurance_id = Auth::user()->assurance_id;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateMedicamentAdminAssurance(Request $request)
    {

    	$medicamentAssurance_id = $request->input('medicamentAssurance_id');
    	$new_medicament = MedicamentAssurances::find($medicamentAssurance_id);

    	// Get new data 
        $new_medicament->tarif_structure = $request->input('tarif_conventionne');
        $new_medicament->medicament_id = $request->input('medicament_id');

        $new_medicament->assurance_id = Auth::user()->assurance_id;

        if($new_medicament->save()){

            // Redirection
            return redirect()->back()->with('success', 'Medicament modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet Medicament !');

    }

    public function updateExamenAdminAssurance(Request $request)
    {

    	$examenAssurance_id = $request->input('examenAssurance_id');
    	$new_examen = ExamenAssurances::find($examenAssurance_id);

    	// Get new data 
        $new_examen->tarif_structure = $request->input('tarif_conventionne');
        $new_examen->medicament_id = $request->input('examen_id');

        $new_examen->assurance_id = Auth::user()->assurance_id;

        if($new_examen->save()){

            // Redirection
            return redirect()->back()->with('success', 'examen modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet examen !');

    }

    public function updateAppareillageAdminAssurance(Request $request)
    {

    	$appareillageAssurance_id = $request->input('appareillageAssurance_id');
    	$new_appareillage = AppareillageAssurances::find($appareillageAssurance_id);

    	// Get new data 
        $new_appareillage->tarif_conventionne = $request->input('tarif_conventionne');
        $new_appareillage->medicament_id = $request->input('appareillage_id');

        $new_appareillage->assurance_id = Auth::user()->assurance_id;

        if($new_appareillage->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }

    public function updateActeAdminAssurance(Request $request)
    {

    	$acteAssurance_id = $request->input('acteAssurance_id');
    	$new_acte = ActeAssurances::find($acteAssurance_id);

    	// Get new data 
        $new_acte->acte_id = $request->input('acte_id');

        $new_acte->assurance_id = Auth::user()->assurance_id;

        if($new_acte->save()){

            // Redirection
            return redirect()->back()->with('success', 'acte modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet acte !');

    }

    public function updateAffectionAdminAssurance(Request $request)
    {

    	$affectionAssurance_id = $request->input('affectionAssurance_id');
    	$new_affection = ActeAssurances::find($affectionAssurance_id);

    	// Get new data 
        $new_affection->affection_id = $request->input('affection_id');

        $new_affection->assurance_id = Auth::user()->assurance_id;

        if($new_affection->save()){

            // Redirection
            return redirect()->back()->with('success', 'affection modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cette affection !');

    }



}