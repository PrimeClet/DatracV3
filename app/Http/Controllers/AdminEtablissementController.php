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

    	$adminetablissement_id = Auth::user()->id;
    	$adminetablissement = User::find($adminetablissement_id);

	    return view('backend.adminetablissement.dashAdminEtablissement', compact('page_title'));

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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