<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenAssurances extends Model
{
    public function examens(){
        return $this->hasOne('App\Models\Examens', 'id', 'examen_id');
    }
}