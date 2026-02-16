<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle Projet - Gestion des projets et services */
class Projet extends Model
{
    use HasFactory;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'nom',
        'photo1',
        'photo2',
        'photo3',
        'description',
        'date',
        'client',
        'type',
        'url',
        'technologies',
        'etat',
        'categorie_id',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'date' => 'date',
        'technologies' => 'array',
        'etat' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Relation belongsTo avec la catégorie */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /* Relation many-to-many avec les compétences */
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_projet');
    }
}
