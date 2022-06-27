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
use App\Models\PrestationSoins;
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
        $praticien_id = Auth::user()->etablissement_id;
        $praticien = User::find($user_id);
        $praticienetablissement = Etablissements::find($praticien_id);

        // Count prestations de soins
        $count_prestations = PrestationSoins::all()->count();

        // Count assures
        $count_assures = Assures::all()->count();

        return view('backend.praticienetablissement.dashPraticienEtablissement', compact('page_title', 'count_prestations', 'praticienetablissement' ));

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
        $ticketmoderateurs = TicketModerateurs::all();
        $praticiens = User::where('etablissement_id', Auth::user()->etablissement_id)
                            ->Where(function ($query) {
                                $query->where('role', 'PharmacienEtablissement')
                                ->orWhere('role', 'PraticienEtablissement')
                                ->orWhere('role', 'InfirmierEtablissement')
                                ->orWhere('role', 'LaborantinEtablissement');
                            })->get();
        $assures = User::Where(function ($query) {
                            $query->where('role', 'Assure');
                        })->get();
        $etablissements = Etablissements::where('id', Auth::user()->etablissement_id);
        $assurances = Assurance::all();
        $acteassurances = ActeAssurances::all();
        $affectionassurances = AffectionAssurances::all();

        return view('backend.praticienetablissement.dashPraticienEtablissementPrestationSoins', compact('page_title', 'praticiens', 'assurances', 'prestationsoins', 'ticketmoderateurs','assures', 
                    'etablissements', 'acteassurances', 'affectionassurances'));
    }



}