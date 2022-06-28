<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicaleCaisses extends Model
{
    public function prestationmedicales(){
        return $this->hasOne('App\Models\PrescriptionMedicales', 'id', 'prescription_medicale_id');
    }

    public function feuillesoins(){
        return $this->hasOne('App\Models\FeuilleSoins', 'id', 'feuillesoins_id');
    }

    public function appareillages(){
        return $this->hasOne('App\Models\AppareillageAssurances', 'id', 'appareillageid');
    }

    public function ticketmoderateurs(){
        return $this->hasOne('App\Models\TicketModerateurs', 'id', 'ticket_moderateur_id');
    }

    public function assurances(){
        return $this->hasOne('App\Models\Assurance', 'id', 'assurance_id');
    }
}