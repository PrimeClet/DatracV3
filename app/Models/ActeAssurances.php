<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActeAssurances extends Model
{
    public function typeactes(){
        return $this->hasOne('App\Models\TypeActes', 'id', 'type_acte_id');
    }
}