<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/* Modèle User - Gestion des informations de l'utilisateur */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'nom',
        'slogan',
        'description',
        'photo',
        'tel1',
        'tel2',
        'email',
        'password',
        'adresse',
        'poste',
        'link',
    ];

    /* Les attributs qui doivent être cachés lors de la sérialisation */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
