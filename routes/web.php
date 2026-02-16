<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\CompetenceProjetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('vitrine');
Route::post('/contact', [ContactController::class, 'storePublic'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour l'administration
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Routes pour les projets
    Route::get('/projets', [ProjetController::class, 'index'])->name('projets.liste');
    Route::post('/projets', [ProjetController::class, 'store'])->name('projets.store');
    Route::get('/projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');
    Route::put('/projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
    Route::delete('/projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');
    Route::patch('/projets/{projet}/activate', [ProjetController::class, 'activate'])->name('projets.activate');

    // Routes pour les formations
    Route::get('/formations', [FormationController::class, 'index'])->name('formations.liste');
    Route::post('/formations', [FormationController::class, 'store'])->name('formations.store');
    Route::get('/formations/{formation}', [FormationController::class, 'show'])->name('formations.show');
    Route::put('/formations/{formation}', [FormationController::class, 'update'])->name('formations.update');
    Route::delete('/formations/{formation}', [FormationController::class, 'destroy'])->name('formations.destroy');
    Route::patch('/formations/{formation}/activate', [FormationController::class, 'activate'])->name('formations.activate');

    // Routes pour les expériences
    Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences.liste');
    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::get('/experiences/{experience}', [ExperienceController::class, 'show'])->name('experiences.show');
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');
    Route::patch('/experiences/{experience}/activate', [ExperienceController::class, 'activate'])->name('experiences.activate');

    // Routes pour les entreprises
    Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises.liste');
    Route::post('/entreprises', [EntrepriseController::class, 'store'])->name('entreprises.store');
    Route::get('/entreprises/{entreprise}', [EntrepriseController::class, 'show'])->name('entreprises.show');
    Route::put('/entreprises/{entreprise}', [EntrepriseController::class, 'update'])->name('entreprises.update');
    Route::delete('/entreprises/{entreprise}', [EntrepriseController::class, 'destroy'])->name('entreprises.destroy');
    Route::patch('/entreprises/{entreprise}/activate', [EntrepriseController::class, 'activate'])->name('entreprises.activate');

    // Routes pour les contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.liste');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::patch('/contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::patch('/contacts/{contact}/reply', [ContactController::class, 'markAsAnswered'])->name('contacts.reply');

    // Routes pour les compétences
    Route::get('/competences', [CompetenceController::class, 'index'])->name('competences.liste');
    Route::post('/competences', [CompetenceController::class, 'store'])->name('competences.store');
    Route::get('/competences/{competence}', [CompetenceController::class, 'show'])->name('competences.show');
    Route::put('/competences/{competence}', [CompetenceController::class, 'update'])->name('competences.update');
    Route::delete('/competences/{competence}', [CompetenceController::class, 'destroy'])->name('competences.destroy');
    Route::patch('/competences/{competence}/activate', [CompetenceController::class, 'activate'])->name('competences.activate');

    // Routes pour les catégories
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.liste');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // Routes pour les associations compétence-projet
    Route::get('/competence-projets', [CompetenceProjetController::class, 'index'])->name('competence-projets.liste');
    Route::post('/competence-projets', [CompetenceProjetController::class, 'store'])->name('competence-projets.store');
    Route::get('/competence-projets/{id}', [CompetenceProjetController::class, 'show'])->name('competence-projets.show');
    Route::put('/competence-projets/{id}', [CompetenceProjetController::class, 'update'])->name('competence-projets.update');
    Route::delete('/competence-projets/{id}', [CompetenceProjetController::class, 'destroy'])->name('competence-projets.destroy');
    Route::delete('/competence-projets/{projetId}/{competenceId}/detach', [CompetenceProjetController::class, 'detachCompetence'])->name('competence-projets.detach');

    // Routes pour les utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('users.liste');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';



