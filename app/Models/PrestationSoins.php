<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationSoins extends Model
{
    public function assurances(){
        return $this->hasOne('App\Models\Assurances', 'id', 'assurance_id');
    }

    public function affections(){
        return $this->belongsToMany('App\Models\Affections', 'assurance_id', 'affection_id');
    }

    public function etablissements(){
        return $this->hasOne('App\Models\Etablissements', 'id', 'etablissement_id');
    }

    public function ticketmoderateurs(){
        return $this->hasOne('App\Models\TicketModerateurs', 'id', 'ticketmoderateur_id');
    }

    public function acteassurances(){
        return $this->hasOne('App\Models\ActeAssurances', 'id', 'acte_assurance_id');
    }
}