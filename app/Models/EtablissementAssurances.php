<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtablissementAssurances extends Model
{
    public function assurances(){
        return $this->hasOne('App\Models\Assurances', 'id', 'assurance_id');
    }
}