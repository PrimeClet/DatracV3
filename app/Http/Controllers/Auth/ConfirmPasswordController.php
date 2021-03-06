<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Support\Facades\Auth;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    public function redirectTo() {

        $role = Auth::user()->role; 

        switch ($role) {

          case 'SuperAdmin':
            return '/dashboard/superadmin';
            break;
          
          case 'AdminEtablissement':
            return '/dashboard/adminetablissement';
            break;
            case 'ManagerEtablissement':
              return '/dashboard/manageretablissement';
              break;
            case 'ComptableEtablissement':
              return '/dashboard/comptableetablissement';
              break;
            case 'TiersPayantEtablissement':
              return '/dashboard/tierspayantetablissement';
              break;
            case 'CaisseEtablissement':
              return '/dashboard/caisseetablissement';
              break;
            case 'PharmacienEtablissement':
              return '/dashboard/caisseetablissement';
              break;
            case 'PraticienEtablissement':
              return '/dashboard/praticienetablissement';
              break;
            case 'InfirmierEtablissement':
              return '/dashboard/infirmieretablissement';
              break;
            case 'LaborantinEtablissement':
              return '/dashboard/laborantinetablissement';
              break;

            case 'AdminAssurance':
              return '/dashboard/adminassurance';
              break;
            case 'ManagerAssurance':
              return '/dashboard/managerassurance';
              break;
            case 'ComptableAssurance':
              return '/dashboard/comptableassurance';
              break;
            case 'TiersPayantAssurance':
              return '/dashboard/tierspayantassurance';
              break;
            case 'AdminAssurance':
              return '/dashboard/medecinassurance';
              break;
            
            case 'Assure':
              return '/dashboard/assure';
              break;
            case 'AyantDroit':
              return '/dashboard/ayantdroit';
              break;
          
            /*case 'Operateur':
              return '/dashboard/operateur';
              break;
            case 'Client':
              return '/dashboard/client';
              break;*/ 

            default:
              return '/'; 
              break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
