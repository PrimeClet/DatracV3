<?php

namespace App\Http\Controllers;

use App\User;

use App\Models\ActeAssurances;
use App\Models\TicketModerateurs;
use App\Models\Prestations;
use App\Models\Medicament;
use App\Models\Examens;
use App\Models\Appareillages;
use App\Models\Affections;
use App\Models\Assurance;
use App\Models\Etablissements;
use App\Models\PrestationSoins;
use App\Models\PriseCharges;
use App\Models\PrescriptionMedicales;
use App\Models\PrestationExamens;
use App\Models\PrestationHospitalisations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PraticienEtablissementController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashPraticienEtablissement(Request $request)
    {
        $page_title = "Tableau de bord";

        $user_id = Auth::user()->id;
        $praticienetablissement_id = Auth::user()->etablissement_id;
        $praticien = User::find($user_id);
        $praticienetablissement = Etablissements::find($praticienetablissement_id);

        // Count prestations de soins
        $count_prestationsoins = PrestationSoins::all()->count();

        // Count prestations examens
        $count_prestationexamens = PrestationExamens::all()->count();

        // Count prestations de soins
        $count_prestationhospitalisations = PrestationHospitalisations::all()->count();

        // Count prescription medicale
        $count_prescriptionmedicales = PrescriptionMedicales::all()->count();

        // Count prestations de soins
        $count_prisecharges = PriseCharges::all()->count();

        return view('backend.praticienetablissement.dashPraticienEtablissement', compact('page_title', 'count_prestationsoins', 'count_prestationexamens', 'praticienetablissement',
                    'count_prestationhospitalisations', 'count_prescriptionmedicales', 'count_prisecharges'));

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
    public function dashPraticienEtablissementPrestationSoins(Request $request)
    {
        $page_title = "Nos Prestation de Soins";

    	$prestationsoins = PrestationSoins::all();
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
        $acteassurances = ActeAssurances::all();
        $affections = Affections::all();

        return view('backend.praticienetablissement.dashPraticienEtablissementPrestationSoins', compact('page_title', 'praticiens', 'assurances', 'prestationsoins', 'assures', 
                    'etablissements', 'acteassurances', 'affections', 'ayantdroits'));
    }

    public function dashPraticienEtablissementPriseCharges(Request $request)
    {

    	$page_title = "Nos Prise en Charges";

    	$prisecharges = PriseCharges::all();
        $ticketmoderateurs = TicketModerateurs::all();
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

        return view('backend.praticienetablissement.dashPraticienEtablissementPriseCharges', compact('page_title', 'praticiens', 'assurances', 'prisecharges', 
                    'ticketmoderateurs','assures', 'etablissements', 'ayantdroits'));

    }

    public function dashPraticienEtablissementPrescriptionMedicales(Request $request)
    {
        $page_title = "Nos Prescription Medicales";

    	$prescriptionnmedicales = PrescriptionMedicales::all();
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
        $medicaments = Medicament::all();
        $appareillages = Appareillages::all();

        return view('backend.praticienetablissement.dashPraticienEtablissementPrescriptionMedicales', compact('page_title', 'praticiens', 'assurances', 'prescriptionnmedicales', 'assures', 
                    'etablissements', 'medicaments', 'appareillages', 'ayantdroits'));
    }

    public function dashPraticienEtablissementPrestationExamens(Request $request)
    {
        $page_title = "Nos Prestation Examens";

    	$prestationexamens = PrestationExamens::all();
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
        $examens = Examens::all();

        return view('backend.praticienetablissement.dashPraticienEtablissementPrestationExamens', compact('page_title', 'praticiens', 'assurances', 'prestationexamens', 'assures', 
                    'etablissements', 'examens', 'ayantdroits'));
    }

    public function dashPraticienEtablissementPrestationHospitalisations(Request $request)
    {
        $page_title = "Nos Prestation Hospitalisations";

    	$prestationhospitalisations = PrestationHospitalisations::all();
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
        $prestations = Prestations::all();
        $acteassurances = ActeAssurances::all();

        return view('backend.praticienetablissement.dashPraticienEtablissementPrestationHospitalisations', compact('page_title', 'praticiens', 'assurances', 'assures', 
                    'etablissements', 'acteassurances', 'ayantdroits', 'prestations'));
    }

        
    	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  NEW ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

            
    public function newPrestationSoinPraticienEtablissement (Request $request)
    {

        $new_prestation = new PrestationSoins();

    	// Get new data 
        $new_prestation->visite_domicile = $request->input('visite_domicile');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->affection_assurance_id = $request->input('affection_assurance_id');
        $new_prestation->acte_assurance_id = $request->input('acte_assurance_id ');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }

    public function newPriseChargePraticienEtablissement(Request $request)
    {

        $new_prisecharge = new PriseCharges();

    	// Get new data 
        $new_prisecharge->accident_tiers = $request->input('accident_tiers');
        $new_prisecharge->date_accident = $request->input('date_accident');
        $new_prisecharge->soins_grossesse = $request->input('soins_grossesse');
        $new_prisecharge->debut_grossesse = $request->input('debut_grossesse');
        $new_prisecharge->date_accouchement = $request->input('date_accouchement');
        $new_prisecharge->assure_id = $request->input('assure_id');
        $new_prisecharge->ticket_moderateur_id = $request->input('ticket_moderateur_id');
        $new_prisecharge->praticien = $request->input('praticien');
        $new_prisecharge->assurance_id = $request->input('assurance_id');
        $new_prisecharge->etablissement_id = Auth::user()->etablissement_id;

        if($new_prisecharge->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }

    public function newPrescriptionMedicalePraticienEtablissement(Request $request)
    {
        $new_prescriptionmedicale = new PrescriptionMedicales();

        // Get new data
        $new_prescriptionmedicale->assure_id = $request->input('assure_id');
        $new_prescriptionmedicale->medicament_id = $request->input('medicament_id');
        $new_prescriptionmedicale->appareillage_id = $request->input('appareillage_id');
        $new_prescriptionmedicale->posologie = $request->input('posologie');
        $new_prescriptionmedicale->praticien = $request->input('praticien');
        $new_prescriptionmedicale->quantite = $request->input('quantite');
        $new_prescriptionmedicale->assurance_id = $request->input('assurance_id');
        $new_prescriptionmedicale->etablissement_id = Auth::user()->etablissement_id;
        
        if($new_prescriptionmedicale->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');  
    }

    public function newPrestationExamenPraticienEtablissement (Request $request)
    {

        $new_prestation = new PrestationExamens();

    	// Get new data 
        $new_prestation->examen_id = $request->input('examen_id');
        $new_prestation->cotation_examen = $request->input('cotation_examen');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }

    public function newPrestationHospitalisationPraticienEtablissement (Request $request)
    {

        $new_prestation = new PrestationHospitalisations();

    	// Get new data 
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->acte_id = $request->input('acte_id');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
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
        
    public function updatePriseChargePraticienEtablissement(Request $request)
    {

    	$prisecharge_id = $request->input('prisecharge_id');
    	$new_prisecharge = PriseCharges::find($prisecharge_id);

    	// Get new data 
        $new_prisecharge->accident_tiers = $request->input('accident_tiers');
        $new_prisecharge->date_accident = $request->input('date_accident');
        $new_prisecharge->soins_grossesse = $request->input('soins_grossesse');
        $new_prisecharge->debut_grossesse = $request->input('debut_grossesse');
        $new_prisecharge->date_accouchement = $request->input('date_accouchement');
        $new_prisecharge->assure_id = $request->input('assure_id');
        $new_prisecharge->ticket_moderateur_id = $request->input('ticket_moderateur_id');
        $new_prisecharge->etablissement_id = Auth::user()->etablissement_id;

        if($new_prisecharge->save()){

            // Redirection
            return redirect()->back()->with('success', 'appareillage modifié avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de modifier cet appareillage !');

    }

    public function updatePrestationSoinPraticienEtablissement(Request $request)
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
    
    public function updatePrescriptionMedicalePraticienEtablissement(Request $request)
    {
        $prescriptionmedicale_id = $request->input('prescriptionmedicale_id');
    	$new_prescriptionmedicale = PrescriptionMedicales::find($prescriptionmedicale_id);

        // Get new data
        $new_prescriptionmedicale->assure_id = $request->input('assure_id');
        $new_prescriptionmedicale->medicament_id = $request->input('medicament_id');
        $new_prescriptionmedicale->appareillage_id = $request->input('appareillage_id');
        $new_prescriptionmedicale->posologie = $request->input('posologie');
        $new_prescriptionmedicale->praticien = $request->input('praticien');
        $new_prescriptionmedicale->quantite = $request->input('quantite');
        $new_prescriptionmedicale->assurance_id = $request->input('assurance_id');
        $new_prescriptionmedicale->etablissement_id = Auth::user()->etablissement_id;
        
        if($new_prescriptionmedicale->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');  
    }

    public function updatePrestationExamenPraticienEtablissement (Request $request)
    {

        $prestation_id = $request->input('prestation_id');
    	$new_prestation = PrestationExamens::find($prestation_id);

    	// Get new data 
        $new_prestation->examen_id = $request->input('examen_id');
        $new_prestation->cotation_examen = $request->input('cotation_examen');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
        $new_prestation->etablissement_id = Auth::user()->etablissement_id;

        if($new_prestation->save()){

            // Redirection
            return redirect()->back()->with('success', 'Nouvel Prise en charge crée avec succès !');
        }

        // Redirection
        return redirect()->back()->with('failed', 'Impossible de créer cette Prise en charge !');

    }

    public function updatePrestationHospitalisationPraticienEtablissement (Request $request)
    {

        $prestation_id = $request->input('prestation_id');
    	$new_prestation = PrestationHospitalisations::find($prestation_id);

    	// Get new data 
        $new_prestation->prestation_id = $request->input('prestation_id');
        $new_prestation->acte_id = $request->input('acte_id');
        $new_prestation->praticien = $request->input('praticien');
        $new_prestation->assurance_id = $request->input('assurance_id');
        $new_prestation->assure = $request->input('assure');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showPrestationSoinPraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prestationsoin = PrestationSoins::find($id);

        return view('backend.praticienetablissement.showPrestationSoinPraticienEtablissement', compact('prestationsoin', 'page_title'));

    }

    public function showPriseChargePraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prisecharge = PriseCharges::find($id);

        return view('backend.praticienetablissement.showPriseChargePraticienEtablissement', compact('prisecharge', 'page_title'));

    }

    public function showPrescriptionMedicalePraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prescriptionmedicale = PrescriptionMedicales::find($id);

        return view('backend.praticienetablissement.showPrescriptionMedicalePraticienEtablissement', compact('prescriptionmedicale', 'page_title'));

    }

    public function showPrestationExamenPraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prescriptionexamen = PrestationExamens::find($id);

        return view('backend.praticienetablissement.showPrestationExamenPraticienEtablissement', compact('prescriptionexamen', 'page_title'));

    }

    public function showPrestationHospitalisationPraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Détails Prestations";

    	$prescriptionhospitalisation = PrestationHospitalisations::find($id);

        return view('backend.praticienetablissement.showPrestationHospitalisationPraticienEtablissement', compact('prescriptionhospitalisation', 'page_title'));

    }

    ##############################################################################################
    #                                                                                            #
    #                                  AdminAssurance ROUTING                                    #
    #                                                                                            #
    ##############################################################################################
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editPrestationSoinPraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PrestationSoins::find($id);

        return view('backend.praticienetablissement.editPrestationSoinPraticienEtablissement', compact('prestation', 'page_title'));

    }

    public function editPriseChargePraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PriseCharges::find($id);

        return view('backend.praticienetablissement.editPriseChargePraticienEtablissement', compact('prestation', 'page_title'));

    }

    public function editPrescriptionMedicalePraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PrescriptionMedicales::find($id);

        return view('backend.praticienetablissement.editPrescriptionMedicalePraticienEtablissement', compact('prestation', 'page_title'));

    }
    
    public function editPrestationExamenPraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PrestationExamens::find($id);

        return view('backend.praticienetablissement.editPrestationExamenPraticienEtablissement', compact('prestation', 'page_title'));

    }
        
    public function editPrestationHospitalisationPraticienEtablissement(Request $request, $id)
    {

    	$page_title = "Editer Prestation";

    	$prestation = PrestationHospitalisations::find($id);

        return view('backend.praticienetablissement.editPrestationHospitalisationPraticienEtablissement', compact('prestation', 'page_title'));

    }




}