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

    	$superadmin_id = Auth::user()->id;
    	$superadmin = User::find($superadmin_id);

	    return view('backend.adminetablissement.dashAdminEtablissement', compact('page_title'));

    }


}