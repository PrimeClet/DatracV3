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

    /* CRUD Actes */
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

    /* CRUD Examens */
    Route::get('dashboard/superadmin/nos-examens', 'SuperAdminController@dashSuperAdminExamens')->name('dashSuperAdminExamens');
    Route::post('dashboard/superadmin/nouvel-examen', 'SuperAdminController@newExamenSuperAdmin')->name('newExamenSuperAdmin');
    Route::get('dashboard/superadmin/show-examen/{id}', 'SuperAdminController@showExamenSuperAdmin')->name('showExamenSuperAdmin');
    Route::get('dashboard/superadmin/edit-examen/{id}', 'SuperAdminController@editExamenSuperAdmin')->name('editExamenSuperAdmin');
    Route::post('dashboard/superadmin/update-examen', 'SuperAdminController@updateExamenSuperAdmin')->name('updateExamenSuperAdmin');

    /* CRUD Prestations */
    Route::get('dashboard/superadmin/nos-prestations', 'SuperAdminController@dashSuperAdminPrestations')->name('dashSuperAdminPrestations');
    Route::post('dashboard/superadmin/nouvel-prestation', 'SuperAdminController@newPrestationSuperAdmin')->name('newPrestationSuperAdmin');
    Route::get('dashboard/superadmin/show-prestation/{id}', 'SuperAdminController@showPrestationSuperAdmin')->name('showPrestationSuperAdmin');
    Route::get('dashboard/superadmin/edit-prestation/{id}', 'SuperAdminController@editPrestationSuperAdmin')->name('editPrestationSuperAdmin');
    Route::post('dashboard/superadmin/update-prestation', 'SuperAdminController@updatePrestationSuperAdmin')->name('updatePrestationSuperAdmin');

    /* CRUD Villes */
    Route::get('dashboard/superadmin/nos-villes', 'SuperAdminController@dashSuperAdminVilles')->name('dashSuperAdminVilles');
    Route::post('dashboard/superadmin/nouvel-ville', 'SuperAdminController@newVilleSuperAdmin')->name('newVilleSuperAdmin');
    Route::get('dashboard/superadmin/show-ville/{id}', 'SuperAdminController@showVilleSuperAdmin')->name('showVilleSuperAdmin');
    Route::get('dashboard/superadmin/edit-ville/{id}', 'SuperAdminController@editVilleSuperAdmin')->name('editVilleSuperAdmin');
    Route::post('dashboard/superadmin/update-ville', 'SuperAdminController@updateVilleSuperAdmin')->name('updateVilleSuperAdmin');

    /* CRUD Specialites */
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

    /* Start Routing for AdminEtablissement's User */
    Route::get('dashboard/adminetablissement', 'AdminEtablissementController@dashAdminEtablissement')->name('dashAdminEtablissement');

    /* CRUD Medicaments */
    Route::get('dashboard/adminetablissement/nos-medicaments', 'AdminEtablissementController@dashAdminEtablissementMedicaments')->name('dashAdminEtablissementMedicaments');
    Route::post('dashboard/adminetablissement/nouvel-medicament', 'AdminEtablissementController@newMedicamentAdminEtablissement')->name('newMedicamentAdminEtablissement');
    Route::get('dashboard/adminetablissement/show-medicament/{id}', 'AdminEtablissementController@showMedicamentAdminEtablissement')->name('showMedicamentAdminEtablissement');
    Route::get('dashboard/adminetablissement/edit-medicament/{id}', 'AdminEtablissementController@editMedicamentAdminEtablissement')->name('editMedicamentAdminEtablissement');
    Route::post('dashboard/adminetablissement/update-medicament', 'AdminEtablissementController@updateMedicamentAdminEtablissement')->name('updateMedicamentAdminEtablissement');

     /* CRUD Prestations */
     Route::get('dashboard/adminetablissement/nos-prestations', 'AdminEtablissementController@dashAdminEtablissementPrestations')->name('dashAdminEtablissementPrestations');
     Route::post('dashboard/adminetablissement/nouvel-prestation', 'AdminEtablissementController@newPrestationAdminEtablissement')->name('newPrestationAdminEtablissement');
     Route::get('dashboard/adminetablissement/show-prestation/{id}', 'AdminEtablissementController@showPrestationAdminEtablissement')->name('showPrestationAdminEtablissement');
     Route::get('dashboard/adminetablissement/edit-prestation/{id}', 'AdminEtablissementController@editPrestationAdminEtablissement')->name('editPrestationAdminEtablissement');
     Route::post('dashboard/adminetablissement/update-prestation', 'AdminEtablissementController@updatePrestationAdminEtablissement')->name('updatePrestationAdminEtablissement');

     /* CRUD Examens */
     Route::get('dashboard/adminetablissement/nos-examens', 'AdminEtablissementController@dashAdminEtablissementExamens')->name('dashAdminEtablissementExamens');
     Route::post('dashboard/adminetablissement/nouvel-examen', 'AdminEtablissementController@newExamenAdminEtablissement')->name('newExamenAdminEtablissement');
     Route::get('dashboard/adminetablissement/show-examen/{id}', 'AdminEtablissementController@showExamenAdminEtablissement')->name('showExamenAdminEtablissement');
     Route::get('dashboard/adminetablissement/edit-examen/{id}', 'AdminEtablissementController@editExamenAdminEtablissement')->name('editExamenAdminEtablissement');
     Route::post('dashboard/adminetablissement/update-examen', 'AdminEtablissementController@updateExamenAdminEtablissement')->name('updateExamenAdminEtablissement');

     /* CRUD Appareillages */
     Route::get('dashboard/adminetablissement/nos-appareillages', 'AdminEtablissementController@dashAdminEtablissementAppareillages')->name('dashAdminEtablissementAppareillages');
     Route::post('dashboard/adminetablissement/nouvel-appareillage', 'AdminEtablissementController@newAppareillageAdminEtablissement')->name('newAppareillageAdminEtablissement');
     Route::get('dashboard/adminetablissement/show-appareillage/{id}', 'AdminEtablissementController@showAppareillageAdminEtablissement')->name('showAppareillageAdminEtablissement');
     Route::get('dashboard/adminetablissement/edit-appareillage/{id}', 'AdminEtablissementController@editAppareillageAdminEtablissement')->name('editAppareillageAdminEtablissement');
     Route::post('dashboard/adminetablissement/update-appareillage', 'AdminEtablissementController@updateAppareillageAdminEtablissement')->name('updateAppareillageAdminEtablissement');

    /* End Routing for AdminEtablissement's User */

    ##############################################################################################
    #                                                                                            #
    #                                  AdminEtablissement ROUTING                                #
    #                                                                                            #
    ##############################################################################################

     ##############################################################################################
    #                                                                                            #
    #                                  AdminAssurance ROUTING                                #
    #                                                                                            #
    ##############################################################################################

     /* Start Routing for AdminEtablissement's User */
     Route::get('dashboard/adminassurance', 'AdminAssuranceController@dashAdminAssurance')->name('dashAdminAssurance');

     /* CRUD Actes */
     Route::get('dashboard/adminassurance/nos-actes', 'AdminAssuranceController@dashAdminAssuranceActes')->name('dashAdminAssuranceActes');
     Route::post('dashboard/adminassurance/nouvel-acte', 'AdminAssuranceController@newActeAdminAssurance')->name('newActeAdminAssurance');
     Route::get('dashboard/adminassurance/show-acte/{id}', 'AdminAssuranceController@showActeAdminAssurance')->name('showActeAdminAssurance');
     Route::get('dashboard/adminassurance/edit-acte/{id}', 'AdminAssuranceController@editActeAdminAssurance')->name('editActeAdminAssurance');
     Route::post('dashboard/adminassurance/update-acte', 'AdminAssuranceController@updateActeAdminAssurance')->name('updateActeAdminAssurance');

      /* CRUD Affections */
      Route::get('dashboard/adminassurance/nos-affections', 'AdminAssuranceController@dashAdminAssuranceAffections')->name('dashAdminAssuranceAffections');
      Route::post('dashboard/adminassurance/nouvel-affection', 'AdminAssuranceController@newAffectionAdminAssurance')->name('newAffectionAdminAssurance');
      Route::get('dashboard/adminassurance/show-affection/{id}', 'AdminAssuranceController@showAffectionAdminAssurance')->name('showAffectionAdminAssurance');
      Route::get('dashboard/adminassurance/edit-affection/{id}', 'AdminAssuranceController@editAffectionAdminAssurance')->name('editAffectionAdminAssurance');
      Route::post('dashboard/adminassurance/update-affection', 'AdminAssuranceController@updateAffectionAdminAssurance')->name('updateAffectionAdminAssurance');

       /* CRUD Appareillages */
       Route::get('dashboard/adminassurance/nos-appareillages', 'AdminAssuranceController@dashAdminAssuranceAppareillages')->name('dashAdminAssuranceAppareillages');
       Route::post('dashboard/adminassurance/nouvel-appareillage', 'AdminAssuranceController@newAppareillageAdminAssurance')->name('newAppareillageAdminAssurance');
       Route::get('dashboard/adminassurance/show-appareillage/{id}', 'AdminAssuranceController@showAppareillageAdminAssurance')->name('showAppareillageAdminAssurance');
       Route::get('dashboard/adminassurance/edit-appareillage/{id}', 'AdminAssuranceController@editAppareillageAdminAssurance')->name('editAppareillageAdminAssurance');
       Route::post('dashboard/adminassurance/update-appareillage', 'AdminAssuranceController@updateAppareillageAdminAssurance')->name('updateAppareillageAdminAssurance');

        /* CRUD Medicaments */
        Route::get('dashboard/adminassurance/nos-medicaments', 'AdminAssuranceController@dashAdminAssuranceMedicaments')->name('dashAdminAssuranceMedicaments');
        Route::post('dashboard/adminassurance/nouvel-medicament', 'AdminAssuranceController@newMedicamentAdminAssurance')->name('newMedicamentAdminAssurance');
        Route::get('dashboard/adminassurance/show-medicament/{id}', 'AdminAssuranceController@showMedicamentAdminAssurance')->name('showMedicamentAdminAssurance');
        Route::get('dashboard/adminassurance/edit-medicament/{id}', 'AdminAssuranceController@editMedicamentAdminAssurance')->name('editMedicamentAdminAssurance');
        Route::post('dashboard/adminassurance/update-medicament', 'AdminAssuranceController@updateMedicamentAdminAssurance')->name('updateMedicamentAdminAssurance');

        /* CRUD Examens */
        Route::get('dashboard/adminassurance/nos-examens', 'AdminAssuranceController@dashAdminAssuranceExamens')->name('dashAdminAssuranceExamens');
        Route::post('dashboard/adminassurance/nouvel-examen', 'AdminAssuranceController@newExamenAdminAssurance')->name('newExamenAdminAssurance');
        Route::get('dashboard/adminassurance/show-examen/{id}', 'AdminAssuranceController@showExamenAdminAssurance')->name('showExamenAdminAssurance');
        Route::get('dashboard/adminassurance/edit-examen/{id}', 'AdminAssuranceController@editExamenAdminAssurance')->name('editExamenAdminAssurance');
        Route::post('dashboard/adminassurance/update-examen', 'AdminAssuranceController@updateExamenAdminAssurance')->name('updateExamenAdminAssurance');

         /* CRUD Prestations */
         Route::get('dashboard/adminassurance/nos-prestations', 'AdminAssuranceController@dashAdminAssurancePrestations')->name('dashAdminAssurancePrestations');
         Route::post('dashboard/adminassurance/nouvel-prestation', 'AdminAssuranceController@newPrestationAdminAssurance')->name('newPrestationAdminAssurance');
         Route::get('dashboard/adminassurance/show-prestation/{id}', 'AdminAssuranceController@showPrestationAdminAssurance')->name('showPrestationAdminAssurance');
         Route::get('dashboard/adminassurance/edit-prestation/{id}', 'AdminAssuranceController@editPrestationAdminAssurance')->name('editPrestationAdminAssurance');
         Route::post('dashboard/adminassurance/update-prestation', 'AdminAssuranceController@updatePrestationAdminAssurance')->name('updatePrestationAdminAssurance');


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

