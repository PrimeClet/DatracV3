<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationHospitalisationCaisses extends Model
{
    
    public function assurances(){
        return $this->hasOne('App\Models\Assurances', 'id', 'assurance_id');
    }

    public function feuillesoins(){
        return $this->hasOne('App\Models\FeuilleSoins', 'id', 'feuillesoins_id');
    }

    public function prestations(){
        return $this->belongsToMany('App\Models\PrestationHospitalisations', 'id', 'prestation_id');
    }

    public function etablissements(){
        return $this->hasOne('App\Models\Etablissements', 'id', 'etablissement_id');
    }

}