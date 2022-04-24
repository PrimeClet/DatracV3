<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffectionAssurances extends Model
{
    public function affections(){
        return $this->hasOne('App\Models\Affections', 'id', 'acte_id');
    }
}