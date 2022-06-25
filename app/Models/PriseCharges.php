<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriseCharges extends Model
{
    public function ticketmoderateurs(){
        return $this->hasOne('App\Models\TicketModerateurs', 'id', 'ticket_moderateur_id');
    }

    public function assures(){
        return $this->hasOne('App\User', 'id', 'assure_id');
    }
}