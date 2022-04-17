<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    public function province(){
        return $this->hasOne('App\Models\Provinces', 'id', 'province_id');
    }
}
