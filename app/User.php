<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'codeAgent', 'email', 'password', 'role', 'telephone', 'matricule', 'assurance_id', 'etablissement_id',
        'codeAgent','poste', 'adresse', 'ville', 'photo_url', 'api_token', 'code_secret', 'active', 'remember_token',
        'code_praticien', 'type_assure_id', 'datenaiss', 'numero_patient', 'numero_assure', 'nom_assure',
        'signature_patient', 'assure_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
