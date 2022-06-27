<?php

namespace App\Http\Controllers;

use App\Models\ActeAssurances;
use App\Models\Affections;
use App\User;
use App\Models\MedicamentEtablissements;
use App\Models\PrestationCaisses;
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
        $adminetablissement_id = Auth::user()->etablissement_id;
    	$adminetablissement = User::find($user_id);
        $adminetab = Etablissements::find($adminetablissement_id);

        // Count prestations
        $count_prestations = PrestationCaisses::all()->count();

	    return view('backend.caisse.dashCaisseEtablissement', compact('page_title', 'count_prestations','adminetab', ));

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

        return view('backend.caisse.dashCaisseEtablissementPrestations', compact('page_title', 'caisses', 'assurances', 'prestation_etablissements', 'ticketmoderateurs','assures', 
                    'etablissements', 'typeassures','prestation_caisses',));

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
        $new_prestation->type_assure_id = $request->input('type_assure_id');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->assurance_id = $request->input('assurance_id');
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

        return view('backend.caisse.showPrestationCaisseEtablissement', compact('prestation', 'page_title'));

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

        return view('backend.caisse.editPrestationCaisseEtablissement', compact('prestation', 'page_title'));

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
        $new_prestation->type_assure_id = $request->input('type_assure_id');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }

}