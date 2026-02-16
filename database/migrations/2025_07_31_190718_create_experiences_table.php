<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuter les migrations.
     */
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('poste');
            $table->string('duree');
            $table->text('tache');
            $table->enum('etat', ['Actif', 'Inactif'])->default('Actif');
            $table->foreignId('entreprise_id')->nullable()->constrained('entreprises')->onDelete('set null');
            //$table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->timestamps();
        });
    }
//
    /**
     * Annuler les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
