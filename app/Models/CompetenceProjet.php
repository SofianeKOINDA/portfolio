<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle CompetenceProjet - Table de jointure pour la relation many-to-many */
class CompetenceProjet extends Model
{
    use HasFactory;

    /* Le nom de la table associée au modèle */
    protected $table = 'competence_projet';

    /* Indique si les timestamps sont activés */
    public $timestamps = false;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'competence_id',
        'projet_id',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'competence_id' => 'integer',
        'projet_id' => 'integer',
    ];

    /* Relation belongsTo avec la compétence */
    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    /* Relation belongsTo avec le projet */
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
