<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationExamens extends Model
{
    public function assurances(){
        return $this->hasOne('App\Models\Assurances', 'id', 'assurance_id');
    }

    public function examens(){
        return $this->belongsToMany('App\Models\Examens', 'id', 'examen_id');
    }

    public function etablissements(){
        return $this->hasOne('App\Models\Etablissements', 'id', 'etablissement_id');
    }
}