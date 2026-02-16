<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle Entreprise - Gestion des entreprises et écoles */
class Entreprise extends Model
{
    use HasFactory;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'nom',
        'adresse',
        'tel1',
        'tel2',
        'site',
        'email',
        'type',
        'etat',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'etat' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Relation hasMany avec les expériences */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /* Relation hasMany avec les formations */
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
