<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestations extends Model
{
    public function acte(){
        return $this->hasOne('App\Models\Actes', 'id', 'acte_id');
    }
}
