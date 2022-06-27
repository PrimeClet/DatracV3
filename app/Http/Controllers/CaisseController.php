<?php

namespace App\Http\Controllers;

use App\Models\ActeAssurances;
use App\Models\AffectionAssurances;
use App\User;
use App\Models\MedicamentEtablissements;
use App\Models\HospitalisationEtablissements;
use App\Models\PrestationEtablissements;
use App\Models\AppareillageEtablissements;
use App\Models\Prestations;
use App\Models\Etablissements;
use App\Models\EtablissementAssurances;
use App\Models\Medicament;
use App\Models\Hospitalisations;
use App\Models\Appareillages;
use App\Models\Assurance;
use App\Models\Assures;
use App\Models\PriseCharges;
use App\Models\Specialites;
use App\Models\TicketModerateurs;
use App\Models\PrestationSoins;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CaisseController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashCaisse(Request $request)
    {

    	$page_title = "Tableau de bord";

    	$user_id = Auth::user()->id;
        $adminetablissement_id = Auth::user()->etablissement_id;
    	$adminetablissement = User::find($user_id);
        $adminetab = Etablissements::find($adminetablissement_id);

        // Count prestations
        $count_prestations = PrestationSoins::all()->count();

	    return view('backend.caisse.dashCaisse', compact('page_title', 'count_prestations', ));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  DASH ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    public function dashCaissePrestationSoins(Request $request)
    {

    	$page_title = "Nos Prestation de Soins";

    	$prestationsoins = PrestationSoins::all();
        $ticketmoderateurs = TicketModerateurs::all();
        $caisses = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'Caisse');
                            })->get();
        $assures = User::Where(function ($query) {
                            $query->where('role', 'Assure');
                        })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();
        $acteassurances = ActeAssurances::all();
        $affectionassurances = AffectionAssurances::all();

        return view('backend.caisse.dashCaisseEtablissementPrestationSoins', compact('page_title', 'caisses', 'assurances', 'prestationsoins', 'ticketmoderateurs','assures', 
                    'etablissements', 'acteassurances', 'affectionassurances'));

    }
    
    public function dashCaissePrestationHospitalisations(Request $request)
    {

    	$page_title = "Nos Prestation d'Hospitalisations";

    	$prestationhospitalisations = PrestationSoins::all();
        $ticketmoderateurs = TicketModerateurs::all();
        $caisses = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'Caisse');
                            })->get();
        $assures = User::Where(function ($query) {
                            $query->where('role', 'Assure');
                        })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();
        $acteassurances = ActeAssurances::all();
        $affectionassurances = AffectionAssurances::all();

        return view('backend.caisse.dashCaissePrestationHospitalisations', compact('page_title', 'caisses', 'assurances', 'prestationhospitalisations', 'ticketmoderateurs','assures', 
                    'etablissements', 'acteassurances', 'affectionassurances'));

    }

        	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    public function newPrestationSoinCaisse(Request $request)
    {

        $new_prestation = new PrestationSoins();

    	// Get new data 
        $new_prestation->visite_domicile = $request->input('visite_domicile');
        $new_prestation->montant = $request->input('montant');
        $new_prestation->forfait_deplacement = $request->input('forfait_deplacement');
        $new_prestation->montant_payer = $request->input('montant_payer');
        $new_prestation->total = $request->input('total');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->affection_assurance_id = $request->input('affection_assurance_id');
        $new_prestation->acte_assurance_id = $request->input('acte_assurance_id ');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->ticket_moderateur_id = $request->input('ticket_moderateur_id');
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
    
    public function showPrestationSoinCaisse(Request $request, $id)
    {

    	$page_title = "Détails Appareillage";

    	$prestationsoin = PrestationSoins::find($id);

        return view('backend.caisse.showPrestationSoinCaisse', compact('prestationsoin', 'page_title'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                            #
    #                                                                                            #
    ##############################################################################################
    
    public function editPrestationSoinCaisse(Request $request, $id)
    {

    	$page_title = "Editer Prestation Soins";

    	$prestationsoin = PrestationSoins::find($id);

        return view('backend.caisse.editPrestationSoinCaisse', compact('prestationsoin', 'page_title'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  UPDATE ROUTING                                            #
    #                                                                                            #
    ##############################################################################################
    
    public function updatePrestationSoinCaisse(Request $request)
    {

    	$prestationsoin_id = $request->input('prestationsoin_id');
    	$new_prestationsoin = PrestationSoins::find($prestationsoin_id);

    	// Get new data 
        $new_prestationsoin->visite_domicile = $request->input('visite_domicile');
        $new_prestationsoin->montant = $request->input('montant');
        $new_prestationsoin->forfait_deplacement = $request->input('forfait_deplacement');
        $new_prestationsoin->montant_payer = $request->input('montant_payer');
        $new_prestationsoin->total = $request->input('total');
        $new_prestationsoin->praticien = $request->input('praticien');
        $new_prestationsoin->affection_assurance_id = $request->input('affection_assurance_id');
        $new_prestationsoin->acte_assurance_id = $request->input('acte_assurance_id');
        $new_prestationsoin->assurance_id = $request->input('assurance_id');
        $new_prestationsoin->assure = $request->input('assure');
        $new_prestationsoin->ticket_moderateur_id = $request->input('ticket_moderateur_id');
        $new_prestationsoin->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestationsoin->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }

}