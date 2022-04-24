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
          case 'AdminAssurance':
            return '/dashboard/adminassurance';
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
