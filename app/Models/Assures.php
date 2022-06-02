<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assures extends Model
{
    public function typeassures(){
        return $this->hasOne('App\Models\TypeAssures', 'id', 'type_assure_id');
    }
}