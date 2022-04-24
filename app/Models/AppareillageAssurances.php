<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppareillageAssurances extends Model
{
    public function appareillages(){
        return $this->hasOne('App\Models\Appareillages', 'id', 'appareillage_id');
    }
}