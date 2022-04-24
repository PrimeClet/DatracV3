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
use App\Models\Assurances;
use App\Models\Medicament;
use App\Models\Examens;
use App\Models\Appareillages;
use App\Models\Actes;
use App\Models\Affections;

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

    	$adminAssurance_id = Auth::user()->id;
    	$adminAssurance = User::find($adminAssurance_id);

	    return view('backend.adminAssurance.dashAdminAssurance', compact('page_title'));

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

        return view('backend.adminAssurance.dashAdminAssuranceMedicaments', compact('page_title', 'medicamentAssurances','medicaments'));

    }

    public function dashAdminAssurancePrestations(Request $request)
    {

    	$page_title = "Nos Prestations";

    	$prestationAssurances = PrestationAssurances::all();
        $prestations = Prestations::all();

        return view('backend.adminAssurance.dashAdminAssurancePrestations', compact('page_title', 'prestationAssurances','prestations'));

    }

    public function dashAdminAssuranceExamens(Request $request)
    {

    	$page_title = "Nos Examens";

    	$examenAssurances = ExamenAssurances::all();
        $examens = Examens::all();

        return view('backend.adminAssurance.dashAdminAssuranceExamens', compact('page_title', 'examenAssurances','examens'));

    }

    public function dashAdminAssuranceAppareillages(Request $request)
    {

    	$page_title = "Nos Appareillages";

    	$appareillageAssurances = AppareillageAssurances::all();
        $appareillages = Appareillages::all();

        return view('backend.adminAssurance.dashAdminAssuranceAppareillages', compact('page_title', 'appareillageAssurances','appareillages'));

    }

    public function dashAdminAssuranceActes(Request $request)
    {

    	$page_title = "Nos Actes";

    	$acteAssurances = ActeAssurances::all();
        $actes = Actes::all();

        return view('backend.adminAssurance.dashAdminAssuranceActes', compact('page_title', 'acteAssurances','actes'));

    }

    public function dashAdminAssuranceAffections(Request $request)
    {

    	$page_title = "Nos Affections";

    	$affectionAssurances = AffectionAssurances::all();
        $affections = Affections::all();

        return view('backend.adminAssurance.dashAdminAssuranceAffections', compact('page_title', 'affectionAssurances','affections'));

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

        if($new_medicament->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Medicament crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet Medicament !');

    }

    public function newPrestationAdminAssurance(Request $request)
    {

        $new_prestation = new PrestationAssurances();

    	// Get new data 
        $new_prestation->tarif_conventionne = $request->input('tarif_conventionne');
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->ticketModerateur = $request->input('ticketModerateur');

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prestation crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prestation !');

    }

    public function newExamenAdminAssurance(Request $request)
    {

        $new_examen = new ExamenAssurances();

    	// Get new data 
        $new_examen->tarif_conventionne = $request->input('tarif_conventionne');
        $new_examen->examen_id = $request->input('examen_id');

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
        $new_acte->tarif_conventionne = $request->input('tarif_conventionne');
        $new_acte->acte_id = $request->input('acte_id');

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

    public function showPrestationAdminAssurance(Request $request, $id)
    {

    	$page_title = "Détails Prestation";

    	$prestationAssurance = PrestationAssurances::find($id);

        return view('backend.adminAssurance.showPrestationAdminAssurance', compact('prestationAssurance', 'page_title'));

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

    public function editPrestationAdminAssurance(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestationAssurance = PrestationAssurances::find($id);

        return view('backend.adminAssurance.editPrestationAdminAssurance', compact('prestationAssurance', 'page_title'));

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

        if($new_medicament->save()){

            // Redirection
            return redirect()->back()->with('success', 'Medicament modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet Medicament !');

    }

    public function updatePrestationAdminAssurance(Request $request)
    {

    	$prestationAssurance_id = $request->input('prestationAssurance_id');
    	$new_prestation = PrestationAssurances::find($prestationAssurance_id);

    	// Get new data 
        $new_prestation->tarif_structure = $request->input('tarif_conventionne');
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->ticketModerateur = $request->input('ticketModerateur');

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'prestation modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cette prestation !');

    }

    public function updateExamenAdminAssurance(Request $request)
    {

    	$examenAssurance_id = $request->input('examenAssurance_id');
    	$new_examen = ExamenAssurances::find($examenAssurance_id);

    	// Get new data 
        $new_examen->tarif_structure = $request->input('tarif_conventionne');
        $new_examen->medicament_id = $request->input('examen_id');

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
        $new_acte->tarif_structure = $request->input('tarif_conventionne');
        $new_acte->acte_id = $request->input('acte_id');

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

        if($new_affection->save()){

            // Redirection
            return redirect()->back()->with('success', 'affection modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cette affection !');

    }



}