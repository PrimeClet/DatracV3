<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 

            switch ($role) {

              case 'SuperAdmin':
                // Redirection
                return redirect()->route('dashSuperAdmin');
                break;
              
              case 'AdminEtablissement':
                // Redirection
                return redirect()->route('dashAdminEtablissement');
                //break;
              case 'ManagerEtablissement':
                // Redirection
                return redirect()->route('dashManagerEtablissement');
                //break;
              case 'ComptableEtablissement':
                // Redirection
                return redirect()->route('dashComptableEtablissement');
                //break;
              case 'TiersPayantEtablissement':
                // Redirection
                return redirect()->route('dashTiersPayantEtablissement');
                //break;
              case 'CaisseEtablissement':
                // Redirection
                return redirect()->route('dashCaisseEtablissement');
                //break;
              case 'PharmacienEtablissement':
                // Redirection
                return redirect()->route('dashPharmacienEtablissement');
                //break;
              case 'PraticienEtablissement':
                // Redirection
                return redirect()->route('dashPraticienEtablissement');
                //break;
              case 'InfirmierEtablissement':
                // Redirection
                return redirect()->route('dashInfirmierEtablissement');
                //break;
              case 'LaborantinEtablissement':
                // Redirection
                return redirect()->route('dashLaborantinEtablissement');
                //break;

              case 'AdminAssurance':
                // Redirection
                return redirect()->route('dashAdminAssurance');
                //break;

              //case 'Operateur':
                // Redirection
                //return redirect()->route('dashOperateur');
                //break;
              //case 'Client':
                // Redirection
                //return redirect()->route('dashClient');
                //break; 

              default:
                return '/login'; 
                break;
            }
        }
        return $next($request);
    }
}
