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
use App\Models\TypeAssures;
use App\Models\TypeActes;
use App\Models\Assures;

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

        // Count typeassures
        $count_typeassures = TypeAssures::all()->count();

        // Count assures
        $count_assures = Assures::all()->count();

        // Count actes
        $count_actes = ActeAssurances::all()->count();
        // dd($count_actes);

	    return view('backend.adminassurance.dashAdminAssurance', compact('page_title', 'count_users', 'count_examens',
    'count_prestations', 'count_appareillages', 'count_medicaments', 'count_actes', 'adminassu', 
    'count_assures','count_typeassures'));

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
        $typeactes = TypeActes::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceActes', compact('page_title', 'acteAssurances', 'typeactes', 'assurances'));

    }

    public function dashAdminAssuranceAffections(Request $request)
    {

    	$page_title = "Nos Affections";

    	$affectionAssurances = AffectionAssurances::all();
        $affections = Affections::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceAffections', compact('page_title', 'affectionAssurances', 'affections', 'assurances'));

    }

    public function dashAdminAssurancePrestations(Request $request)
    {

    	$page_title = "Nos Prestations";

    	$prestationAssurances = PrestationAssurances::all();
        $prestations = Prestations::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssurancePrestations', compact('page_title', 'prestationAssurances', 'prestations', 'assurances'));

    }

    public function dashAdminAssuranceTypeAssures(Request $request)
    {

    	$page_title = "Nos Type Assurés";

        $typeassures = TypeAssures::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceTypeAssures', compact('page_title', 'typeassures', 'assurances'));

    }

    public function dashAdminAssuranceTicketModerateurs(Request $request)
    {

    	$page_title = "Nos Ticket Modérateurs";

        $ticketmoderateurs = TicketModerateurs::all();
        $typeassures = TypeAssures::all();
        $assurances = Assurance::where('id', Auth::user()->assurance_id);

        return view('backend.adminassurance.dashAdminAssuranceTicketModerateurs', compact('page_title', 'ticketmoderateurs', 'typeassures', 'assurances'));

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
        $new_acte->designation = $request->input('designation');
        $new_acte->cotation = $request->input('cotation');
        $new_acte->tarif_conventionne = $request->input('tarif_conventionne');
        $new_acte->type_acte_id = $request->input('type_acte_id');
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

    public function newPrestationAdminAssurance(Request $request)
    {

        $new_prestation = new PrestationAssurances();

    	// Get new data 
        $new_prestation->tarif_conventionne = $request->input('tarif_conventionne');
        $new_prestation->prestation_id = $request->input('prestation_id');

        $new_prestation->assurance_id = Auth::user()->assurance_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prestation crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Prestation !');

    }

    
    public function newTypeAssureAdminAssurance(Request $request)
    {

        $new_typeassure = new TypeAssures();

    	// Get new data 
        $new_typeassure->libelle = $request->input('libelle');
        $new_typeassure->abbreviation = $request->input('abbreviation');

        $new_typeassure->assurance_id = Auth::user()->assurance_id;

        if($new_typeassure->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prestation crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Prestation !');

    }

    public function newTicketModerateurAdminAssurance(Request $request)
    {

        $new_ticketmoderateur = new TicketModerateurs();

    	// Get new data 
        $new_ticketmoderateur->pourcentage = $request->input('pourcentage');
        $new_ticketmoderateur->libelle = $request->input('libelle');
        $new_ticketmoderateur->typeassure_id = $request->input('typeassure_id');

        $new_ticketmoderateur->assurance_id = Auth::user()->assurance_id;

        if($new_ticketmoderateur->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel ticket moderateur crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet ticket moderateur !');

    }


    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                               #
    #                                                                                            #
    ##############################################################################################

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

    public function showPrestationAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Prestation";

    	$prestationAssurance = PrestationAssurances::find($id);

        return view('backend.adminAssurance.showPrestationAdminAssurance', compact('prestationAssurance', 'page_title'));

    }

    
    public function showTypeAssureAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Type Assure";

    	$typeassure = TypeAssures::find($id);

        return view('backend.adminAssurance.showTypeAssureAdminAssurance', compact('typeassure', 'page_title'));

    }

    public function showTicketModerateurAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Ticket Moderateur";

    	$ticketmoderateur = TicketModerateurs::find($id);

        return view('backend.adminAssurance.showTicketModerateurAdminAssurance', compact('ticketmoderateur', 'page_title'));

    }


    

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                               #
    #                                                                                            #
    ##############################################################################################

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

    public function editPrestationAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestationAssurance = PrestationAssurances::find($id);

        return view('backend.adminAssurance.editPrestationAdminAssurance', compact('prestationAssurance', 'page_title'));

    }
    
    public function editTypeAssureAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Type Assure";

    	$typeassure = TypeAssures::find($id);

        return view('backend.adminAssurance.editTypeAssureAdminAssurance', compact('typeassure', 'page_title'));

    }

    public function editTicketModerateurAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Ticket Moderateur";

    	$ticketmoderateur = TicketModerateurs::find($id);

        return view('backend.adminAssurance.editTicketModerateurAdminAssurance', compact('ticketmoderateur', 'page_title'));

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

    public function updateAssureAdminAssurance(Request $request)
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
        $utilisateur->type_assure_id = $request->input('type_assure_id');
        $utilisateur->email = $request->input('email');
        $utilisateur->datenaiss = $request->input('datenaiss');
        $utilisateur->numero_assure = $request->input('numero_assure');  
        $utilisateur->situation_patient = $request->input('situation_patient');   
        $utilisateur->telephone = $request->input('telephone');
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

        if ($request->file('signature_patient') !== null) {
            $file = $request->file('signature_patient');

            if ($request->hasFile('signature_patient')) {
                $path = public_path('assets/photos/signature/');
                // foreach ($files as $file) {
                $filename = strtolower(trim($request->input('name'))). '.' . $file->getClientOriginalExtension();

                $location = '/photos/signature/'. $filename;
                $file->move($path, $filename);
                $utilisateur->signature_patient = $location;
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
        $new_medicament->tarif_conventionne = $request->input('tarif_conventionne');
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
        $new_examen->tarif_conventionne = $request->input('tarif_conventionne');
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
        $new_acte->type_acte_id = $request->input('type_acte_id');
        $new_acte->designation = $request->input('designation');
        $new_acte->cotation = $request->input('cotation');
        $new_acte->tarif_conventionne = $request->input('tarif_conventionne');
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

    public function updatePrestationAdminAssurance(Request $request)
    {

    	$prestationAssurance_id = $request->input('prestationAssurance_id');
    	$new_prestation = PrestationAssurances::find($prestationAssurance_id);

    	// Get new data 
        $new_prestation->tarif_conventionne = $request->input('tarif_conventionne');
        $new_prestation->prestation_id = $request->input('prestation_id');

        $new_prestation->assurance_id = Auth::user()->assurance_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'examen modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet examen !');

    }
  
    public function updateTypeAssureAdminAssurance(Request $request)
    {

    	$typeassure_id = $request->input('typeassure_id');
    	$new_typeassure = TypeAssures::find($typeassure_id);

    	// Get new data 
        $new_typeassure->libelle = $request->input('libelle');
        $new_typeassure->abbreviation = $request->input('abbreviation');

        $new_typeassure->assurance_id = Auth::user()->assurance_id;

        if($new_typeassure->save()){

            // Redirection
            return redirect()->back()->with('success', 'examen modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet examen !');

    }

    public function updateTicketModerateurAdminAssurance(Request $request)
    {

    	$ticketmoderateur_id = $request->input('ticketmoderateur_id');
    	$new_ticketmoderateur = TypeAssures::find($ticketmoderateur_id);

    	// Get new data 
        $new_ticketmoderateur->pourcentage = $request->input('pourcentage');
        $new_ticketmoderateur->libelle = $request->input('libelle');
        $new_ticketmoderateur->typeassure_id = $request->input('typeassure_id');

        $new_ticketmoderateur->assurance_id = Auth::user()->assurance_id;

        if($new_ticketmoderateur->save()){

            // Redirection
            return redirect()->back()->with('success', 'examen modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet examen !');

    }




}