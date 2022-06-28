<?php

namespace App\Http\Controllers;

use App\User;

use App\Models\ActeAssurances;
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
use App\Models\Etablissements;
use App\Models\MedicamentEtablissements;
use App\Models\AppareillageEtablissements;
use App\Models\PrestationSoins;
use App\Models\PriseCharges;
use App\Models\PrescriptionMedicaleCaisses;
use App\Models\PrestationExamens;
use App\Models\PrestationHospitalisations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PharmacienEtablissementController extends Controller
{
    public function dashPharamacienEtablissement(Request $request)
    {
        $page_title = "Tableau de bord";

        $user_id = Auth::user()->id;
        $pharmacien_id = Auth::user()->etablissement_id;
        $pharmacien = User::find($user_id);
        $pharmacienetablissement = Etablissements::find($pharmacien_id);

        // Count  medicaments
        $count_medicaments = MedicamentEtablissements::all()->count();

        // Count  prescriptions
        $count_prescriptions = PrescriptionMedicaleCaisses::all()->count();

        // Count  appareillages
        $count_appareillages = AppareillageEtablissements::all()->count();

        return view('backend.praticienetablissement.dashPraticienEtablissement', compact('page_title', 'pharmacienetablissement', 'count_medicaments', 'count_appareillages', 'count_prescriptions'));
    }
    
           	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  DASH ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    public function dashPharamacienEtablissementPrescriptionMedicales(Request $request)
    {
        $page_title = "Nos Prescription Medicales";

    	$prescriptionnmedicales = PrescriptionMedicaleCaisses::all();
        $praticiens = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'PraticienEtablissement');
                            })->get();
        $assures = User::Where(function ($query) {
                                $query->where('role', 'Assure');
                            })->get();
        $ayantdroits = User::Where(function ($query) {
                                $query->where('role', 'AyantDroit');
                            })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();
        return view('backend.pharmacienetablissement.dashPharamacienEtablissementPrescriptionMedicales', compact('page_title', 'praticiens', 'assurances', 'prescriptionnmedicales', 'assures', 
                    'etablissements', 'ayantdroits'));
    }

            
    	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                               #
    #                                                                                            #
    ##############################################################################################

    public function newPrescriptionMedicalePharamacienEtablissement (Request $request)
    {

        $new_prestation = new PrescriptionMedicaleCaisses();

    	// Get new data 
        $new_prestation->prescription_medicale_id = $request->input('prescription_medicale_id');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->feuillesoins_id = $request->input('feuillesoins_id');
        $new_prestation->montant = $request->input('montant ');
        $new_prestation->montantpayer = $request->input('montantpayer ');
        $new_prestation->ticketmoderateur_id = $request->input('ticketmoderateur_id ');
        $new_prestation->total = $request->input('total ');
        $new_prestation->caisse = $request->input('caisse ');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
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

    public function updatePrescriptionMedicalePharamacienEtablissement (Request $request)
    {

        $prestation_id = $request->input('prestation_id');
    	$new_prestation = PrescriptionMedicaleCaisses::find($prestation_id);

    	// Get new data 
        $new_prestation->prescription_medicale_id = $request->input('prescription_medicale_id');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->feuillesoins_id = $request->input('feuillesoins_id');
        $new_prestation->montant = $request->input('montant ');
        $new_prestation->montantpayer = $request->input('montantpayer ');
        $new_prestation->ticketmoderateur_id = $request->input('ticketmoderateur_id ');
        $new_prestation->total = $request->input('total ');
        $new_prestation->caisse = $request->input('caisse ');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
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

    public function showPrescriptionMedicalePharamacienEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prestationsoin = PrescriptionMedicaleCaisses::find($id);

        return view('backend.pharmacienetablissement.showPrescriptionMedicalePharamacienEtablissement', compact('prestationsoin', 'page_title'));

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
    public function editPrescriptionMedicalePharamacienEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PrescriptionMedicaleCaisses::find($id);

        return view('backend.pharmacienetablissement.editPrescriptionMedicalePharamacienEtablissement', compact('prestation', 'page_title'));

    }

}