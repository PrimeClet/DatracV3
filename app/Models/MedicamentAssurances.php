<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentAssurances extends Model
{
    public function medicaments(){
        return $this->hasOne('App\Models\Medicaments', 'id', 'medicament_id');
    }
}