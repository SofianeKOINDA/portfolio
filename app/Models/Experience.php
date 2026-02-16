<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle Experience - Gestion des expériences professionnelles */
class Experience extends Model
{
    use HasFactory;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'poste',
        'duree',
        'tache',
        'etat',
        'entreprise_id',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'etat' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Relation belongsTo avec l'entreprise */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
