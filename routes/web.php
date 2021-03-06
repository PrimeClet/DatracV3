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

/* Lien pour se déconnecter */
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

/* route du site */

Route::get('/', 'SiteController@home')->name('home');
Route::post('deconnexion/', 'SiteController@logout')->name('logout');

/* Fin routage du site */


Route::middleware(['auth'])->group(function() {

    	/* Les routes du système seront enumérés ici ! */

	/* Les routes du root seront enumérés ici ! */

    ##############################################################################################
    #                                                                                            #
    #                                  ROOT ROUTING                                              #
    #                                                                                            #
    ##############################################################################################

    /* Start Routing for Root's User */
    Route::get('dashboard/superadmin', 'SuperAdminController@dashboardSuperAdmin')->name('dashboardSuperAdmin');

    // Gestion du compte
    Route::get('dashboard/superadmin/profil', 'SuperAdminController@profilSuperAdmin')->name('profilSuperAdmin');
    Route::post('dashboard/superadmin/modifier-profil', 'SuperAdminController@updateProfilSuperAdmin')->name('updateProfilSuperAdmin');
    Route::post('dashboard/superadmin/modifier-mot-de-passe', 'SuperAdminController@updateMotDePasseSuperAdmin')->name('updateMotDePasseSuperAdmin');


     // Gestion des Super Administrateurs
    Route::get('dashboard/superadmin/superadmins', 'SuperAdminController@dashSuperAdminSuper')->name('dashSuperAdminSuper');
    Route::post('dashboard/superadmin/update-superadmin/', 'SuperAdminController@updateSuperAdminSuper')->name('updateSuperAdminSuper');
    Route::post('dashboard/superadmin/nouvel-superadmin', 'SuperAdminController@newSuperAdminSuper')->name('newSuperAdminSuper');
    Route::get('dashboard/superadmin/show-superadmin/{id}', 'SuperAdminController@showSuperSuperAdmin')->name('showSuperSuperAdmin');
    Route::get('dashboard/superadmin/edit-superadmin/{id}', 'SuperAdminController@editSuperSuperAdmin')->name('editSuperSuperAdmin');
    Route::post('dashboard/superadmin/delete-superadmin/{id}', 'SuperAdminController@deleteSuperSuperAdmin')->name('deleteSuperSuperAdmin');

    // Gestion des Administrateurs Etablissement
    Route::get('dashboard/superadmin/adminetablissements', 'SuperAdminController@dashSuperAdminEtab')->name('dashSuperAdminEtab');
    Route::post('dashboard/superadmin/update-adminetablissement/', 'SuperAdminController@updateSuperAdminEtab')->name('updateSuperAdminEtab');
    Route::post('dashboard/superadmin/nouvel-adminetablissement', 'SuperAdminController@newSuperAdminEtab')->name('newSuperAdminEtab');
    Route::get('dashboard/superadmin/show-adminetablissement/{id}', 'SuperAdminController@showEtabSuperAdmin')->name('showEtabSuperAdmin');
    Route::get('dashboard/superadmin/edit-adminetablissement/{id}', 'SuperAdminController@editEtabSuperAdmin')->name('editEtabSuperAdmin');
    Route::post('dashboard/superadmin/delete-adminetablissement/{id}', 'SuperAdminController@deleteEtabSuperAdmin')->name('deleteEtabSuperAdmin');

    // Gestion des Administrateurs Assurance
    Route::get('dashboard/superadmin/adminassurances', 'SuperAdminController@dashSuperAdminAssu')->name('dashSuperAdminAssu');
    Route::post('dashboard/superadmin/update-adminassurance/', 'SuperAdminController@updateSuperAdminAssu')->name('updateSuperAdminAssu');
    Route::post('dashboard/superadmin/nouvel-adminassurance', 'SuperAdminController@newSuperAdminAssu')->name('newSuperAdminAssu');
    Route::get('dashboard/superadmin/show-adminassurance/{id}', 'SuperAdminController@showAssuSuperAdmin')->name('showAssuSuperAdmin');
    Route::get('dashboard/superadmin/edit-adminassurance/{id}', 'SuperAdminController@editAssuSuperAdmin')->name('editEtabSuperAdmin');
    Route::post('dashboard/superadmin/delete-adminassurance/{id}', 'SuperAdminController@deleteAssuSuperAdmin')->name('deleteAssuSuperAdmin');


    ##############################################################################################
    #                                                                                            #
    #                                  SuperAdmin ROUTING                                        #
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

     /* CRUD Affections */
     Route::get('dashboard/superadmin/nos-affections', 'SuperAdminController@dashSuperAdminAffections')->name('dashSuperAdminAffections');
     Route::post('dashboard/superadmin/nouvel-affection', 'SuperAdminController@newAffectionSuperAdmin')->name('newAffectionSuperAdmin');
     Route::get('dashboard/superadmin/show-affection/{id}', 'SuperAdminController@showAffectionSuperAdmin')->name('showAffectionSuperAdmin');
     Route::get('dashboard/superadmin/edit-affection/{id}', 'SuperAdminController@editAffectionSuperAdmin')->name('editAffectionSuperAdmin');
     Route::post('dashboard/superadmin/update-affection', 'SuperAdminController@updateAffectionSuperAdmin')->name('updateAffectionSuperAdmin');

     /* CRUD Appareillages */
     Route::get('dashboard/superadmin/nos-appareillages', 'SuperAdminController@dashSuperAdminAppareillages')->name('dashSuperAdminAppareillages');
     Route::post('dashboard/superadmin/nouvel-appareillage', 'SuperAdminController@newAppareillageSuperAdmin')->name('newAppareillageSuperAdmin');
     Route::get('dashboard/superadmin/show-appareillage/{id}', 'SuperAdminController@showAppareillageSuperAdmin')->name('showAppareillageSuperAdmin');
     Route::get('dashboard/superadmin/edit-appareillage/{id}', 'SuperAdminController@editAppareillageSuperAdmin')->name('editAppareillageSuperAdmin');
     Route::post('dashboard/superadmin/update-appareillage', 'SuperAdminController@updateAppareillageSuperAdmin')->name('updateAppareillageSuperAdmin');

      /* CRUD Prestations */
      Route::get('dashboard/superadmin/nos-prestations', 'SuperAdminController@dashSuperAdminPrestations')->name('dashSuperAdminPrestations');
      Route::post('dashboard/superadmin/nouvel-prestation', 'SuperAdminController@newPrestationSuperAdmin')->name('newPrestationSuperAdmin');
      Route::get('dashboard/superadmin/show-prestation/{id}', 'SuperAdminController@showPrestationSuperAdmin')->name('showPrestationSuperAdmin');
      Route::get('dashboard/superadmin/edit-prestation/{id}', 'SuperAdminController@editPrestationSuperAdmin')->name('editPrestationSuperAdmin');
      Route::post('dashboard/superadmin/update-prestation', 'SuperAdminController@updatePrestationSuperAdmin')->name('updatePrestationSuperAdmin');

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

    /* CRUD Agents */
    Route::get('dashboard/adminetablissement/nos-agents', 'AdminEtablissementController@dashAdminEtablissementAgents')->name('dashAdminEtablissementAgents');
    Route::post('dashboard/adminetablissement/nouvel-agent', 'AdminEtablissementController@newAgentAdminEtablissement')->name('newAgentAdminEtablissement');
    Route::get('dashboard/adminetablissement/show-agent/{id}', 'AdminEtablissementController@showAgentAdminEtablissement')->name('showAgentAdminEtablissement');
    Route::get('dashboard/adminetablissement/edit-agent/{id}', 'AdminEtablissementController@editAgentAdminEtablissement')->name('editAgentAdminEtablissement');
    Route::post('dashboard/adminetablissement/update-agent', 'AdminEtablissementController@updateAgentAdminEtablissement')->name('updateAgentAdminEtablissement');

    /* CRUD Praticiens */
    Route::get('dashboard/adminetablissement/nos-praticiens', 'AdminEtablissementController@dashAdminEtablissementPraticiens')->name('dashAdminEtablissementPraticiens');
    Route::post('dashboard/adminetablissement/nouvel-praticien', 'AdminEtablissementController@newPraticienAdminEtablissement')->name('newPraticienAdminEtablissement');
    Route::get('dashboard/adminetablissement/show-praticien/{id}', 'AdminEtablissementController@showPraticienAdminEtablissement')->name('showPraticienAdminEtablissement');
    Route::get('dashboard/adminetablissement/edit-praticien/{id}', 'AdminEtablissementController@editPraticienAdminEtablissement')->name('editPraticienAdminEtablissement');
    Route::post('dashboard/adminetablissement/update-praticien', 'AdminEtablissementController@updatePraticienAdminEtablissement')->name('updatePraticienAdminEtablissement');

    /* CRUD Assurances */
    Route::get('dashboard/adminetablissement/nos-assurances', 'AdminEtablissementController@dashAdminEtablissementAssurances')->name('dashAdminEtablissementAssurances');
    Route::post('dashboard/adminetablissement/nouvel-assurance', 'AdminEtablissementController@newAssuranceAdminEtablissement')->name('newAssuranceAdminEtablissement');
    Route::get('dashboard/adminetablissement/show-assurance/{id}', 'AdminEtablissementController@showAssuranceAdminEtablissement')->name('showAssuranceAdminEtablissement');
    Route::get('dashboard/adminetablissement/edit-assurance/{id}', 'AdminEtablissementController@editAssuranceAdminEtablissement')->name('editAssuranceAdminEtablissement');
    Route::post('dashboard/adminetablissement/update-assurance', 'AdminEtablissementController@updateAssuranceAdminEtablissement')->name('updateAssuranceAdminEtablissement');

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


     /* CRUD Prise en Charge */
     Route::get('dashboard/adminetablissement/nos-prisecharges', 'AdminEtablissementController@dashAdminEtablissementPriseCharges')->name('dashAdminEtablissementPriseCharges');
     Route::post('dashboard/adminetablissement/nouvel-prisecharge', 'AdminEtablissementController@newPriseChargeAdminEtablissement')->name('newPriseChargeAdminEtablissement');
     Route::get('dashboard/adminetablissement/show-prisecharge/{id}', 'AdminEtablissementController@showPriseChargeAdminEtablissement')->name('showPriseChargeAdminEtablissement');
     Route::get('dashboard/adminetablissement/edit-prisecharge/{id}', 'AdminEtablissementController@editPriseChargeAdminEtablissement')->name('editPriseChargeAdminEtablissement');
     Route::post('dashboard/adminetablissement/update-prisecharge', 'AdminEtablissementController@updatePriseChargeAdminEtablissement')->name('updatePriseChargeAdminEtablissement');

          /* CRUD Prestations de soins Etablissements */
    Route::get('dashboard/adminetablissement/nos-prestationsoins', 'AdminEtablissementController@dashAdminEtablissementPrestationSoins')->name('dashAdminEtablissementPrestationSoins');
    Route::post('dashboard/adminetablissement/nouvel-prestationsoin', 'AdminEtablissementController@newPrestationSoinAdminEtablissement')->name('newPrestationSoinAdminEtablissement');
    Route::get('dashboard/adminetablissement/show-prestationsoin/{id}', 'AdminEtablissementController@showPrestationSoinAdminEtablissement')->name('showPrestationSoinAdminEtablissement');
    Route::get('dashboard/adminetablissement/edit-prestationsoin/{id}', 'AdminEtablissementController@editPrestationSoinAdminEtablissement')->name('editPrestationSoinAdminEtablissement');
    Route::post('dashboard/adminetablissement/update-prestationsoin', 'AdminEtablissementController@updatePrestationSoinAdminEtablissement')->name('updatePrestationSoinAdminEtablissement');


    /* End Routing for AdminEtablissement's User */

    ##############################################################################################
    #                                                                                            #
    #                                  Caisse ROUTING                                #
    #                                                                                            #
    ##############################################################################################
     
    /* Start Routing for CaisseEtablissement's User */
    Route::get('dashboard/caisseetablissement', 'CaisseEtablissementController@dashCaisseEtablissement')->name('dashCaisseEtablissement');

    /* CRUD Prestations */
    Route::get('dashboard/caisseetablissement/nos-prestations', 'CaisseEtablissementController@CaisseEtablissementPrestations')->name('dashCaisseEtablissementPrestations');
    Route::post('dashboard/caisseetablissement/nouvel-prestation', 'CaisseEtablissementController@newPrestationCaisseEtablissement')->name('newPrestationCaisseEtablissement');
    Route::get('dashboard/caisseetablissement/show-prestation/{id}', 'CaisseEtablissementController@showPrestationCaisseEtablissement')->name('showPrestationCaisseEtablissement');
    Route::get('dashboard/caisseetablissement/edit-prestation/{id}', 'CaisseEtablissementController@editPrestationCaisseEtablissement')->name('editPrestationCaisseEtablissement');
    Route::post('dashboard/caisseetablissement/update-prestation', 'CaisseEtablissementController@updatePrestationCaisseEtablissement')->name('updatePrestationCaisseEtablissement');

    /* CRUD Prestations hospitalisations */
    Route::get('dashboard/caisseetablissement/nos-prestationhospitalisations', 'CaisseEtablissementController@CaisseEtablissementPrestationHospitalisations')->name('CaisseEtablissementPrestationHospitalisations');
    Route::post('dashboard/caisseetablissement/nouvel-prestationhospitalisation', 'CaisseEtablissementController@newPrestationHospitalisationCaisseEtablissement')->name('newPrestationHospitalisationCaisseEtablissement');
    Route::get('dashboard/caisseetablissement/show-prestationhospitalisation/{id}', 'CaisseEtablissementController@showPrestationHospitalisationCaisseEtablissement')->name('showPrestationHospitalisationCaisseEtablissement');
    Route::get('dashboard/caisseetablissement/edit-prestationhospitalisation/{id}', 'CaisseEtablissementController@editPrestationHospitalisationCaisseEtablissement')->name('editPrestationHospitalisationCaisseEtablissement');
    Route::post('dashboard/caisseetablissement/update-prestationhospitalisation', 'CaisseEtablissementController@updatePrestationHospitalisationCaisseEtablissement')->name('updatePrestationHospitalisationCaisseEtablissement');
        
    /* End Routing for CaisseEtablissement's User */

    ##############################################################################################
    #                                                                                            #
    #                                  Praticien ROUTING                                #
    #                                                                                            #
    ##############################################################################################

    /* Start Routing for PraticienEtablissement's User */
    Route::get('dashboard/praticienetablissement', 'PraticienEtablissementController@dashPraticienEtablissement')->name('dashPraticienEtablissement');

     /* CRUD Prestations soins*/
    Route::get('dashboard/praticienetablissement/nos-prestationsoins', 'PraticienEtablissementController@dashPraticienEtablissementPrestationSoins')->name('dashPraticienEtablissementPrestationSoins');
    Route::post('dashboard/praticienetablissement/nouvel-prestationsoin', 'PraticienEtablissementController@newPrestationSoinPraticienEtablissement')->name('newPrestationSoinPraticienEtablissement');
    Route::get('dashboard/praticienetablissement/show-prestationsoin/{id}', 'PraticienEtablissementController@showPrestationSoinPraticienEtablissement')->name('showPrestationSoinPraticienEtablissement');
    Route::get('dashboard/praticienetablissement/edit-prestationsoin/{id}', 'PraticienEtablissementController@editPrestationSoinPraticienEtablissement')->name('editPrestationSoinPraticienEtablissement');
    Route::post('dashboard/praticienetablissement/update-prestationsoin', 'PraticienEtablissementController@updatePrestationSoinPraticientablissement')->name('updatePrestationSoinPraticienEtablissement');

    /* CRUD Prise en Charge*/
    Route::get('dashboard/praticienetablissement/nos-prisecharges', 'PraticienEtablissementController@dashPraticienEtablissementPriseCharges')->name('dashPraticienEtablissementPriseCharges');
    Route::post('dashboard/praticieetablissementn/nouvel-prisecharge', 'PraticienEtablissementController@newPriseChargePraticienEtablissement')->name('newPriseChargePraticienEtablissement');
    Route::get('dashboard/praticienetablissement/show-prisecharge/{id}', 'PraticienEtablissementController@showPriseChargePraticienEtablissement')->name('showPriseChargePraticienEtablissement');
    Route::get('dashboard/praticienetablissement/edit-prisecharge/{id}', 'PraticienEtablissementController@editPriseChargePraticienEtablissement')->name('editPriseChargePraticienEtablissement');
    Route::post('dashboard/praticienetablissement/update-prisecharge', 'PraticienEtablissementController@updatePriseChargePraticienEtablissement')->name('updatePriseChargePraticienEtablissement');

    /* CRUD Prescription médicale*/
    Route::get('dashboard/praticienetablissement/nos-prescriptionnmedicales', 'PraticienEtablissementController@dashPraticienEtablissementPrescriptionMedicales')->name('dashPraticienEtablissementPrescriptionMedicales');
    Route::post('dashboard/praticienetablissement/nouvel-prescriptiomedicale', 'PraticienEtablissementController@newPrescriptionMedicalePraticienEtablissement')->name('newPrescriptionMedicalePraticienEtablissement');
    Route::get('dashboard/praticienetablissement/show-prescriptiomedicale/{id}', 'PraticienEtablissementController@showPrescriptionMedicalePraticienEtablissement')->name('showPrescriptionMedicalePraticienEtablissement');
    Route::get('dashboard/praticienetablissement/edit-prescriptiomedicale/{id}', 'PraticienEtablissementController@editPrescriptionMedicalePraticienEtablissement')->name('editPrescriptionMedicalePraticienEtablissement');
    Route::post('dashboard/praticienetablissement/update-prescriptiomedicale', 'PraticienEtablissementController@updatePrescriptionMedicalePraticientablissement')->name('updatePrescriptionMedicalePraticienEtablissement');

    /* CRUD Prestation examen*/
    Route::get('dashboard/praticienetablissement/nos-prestationexamens', 'PraticienEtablissementController@dashPraticienEtablissementPrestationExamens')->name('dashPraticienEtablissementPrestationExamens');
    Route::post('dashboard/praticienetablissement/nouvel-prestationexamen', 'PraticienEtablissementController@newPrestationExamenPraticienEtablissement')->name('newPrestationExamenPraticienEtablissement');
    Route::get('dashboard/praticienetablissement/show-prestationexamen/{id}', 'PraticienEtablissementController@showPrestationExamenPraticienEtablissement')->name('showPrestationExamenPraticienEtablissement');
    Route::get('dashboard/praticienetablissement/edit-prestationexamen/{id}', 'PraticienEtablissementController@editPrestationExamenPraticienEtablissement')->name('editPrestationExamenPraticienEtablissement');
    Route::post('dashboard/praticienetablissement/update-prestationexamen', 'PraticienEtablissementController@updatePrestationExamenPraticientablissement')->name('updatePrestationExamenPraticienEtablissement');

    /* CRUD Prestation hospitalisation*/
    Route::get('dashboard/praticienetablissement/nos-prestationhospitalisations', 'PraticienEtablissementController@dashPraticienEtablissementPrestationHospitalisations')->name('dashPraticienEtablissementPrestationHospitalisations');
    Route::post('dashboard/praticienetablissement/nouvel-prestationhospitalisation', 'PraticienEtablissementController@newPrestationHospitalisationPraticienEtablissement')->name('newPrestationHospitalisationPraticienEtablissement');
    Route::get('dashboard/praticienetablissement/show-prestationhospitalisation/{id}', 'PraticienEtablissementController@showPrestationHospitalisationPraticienEtablissement')->name('showPrestationHospitalisationPraticienEtablissement');
    Route::get('dashboard/praticienetablissement/edit-prestationhospitalisation/{id}', 'PraticienEtablissementController@editPrestationHospitalisationPraticienEtablissement')->name('editPrestationHospitalisationPraticienEtablissement');
    Route::post('dashboard/praticienetablissement/update-prestationhospitalisation', 'PraticienEtablissementController@updatePrestationHospitalisationPraticientablissement')->name('updatePrestationHospitalisationPraticienEtablissement');

            
    /* End Routing for CaisseEtablissement's User */

    ##############################################################################################
    #                                                                                            #
    #                                  Praticien ROUTING                                #
    #                                                                                            #
    ##############################################################################################
    
    /* Start Routing for PraticienEtablissement's User */
    Route::get('dashboard/pharmacienetablissement', 'PharmacienEtablissementController@dashPharmacienEtablissement')->name('dashPharmacienEtablissement');

    
    /* CRUD Prescription médicale*/
    Route::get('dashboard/pharmacienetablissement/nos-prescriptionnmedicales', 'PharmacienEtablissementController@dashPharmacienEtablissementPrescriptionMedicales')->name('dashPharmacienEtablissementPrescriptionMedicales');
    Route::post('dashboard/pharmacienetablissement/nouvel-prescriptiomedicale', 'PharmacienEtablissementController@newPrescriptionMedicalePharmacienEtablissement')->name('newPrescriptionMedicalePharmacienEtablissement');
    Route::get('dashboard/pharmacienetablissement/show-prescriptiomedicale/{id}', 'PharmacienEtablissementController@showPrescriptionMedicalePharmacienEtablissement')->name('showPrescriptionMedicalePharmacienEtablissement');
    Route::get('dashboard/pharmacienetablissement/edit-prescriptiomedicale/{id}', 'PharmacienEtablissementController@editPrescriptionMedicalePharmacienEtablissement')->name('editPrescriptionMedicalePharmacienEtablissement');
    Route::post('dashboard/pharmacienetablissement/update-prescriptiomedicale', 'PharmacienEtablissementController@updatePrescriptionMedicalePharmacienEtablissement')->name('updatePrescriptionMedicalePharmacienEtablissement');

        /* End Routing for PharmacienEtablissement's User */

    ##############################################################################################
    #                                                                                            #
    #                                  Laboratoire ROUTING                                #
    #                                                                                            #
    ##############################################################################################
    
    /* Start Routing for PraticienEtablissement's User */
    Route::get('dashboard/laboetablissement', 'LaboratoireEtablissementController@dashLaboratoireEtablissement')->name('dashLaboratoireEtablissement');

    /* CRUD Prestation examen*/
    Route::get('dashboard/laboetablissement/nos-prestationexamens', 'LaboratoireEtablissementController@dashLaboratoireEtablissementPrestationExamens')->name('dashLaboratoireEtablissementPrestationExamens');
    Route::post('dashboard/laboetablissement/nouvel-prestationexamen', 'LaboratoireEtablissementController@newPrestationExamenLaboratoireEtablissement')->name('newPrestationExamenLaboratoireEtablissement');
    Route::get('dashboard/laboetablissement/show-prestationexamen/{id}', 'LaboratoireEtablissementController@showPrestationExamenLaboratoireEtablissement')->name('showPrestationExamenLaboratoireEtablissement');
    Route::get('dashboard/laboetablissement/edit-prestationexamen/{id}', 'LaboratoireEtablissementController@editPrestationExamenLaboratoireEtablissement')->name('editPrestationExamenLaboratoireEtablissement');
    Route::post('dashboard/laboetablissement/update-prestationexamen', 'LaboratoireEtablissementController@updatePrestationExamenLaboratoiretablissement')->name('updatePrestationExamenLaboratoiretablissement');

     ##############################################################################################
    #                                                                                            #
    #                                  AdminAssurance ROUTING                                #
    #                                                                                            #
    ##############################################################################################

     /* Start Routing for AdminAssurance's User */
     Route::get('dashboard/adminassurance', 'AdminAssuranceController@dashAdminAssurance')->name('dashAdminAssurance');

    /* CRUD Agents */
    Route::get('dashboard/adminassurance/nos-agents', 'AdminAssuranceController@dashAdminAssuranceAgents')->name('dashAdminAssuranceAgents');
    Route::post('dashboard/adminassurance/nouvel-agent', 'AdminAssuranceController@newAgentAdminAssurance')->name('newAgentAdminAssurance');
    Route::get('dashboard/adminassurance/show-agent/{id}', 'AdminAssuranceController@showAgentAdminAssurance')->name('showAgentAdminAssurance');
    Route::get('dashboard/adminassurance/edit-agent/{id}', 'AdminAssuranceController@editAgentAdminAssurance')->name('editAgentAdminAssurance');
    Route::post('dashboard/adminassurance/update-agent', 'AdminAssuranceController@updateAgentAdminAssurance')->name('updateAgentAdminAssurance');

    /* CRUD Ayant-Droits */
    Route::get('dashboard/adminassurance/nos-ayantdroits', 'AyantDroitController@dashAdminAssuranceAyantDroits')->name('dashAdminAssuranceAyantDroits');
    Route::post('dashboard/adminassurance/nouvel-ayantdroit', 'AyantDroitController@newAyantDroitAdminAssurance')->name('newAyantDroitAdminAssurance');
    Route::get('dashboard/adminassurance/show-ayantdroit/{id}', 'AyantDroitController@showAyantDroitAdminAssurance')->name('showAyantDroiteAdminAssurance');
    Route::get('dashboard/adminassurance/edit-ayantdroit/{id}', 'AyantDroitController@editAyantDroitAdminAssurance')->name('editAyantDroitAdminAssurance');
    Route::post('dashboard/adminassurance/update-ayantdroit', 'AyantDroitController@updateAyantDroitAdminAssurance')->name('updateAyantDroitAdminAssurance');

    /* CRUD Assures */
    Route::get('dashboard/adminassurance/nos-assures', 'AssureController@dashAdminAssuranceAssures')->name('dashAdminAssuranceAssures');
    Route::post('dashboard/adminassurance/nouvel-assure', 'AssureController@newAssureAdminAssurance')->name('newAssureAdminAssurance');
    Route::get('dashboard/adminassurance/show-assure/{id}', 'AssureController@showAssureAdminAssurance')->name('showAssureAdminAssurance');
    Route::get('dashboard/adminassurance/edit-assure/{id}', 'AssureController@editAssureAdminAssurance')->name('editAssureAdminAssurance');
    Route::post('dashboard/adminassurance/update-assure', 'AssureController@updateAssureAdminAssurance')->name('updateAssureAdminAssurance');

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

    /* CRUD TypeAssures */
    Route::get('dashboard/adminassurance/nos-typeassures', 'AdminAssuranceController@dashAdminAssuranceTypeAssures')->name('dashAdminAssuranceTypeAssures');
    Route::post('dashboard/adminassurance/nouvel-typeassure', 'AdminAssuranceController@newTypeAssureAdminAssurance')->name('newTypeAssureAdminAssurance');
    Route::get('dashboard/adminassurance/show-typeassure/{id}', 'AdminAssuranceController@showTypeAssureAdminAssurance')->name('showTypeAssureAdminAssurance');
    Route::get('dashboard/adminassurance/edit-typeassure/{id}', 'AdminAssuranceController@editTypeAssureAdminAssurance')->name('editTypeAssureAdminAssurance');
    Route::post('dashboard/adminassurance/update-typeassure', 'AdminAssuranceController@updateTypeAssureAdminAssurance')->name('updateTypeAssureAdminAssurance');

    /* CRUD Ticket Modérateurs */
    Route::get('dashboard/adminassurance/nos-ticketmoderateurs', 'AdminAssuranceController@dashAdminAssuranceTicketModerateurs')->name('dashAdminAssuranceTicketModerateurs');
    Route::post('dashboard/adminassurance/nouvel-ticketmoderateur', 'AdminAssuranceController@newTicketModerateurAdminAssurance')->name('newTicketModerateurAdminAssurance');
    Route::get('dashboard/adminassurance/show-ticketmoderateur/{id}', 'AdminAssuranceController@showTicketModerateurAdminAssurance')->name('showTicketModerateurAdminAssurance');
    Route::get('dashboard/adminassurance/edit-ticketmoderateur/{id}', 'AdminAssuranceController@editTicketModerateurAdminAssurance')->name('editTicketModerateurAdminAssurance');
    Route::post('dashboard/adminassurance/update-ticketmoderateur', 'AdminAssuranceController@updateTicketModerateurAdminAssurance')->name('updateTicketModerateurAdminAssurance');

    ##############################################################################################
    #                                                                                            #
    #                           GENERERATION FEUILLE DE SOINS                                    #
    #                                                                                            #
    ##############################################################################################


});

Route::get('/feuille-de-soin', 'feuilleController@feuilleSoins')->name('feuilleSoin');
Route::get('/feuille-de-soin/download', 'feuilleController@getPostPdf')->name('feuilleSoinDownload');

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

