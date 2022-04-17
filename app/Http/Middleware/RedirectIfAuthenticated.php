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
              //case 'Admin':
                // Redirection
                //return redirect()->route('dashAdmin');
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
