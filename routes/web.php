<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth::routes();

/* route vers page d'accueil du système */
Route::get('/', function () {
    return view('auth.login');
});
/* Fin routage vers accueil */


/* route du site */

Route::get('/', 'SiteController@home')->name('home');
Route::post('deconnexion/', 'SiteController@logout')->name('logout');

/* Fin routage du site */


Route::middleware(['auth'])->group(function() {

    ##############################################################################################
    #                                                                                            #
    #                                  SuperAdmin ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /* Start Routing for SuperAdmin's User */
    Route::get('dashboard/superadmin', 'SuperAdminController@dashSuperAdmin')->name('dashSuperAdmin');

    Route::get('dashboard/superadmin/nos-actes', 'SuperAdminController@dashSuperAdminActes')->name('dashSuperAdminActes');
    Route::post('dashboard/superadmin/nouvel-acte', 'SuperAdminController@newActeSuperAdmin')->name('newActeSuperAdmin');
    Route::get('dashboard/superadmin/show-acte/{id}', 'SuperAdminController@showActeSuperAdmin')->name('showActeSuperAdmin');
    Route::get('dashboard/superadmin/edit-acte/{id}', 'SuperAdminController@editActeSuperAdmin')->name('editActeSuperAdmin');
    Route::post('dashboard/superadmin/update-acte', 'SuperAdminController@updateActeSuperAdmin')->name('updateActeSuperAdmin');

    /* CRUD ASSURANCES */
    Route::get('dashboard/superadmin/assurances', 'AssuranceController@dashSuperAdminAssurances')->name('dashSuperAdminAssurance');
    Route::post('dashboard/superadmin/nouvel-assurance', 'AssuranceController@newAssuranceSuperAdmin')->name('newAssuranceSuperAdmin');
    Route::get('dashboard/superadmin/show-assurance/{id}', 'AssuranceController@showAssuranceSuperAdmin')->name('showAssuranceSuperAdmin');
    Route::get('dashboard/superadmin/edit-assurance/{id}', 'AssuranceController@editAssuranceSuperAdmin')->name('editAssuranceSuperAdmin');
    Route::post('dashboard/superadmin/update-assurance', 'AssuranceController@updateAssuranceSuperAdmin')->name('updateAssuranceSuperAdmin');

    /* CRUD Etablissement */
    Route::get('dashboard/superadmin/etablissements', 'EtablissementsController@dashSuperAdminEtablissements')->name('dashSuperAdminEtablissement');
    Route::post('dashboard/superadmin/nouvel-etablissement', 'EtablissementsController@newEtablissementSuperAdmin')->name('newEtablissementSuperAdmin');
    Route::get('dashboard/superadmin/show-etablissement/{id}', 'EtablissementsController@showEtablissementSuperAdmin')->name('showEtablissementSuperAdmin');
    Route::get('dashboard/superadmin/edit-etablissement/{id}', 'EtablissementsController@editEtablissementSuperAdmin')->name('editEtablissementSuperAdmin');
    Route::post('dashboard/superadmin/update-etablissement', 'EtablissementsController@updateEtablissementSuperAdmin')->name('updateEtablissementSuperAdmin');

    /* CRUD Medicaments */
    Route::get('dashboard/superadmin/medicaments', 'MedicamentController@dashSuperAdminMedicament')->name('dashSuperAdminMedicament');
    Route::post('dashboard/superadmin/nouvel-medicament', 'MedicamentController@newMedicamentSuperAdmin')->name('newMedicamentSuperAdmin');
    Route::get('dashboard/superadmin/show-medicament/{id}', 'MedicamentController@showMedicamentSuperAdmin')->name('showMedicamentSuperAdmin');
    Route::get('dashboard/superadmin/edit-medicament/{id}', 'MedicamentController@editMedicamentSuperAdmin')->name('editMedicamentSuperAdmin');
    Route::post('dashboard/superadmin/update-medicament', 'MedicamentController@updateMedicamentSuperAdmin')->name('updateMedicamentSuperAdmin');



    Route::get('dashboard/superadmin/nos-examens', 'SuperAdminController@dashSuperAdminExamens')->name('dashSuperAdminExamens');
    Route::post('dashboard/superadmin/nouvel-examen', 'SuperAdminController@newExamenSuperAdmin')->name('newExamenSuperAdmin');
    Route::get('dashboard/superadmin/show-examen/{id}', 'SuperAdminController@showExamenSuperAdmin')->name('showExamenSuperAdmin');
    Route::get('dashboard/superadmin/edit-examen/{id}', 'SuperAdminController@editExamenSuperAdmin')->name('editExamenSuperAdmin');
    Route::post('dashboard/superadmin/update-examen', 'SuperAdminController@updateExamenSuperAdmin')->name('updateExamenSuperAdmin');

    Route::get('dashboard/superadmin/nos-prestations', 'SuperAdminController@dashSuperAdminPrestations')->name('dashSuperAdminPrestations');
    Route::post('dashboard/superadmin/nouvel-prestation', 'SuperAdminController@newPrestationSuperAdmin')->name('newPrestationSuperAdmin');
    Route::get('dashboard/superadmin/show-prestation/{id}', 'SuperAdminController@showPrestationSuperAdmin')->name('showPrestationSuperAdmin');
    Route::get('dashboard/superadmin/edit-prestation/{id}', 'SuperAdminController@editPrestationSuperAdmin')->name('editPrestationSuperAdmin');
    Route::post('dashboard/superadmin/update-prestation', 'SuperAdminController@updatePrestationSuperAdmin')->name('updatePrestationSuperAdmin');

    Route::get('dashboard/superadmin/nos-villes', 'SuperAdminController@dashSuperAdminVilles')->name('dashSuperAdminVilles');
    Route::post('dashboard/superadmin/nouvel-ville', 'SuperAdminController@newVilleSuperAdmin')->name('newVilleSuperAdmin');
    Route::get('dashboard/superadmin/show-ville/{id}', 'SuperAdminController@showVilleSuperAdmin')->name('showVilleSuperAdmin');
    Route::get('dashboard/superadmin/edit-ville/{id}', 'SuperAdminController@editVilleSuperAdmin')->name('editVilleSuperAdmin');
    Route::post('dashboard/superadmin/update-ville', 'SuperAdminController@updateVilleSuperAdmin')->name('updateVilleSuperAdmin');

    Route::get('dashboard/superadmin/nos-specialites', 'SuperAdminController@dashSuperAdminSpecialites')->name('dashSuperAdminSpecialites');
    Route::post('dashboard/superadmin/nouvel-specialite', 'SuperAdminController@newSpecialiteSuperAdmin')->name('newSpecialiteSuperAdmin');
    Route::get('dashboard/superadmin/show-specialite/{id}', 'SuperAdminController@showSpecialiteSuperAdmin')->name('showSpecialiteSuperAdmin');
    Route::get('dashboard/superadmin/edit-specialite/{id}', 'SuperAdminController@editSpecialiteSuperAdmin')->name('editSpecialiteSuperAdmin');
    Route::post('dashboard/superadmin/update-specialite', 'SuperAdminController@updateSpecialiteSuperAdmin')->name('updateSpecialiteSuperAdmin');

    /* End Routing for SuperAdmin's User */

    ##############################################################################################
    #                                                                                            #
    #                                  SUPERADMIN ROUTING                                        #
    #                                                                                            #
    ##############################################################################################

    ##############################################################################################
    #                                                                                            #
    #                                  AdminEtablissement ROUTING                                #
    #                                                                                            #
    ##############################################################################################

    /* Start Routing for SuperAdmin's User */
    Route::get('dashboard/adminetablissement', 'AdminEtablissementController@dashAdminEtablissement')->name('dashAdminEtablissement');

    /* End Routing for SuperAdmin's User */

    ##############################################################################################
    #                                                                                            #
    #                                  AdminEtablissement ROUTING                                #
    #                                                                                            #
    ##############################################################################################

});

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cache cleared</h1>';
});

//Clear Config cache:
Route::get('/proc-open-error', function() {
    $exitCode = Artisan::call('vendor:publish', ['--tag' => 'flare-config']);
    return '<h1>Proc open error resolved -> Think to change parameters in config/flare.php !!!</h1>';
});

//Storage route link
Route::get('/any-route', function () {
	$exitCode = Artisan::call('storage:link');
    echo $exitCode; // 0 exit code for no errors.
});

Auth::routes();

