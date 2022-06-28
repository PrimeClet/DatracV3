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
        $count_prestations = 0;
        $assurances = Assurance::all();
        $prestation_etablissements = PrestationEtablissements::where('etablissement_id', $caisseetablissement_id)->get();
//        $count_prestations = PrestationCaisses::all()->count();

	    return view('backend.caisseetablissement.dashCaisseEtablissement', compact('page_title', 'assurances',
            'prestation_etablissements', 'caisseetablissement', 'count_prestations'));

    }

            	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  DASH ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    public function createFicheSoin(Request $request){
        $caissier = Auth::user();
        $assure = User::where('id', $request['assure_id'])->first();
        $assurance = Assurance::where('id', $request['assurance_id'])->first();
        $assureId = null;
        $ayantId = null;
        if ($assure->role == 'Assure')
            $assureId = $assure->id;
        if ($assure->role == 'AyantDroit')
            $ayantId =  $assure->role;

        $CreateFeuille = feuilleSoins::create([
            'n_feuille'=> $request['n_feuille'],
            'date_caissier'=> Carbon::now(),
            'typeAssure'=> $assure->role,
            'nom_prenomP'=> $assure->name,
            'telephoneP'=> $assure->telephone,
            'date_naisP'=> $assure->datenaiss,
            'n_matriculeP'=> $assure->matricule,
            'signatureP' => $assure->name,
            'etablissement_id' => $caissier->etablissement_id,
            'nomEtablissement' => (Etablissements::where('id', $caissier->etablissement_id)->first())->nom_etablissement,
            'assure_id' => $assureId,
            'ayant_droit_id' => $ayantId,
        ]);

        Session::flash('alert-class', 'alert-primary');
        return response()->json('Complete', 200);
    }


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

    /**
     * @param Request $request
     * @return false|string
     */
    public function search(Request $request)
    {
        $member = $request->get('name');
        $data =  DB::table('users')->where('name','LIKE','%'.$member.'%')
            ->get();
        if ($data->count() > 0) {
            return json_encode([
                'status' => 200,
                'assures' => $data
            ]);
        } else {
            return json_encode([
                'status' => 202,
                'assures' => $data
            ]);
        }

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
