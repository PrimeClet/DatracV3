<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketModerateurs extends Model
{
    public function typesassures(){
        return $this->hasOne('App\Models\TypeAssures', 'id', 'typeassure_id');
    }
}