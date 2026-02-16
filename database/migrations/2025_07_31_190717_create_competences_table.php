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
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('niveau');
            $table->enum('type', ['Soft skills', 'Technique']);
            $table->text('description')->nullable();
            $table->enum('etat', ['Actif', 'Inactif'])->default('Actif');
            $table->timestamps();
        });
    }

    /**
     * Annuler les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
