<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationHospitalisations extends Model
{
    public function assurances(){
        return $this->hasOne('App\Models\Assurances', 'id', 'assurance_id');
    }

    public function actes(){
        return $this->belongsToMany('App\Models\ActeAssurances', 'id', 'acte_id');
    }

    public function prestations(){
        return $this->belongsToMany('App\Models\Prestations', 'id', 'prestation_id');
    }

    public function etablissements(){
        return $this->hasOne('App\Models\Etablissements', 'id', 'etablissement_id');
    }
}