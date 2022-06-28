<?php

namespace App\Http\Controllers;

use App\Models\ActeAssurances;
use App\User;
use App\Models\MedicamentEtablissements;
use App\Models\PrestationCaisses;
use App\Models\PrestationEtablissements;
use App\Models\Etablissements;
use App\Models\EtablissementAssurances;
use App\Models\Medicament;
use App\Models\Hospitalisations;
use App\Models\FeuilleSoins;
use App\Models\Assurance;
use App\Models\TicketModerateurs;
use App\Models\PrestationSoins;
use App\Models\PrestationHospitalisations;
use App\Models\PrestationHospitalisationCaisses;
use App\Models\TypeAssures;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CaisseEtablissementController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashCaisseEtablissement(Request $request)
    {

    	$page_title = "Tableau de bord";

    	$user_id = Auth::user()->id;
        $caisseetablissement_id = Auth::user()->etablissement_id;
    	$caisse = User::find($user_id);
        $caisseetablissement = Etablissements::find($caisseetablissement_id);

        // Count prestations
        $count_prestations = PrestationCaisses::all()->count();

	    return view('backend.caisseetablissement.dashCaisseEtablissement', compact('page_title', 'caisseetablissement','        $caisseetablissement = Etablissements::find($caisseetablissement_id);
        ', ));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  DASH ROUTING                                              #
    #                                                                                            #
    ##############################################################################################
    
    public function dashCaisseEtablissementPrestations(Request $request)
    {

    	$page_title = "Nos Prestations";

    	$prestation_caisses = PrestationCaisses::all();
        $prestation_etablissements = PrestationEtablissements::all();
        $typeassures = TypeAssures::all();
        $ticketmoderateurs = TicketModerateurs::all();
        $caisses = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'CaisseEtablissement');
                            })->get();
        $assures = User::Where(function ($query) {
                            $query->where('role', 'Assure');
                        })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();

        return view('backend.caisseetablissement.dashCaisseEtablissementPrestations', compact('page_title', 'caisses', 'assurances', 'prestation_etablissements', 'ticketmoderateurs','assures', 
                    'etablissements', 'typeassures','prestation_caisses',));

    }
        
    public function CaisseEtablissementPrestationHospitalisations(Request $request)
    {

    	$page_title = "Nos Prestations";

    	$prestation_hospitalisations = PrestationHospitalisationCaisses::all();
        $prestations = PrestationHospitalisations::all();
        $feuillesoins = FeuilleSoins::all();
        $ticketmoderateurs = TicketModerateurs::all();
        $caisses = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'CaisseEtablissement');
                            })->get();
        $assures = User::Where(function ($query) {
                            $query->where('role', 'Assure');
                        })->get();
        $ayantdroits = User::Where(function ($query) {
                            $query->where('role', 'AyantDroit');
                        })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();

        return view('backend.caisseetablissement.CaisseEtablissementPrestationHospitalisations', compact('page_title', 'caisses', 'assurances', 'ticketmoderateurs','assures', 
                    'etablissements', 'prestations','prestation_hospitalisations', 'feuillesoins'));

    }

        	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                              #
    #                                                                                            #
    ##############################################################################################
    
    public function newPrestationCaisseEtablissement(Request $request)
    {

        $new_prestation = new PrestationCaisses();

    	// Get new data 
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->montant = $request->input('montant');
        $new_prestation->ticketmoderateur = $request->input('ticketmoderateur');
        $new_prestation->forfaitdeplacement = $request->input('forfaitdeplacement');
        $new_prestation->montantpayer = $request->input('montantpayer');
        $new_prestation->total = $request->input('total');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->caisse = Auth::user();
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }
        
    public function newPrestationHospitalisationCaisseEtablissement(Request $request)
    {

        $new_prestation = new PrestationHospitalisationCaisses();

    	// Get new data 
        $new_prestation->feuillesoins_id = $request->input('feuillesoins_id');
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->tarifstructure = $request->input('tarifstructure');
        $new_prestation->tarifconventionne = $request->input('tarifconventionne');
        $new_prestation->depassement = $request->input('depassement');
        $new_prestation->ticketmoderateur = $request->input('ticketmoderateur');
        $new_prestation->forfaitdeplacement = $request->input('forfaitdeplacement');
        $new_prestation->montantpayer = $request->input('montantpayer');
        $new_prestation->total = $request->input('total');
        $new_prestation->assure_id = $request->input('assure_id');
        $new_prestation->ayantdroit_id = $request->input('ayantdroit_id');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->caisse_id = Auth::user();
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
    #                                  UPDATE ROUTING                                              #
    #                                                                                            #
    ##############################################################################################
        
    public function showPrestationCaisseEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestation";

    	$prestation = PrestationCaisses::find($id);

        return view('backend.caisseetablissement.showPrestationCaisseEtablissement', compact('prestation', 'page_title'));

    }
            
    public function showPrestationHospitalisationCaisseEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestation";

    	$prestation = PrestationHospitalisationCaisses::find($id);

        return view('backend.caisseetablissement.showPrestationHospitalisationCaisseEtablissement', compact('prestation', 'page_title'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                            #
    #                                                                                            #
    ##############################################################################################
        
    public function editPrestationCaisseEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation Soins";

    	$prestation = PrestationCaisses::find($id);

        return view('backend.caisseetablissement.editPrestationCaisseEtablissement', compact('prestation', 'page_title'));

    }
            
    public function editPrestationHospitalisationCaisseEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation Soins";

    	$prestation = PrestationHospitalisationCaisses::find($id);

        return view('backend.caisseetablissement.editPrestationHospitalisationCaisseEtablissement', compact('prestation', 'page_title'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                            #
    #                                                                                            #
    ##############################################################################################
        
    public function updatePrestationCaisseEtablissement(Request $request)
    {

    	$prestation_id = $request->input('prestation_id');
    	$new_prestation = PrestationSoins::find($prestation_id);

    	// Get new data 
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->montant = $request->input('montant');
        $new_prestation->ticketmoderateur = $request->input('ticketmoderateur');
        $new_prestation->forfaitdeplacement = $request->input('forfaitdeplacement');
        $new_prestation->montantpayer = $request->input('montantpayer');
        $new_prestation->total = $request->input('total');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->caisse = Auth::user();
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }
            
    public function updatePrestationHospitalisationCaisseEtablissement(Request $request)
    {

        $prestation_id = $request->input('prestation_id');
    	$new_prestation = PrestationHospitalisationCaisses::find($prestation_id);

    	// Get new data 
        $new_prestation->feuillesoins_id = $request->input('feuillesoins_id');
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->tarifstructure = $request->input('tarifstructure');
        $new_prestation->tarifconventionne = $request->input('tarifconventionne');
        $new_prestation->depassement = $request->input('depassement');
        $new_prestation->ticketmoderateur = $request->input('ticketmoderateur');
        $new_prestation->forfaitdeplacement = $request->input('forfaitdeplacement');
        $new_prestation->montantpayer = $request->input('montantpayer');
        $new_prestation->total = $request->input('total');
        $new_prestation->assure_id = $request->input('assure_id');
        $new_prestation->ayantdroit_id = $request->input('ayantdroit_id');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->caisse_id = Auth::user();
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }

}