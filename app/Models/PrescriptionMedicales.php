<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicales extends Model
{
    public function assurances(){
        return $this->hasOne('App\Models\Assurances', 'id', 'assurance_id');
    }

    public function medicaments(){
        return $this->belongsToMany('App\Models\Medicament', 'id', 'medicament_id');
    }

    public function appareillages(){
        return $this->belongsToMany('App\Models\Appareillages', 'id', 'appareillage_id');
    }

    public function etablissements(){
        return $this->hasOne('App\Models\Etablissements', 'id', 'etablissement_id');
    }
    
}