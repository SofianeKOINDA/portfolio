<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle Categorie - Gestion des catégories de projets */
class Categorie extends Model
{
    use HasFactory;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'nom',
        'etat',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Relation hasMany avec les projets */
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
