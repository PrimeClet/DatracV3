<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationAssurances extends Model
{
    public function prestations(){
        return $this->hasOne('App\Models\Prestations', 'id', 'prestation_id');
    }
}