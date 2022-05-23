<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActeAssurances extends Model
{
    public function actes(){
        return $this->hasOne('App\Models\Actes', 'id', 'acte_id');
    }
}