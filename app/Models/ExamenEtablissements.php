<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenEtablissements extends Model
{
    public function medicament(){
        return $this->hasOne('App\Models\Examens', 'id', 'examen_id');
    }
}