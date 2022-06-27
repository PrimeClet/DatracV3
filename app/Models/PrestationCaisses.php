<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestationCaisses extends Model
{
    public function prestation_etablissements(){
        return $this->hasOne('App\Models\PrestationEtablissements', 'id', 'prestation_id');
    }

    public function typeassures(){
        return $this->hasOne('App\Models\TypeAssures', 'id', 'type_assure_id');
    }

    public function ticketmoderateurs(){
        return $this->hasOne('App\Models\TicketModerateurs', 'id', 'ticket_moderateur_id');
    }

    public function assurances(){
        return $this->hasOne('App\Models\Assurance', 'id', 'assurance_id');
    }
}