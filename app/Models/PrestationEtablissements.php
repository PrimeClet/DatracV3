<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationEtablissements extends Model
{
    public function prestations(){
        return $this->hasOne('App\Models\Prestations', 'id', 'prestation_id');
    }
}