<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle Competence - Gestion des compétences professionnelles */
class Competence extends Model
{
    use HasFactory;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'nom',
        'niveau',
        'type',
        'description',
        'etat',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'niveau' => 'integer',
        'etat' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Relation many-to-many avec les projets */
    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'competence_projet');
    }
}
