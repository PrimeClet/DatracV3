<?php

namespace App\Http\Controllers;

use App\User;

use App\Models\ActeAssurances;
use App\Models\TicketModerateurs;
use App\Models\Prestations;
use App\Models\Medicament;
use App\Models\ExamenEtablissements;
use App\Models\Appareillages;
use App\Models\Affections;
use App\Models\Assurance;
use App\Models\Etablissements;
use App\Models\PrestationSoins;
use App\Models\PriseCharges;
use App\Models\PrescriptionMedicales;
use App\Models\PrestationExamensLabo;
use App\Models\PrestationHospitalisations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LaboratoireEtablissementController extends Controller
{
    public function dashLaboratoireEtablissement(Request $request)
    {
        $page_title = "Tableau de bord";

        $user_id = Auth::user()->id;
        $labo_id = Auth::user()->etablissement_id;
        $labo = User::find($user_id);
        $laboetablissement = Etablissements::find($labo_id);

        // Count  medicaments
        $count_examens = ExamenEtablissements::all()->count();

        // Count  prescriptions
        $count_prescriptions = PrestationExamensLabo::all()->count();

        return view('backend.praticienetablissement.dashPraticienEtablissement', compact('page_title', 'laboetablissement', 'count_examens'));
    }
        
           	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  DASH ROUTING                                              #
    #                                                                                            #
    ##############################################################################################
    
    public function dashLaboratoireEtablissementPrestationExamens(Request $request)
    {
        $page_title = "Nos Prescription Medicales";

    	$prestationexamens = PrestationExamensLabo::all();
        $laborantins = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'LaborantinEtablissement');
                            })->get();
        $assures = User::Where(function ($query) {
                                $query->where('role', 'Assure');
                            })->get();
        $ayantdroits = User::Where(function ($query) {
                                $query->where('role', 'AyantDroit');
                            })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();
        return view('backend.laboetablissement.dashLaboratoireEtablissementPrestationExamens', compact('page_title', 'laborantins', 'assurances', 'prestationexamens', 'assures', 
                    'etablissements', 'ayantdroits'));
    }

                
    	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                               #
    #                                                                                            #
    ##############################################################################################
    
    public function newPrestationExamenLaboratoireEtablissement (Request $request)
    {

        $new_prestation = new PrestationExamensLabo();

    	// Get new data 
        $new_prestation->feuillesoins_id = $request->input('feuillesoins_id');
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->tarifstructure = $request->input('tarifstructure');
        $new_prestation->tarifconventionne = $request->input('tarifconventionne');
        $new_prestation->depassement = $request->input('depassement ');
        $new_prestation->montantpayer = $request->input('montantpayer ');
        $new_prestation->ticketmoderateur_id = $request->input('ticketmoderateur_id ');
        $new_prestation->caisse_id = $request->input('caisse_id ');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure_id = $request->input('assure_id');
        $new_prestation->ayantdroit_id = $request->input('ayantdroit_id');
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }
                    
    	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                               #
    #                                                                                            #
    ##############################################################################################

    public function updatePrestationExamenLaboratoiretablissement (Request $request)
    {

        $prestation_id = $request->input('prestation_id');
    	$new_prestation = PrestationExamensLabo::find($prestation_id);

    	// Get new data 
        $new_prestation->feuillesoins_id = $request->input('feuillesoins_id');
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->tarifstructure = $request->input('tarifstructure');
        $new_prestation->tarifconventionne = $request->input('tarifconventionne');
        $new_prestation->depassement = $request->input('depassement ');
        $new_prestation->montantpayer = $request->input('montantpayer ');
        $new_prestation->ticketmoderateur_id = $request->input('ticketmoderateur_id ');
        $new_prestation->caisse_id = $request->input('caisse_id ');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure_id = $request->input('assure_id');
        $new_prestation->ayantdroit_id = $request->input('ayantdroit_id');
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }
        
        	/* Les routes du root seront enumérés ici ! */

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

    public function showPrestationExamenLaboratoireEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prestationsoin = PrestationExamensLabo::find($id);

        return view('backend.laboetablissement.showPrestationExamenLaboratoireEtablissement', compact('prestationsoin', 'page_title'));

    }
            
        	/* Les routes du root seront enumérés ici ! */

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
    public function editPrestationExamenLaboratoireEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PrestationExamensLabo::find($id);

        return view('backend.laboetablissement.editPrestationExamenLaboratoireEtablissement', compact('prestation', 'page_title'));

    }

}