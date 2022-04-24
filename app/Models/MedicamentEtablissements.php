<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentEtablissements extends Model
{
    public function medicament(){
        return $this->hasOne('App\Models\Medicament', 'id', 'medicament_id');
    }
}