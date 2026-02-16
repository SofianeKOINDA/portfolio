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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('duree');
            $table->string('diplome');
            $table->enum('etat', ['Actif', 'Inactif'])->default('Actif');
            $table->foreignId('entreprise_id')->nullable()->constrained('entreprises')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Annuler les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
