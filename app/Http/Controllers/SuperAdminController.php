<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Actes;
use App\Models\Examens;
use App\Models\Prestations;
use App\Models\Villes;
use App\Models\Provinces;
use App\Models\Specialites;

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

	    return view('backend.superadmin.dashSuperAdmin', compact('page_title'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function dashSuperAdminPrestations(Request $request)
    {

    	$page_title = "Nos Prestations";

    	$prestations = Prestations::all();
        $actes = Actes::all();
        return view('backend.superadmin.dashSuperAdminPrestations', compact('page_title', 'prestations', 'actes'));

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newActeSuperAdmin(Request $request)
    {

        $new_acte = new Actes();

    	// Get new data 
        $new_acte->quotation = $request->input('quotation');
        $new_acte->libelle = $request->input('libelle');

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

    public function newPrestationSuperAdmin(Request $request)
    {

        $new_prestation = new Prestations();

    	// Get new data 
        $new_prestation->libelle = $request->input('libelle');
        $new_prestation->cotation_acte = $request->input('cotation_acte');
        $new_prestation->acte_id = $request->input('acte_id');

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel prestation crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cet prestation !');

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

    public function showPrestationSuperAdmin(Request $request, $id)
    {

    	$page_title = "Détails Prestation";

    	$prestation = Prestations::find($id);

        return view('backend.superadmin.showPrestationSuperAdmin', compact('prestation', 'page_title'));

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

    public function editPrestationSuperAdmin(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = Prestations::find($id);

        return view('backend.superadmin.editPrestationSuperAdmin', compact('prestation', 'page_title'));

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
        $new_acte->quotation = $request->input('quotation');
        $new_acte->libelle = $request->input('libelle');

        if($new_acte->save()){

            // Redirection
            return redirect()->back()->with('success', 'Acte modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet acte !');

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

    public function updatePrestationsuperadmin(Request $request)
    {

    	$prestation_id = $request->input('prestation_id');
    	$new_prestation = Prestations::find($prestation_id);

    	// Get new data 
        $new_prestation->libelle = $request->input('libelle');
        $new_prestation->cotation_acte = $request->input('cotation_acte');
        $new_prestation->acte_id = $request->input('acte_id');

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Prestation modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet prestation !');

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














}
