<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Competence;
use App\Models\CompetenceProjet;
use App\Models\Contact;
use App\Models\Entreprise;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
           // 1. Créer l'utilisateur principal
                User::factory(1)->create();
                // 2. Créer les entreprises
                Entreprise::factory(3)->create();
                // 3. Créer les catégories
                Categorie::factory(3)->create();
                // 4. Créer les compétences
                Competence::factory(3)->create();
                // 5. Créer les expériences
                Experience::factory(3)->create();
                // 6. Créer les formations
                Formation::factory(3)->create();
                // 7. Créer les projets avec les relations
                 Projet::factory(3)->create();
                 // 8. Créer les relations compétence-projet
                 CompetenceProjet::factory(3)->create();
                 // 9. Créer les contacts
                 Contact::factory(3)->create();
    }
}
