<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Modèle Contact - Gestion des messages de contact */
class Contact extends Model
{
    use HasFactory;

    /* Les attributs qui sont assignables en masse */
    protected $fillable = [
        'nom',
        'email',
        'sujet',
        'message',
        'lu',
        'repondu',
        'reponse',
    ];

    /* Les attributs qui doivent être convertis en types natifs */
    protected $casts = [
        'lu' => 'boolean',
        'repondu' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* Marquer le message comme lu */
    public function markAsRead()
    {
        $this->update(['lu' => true]);
    }

    /* Marquer le message comme répondu */
    public function markAsAnswered($reponse = null)
    {
        $this->update([
            'repondu' => true,
            'reponse' => $reponse
        ]);
    }
}
