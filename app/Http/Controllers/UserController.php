<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Projet;
use App\Models\Competence;
use App\Models\Entreprise;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Contrôleur pour la gestion des utilisateurs
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les utilisateurs,
 * incluant la gestion des mots de passe et des permissions.
 */
class UserController extends Controller
{
    /**
     * Affiche la page d'accueil avec toutes les informations
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer le premier utilisateur (profil principal)
        $user = User::first();

        // Récupérer les expériences actives avec leurs entreprises
        $experiences = Experience::with('entreprise')
            ->where('etat', 'Actif')
            ->orderBy('created_at', 'desc')
            ->get();

        // Récupérer les formations actives avec leurs entreprises
        $formations = Formation::with('entreprise')
            ->where('etat', 'Actif')
            ->orderBy('created_at', 'desc')
            ->get();

        // Récupérer les projets actifs de type "Projet"
        $projets = Projet::with(['categorie', 'competences'])
            ->where('etat', 'Actif')
            ->where('type', 'Projet')
            ->orderBy('created_at', 'desc')
            ->get();

        // Récupérer les services actifs de type "Service"
        $services = Projet::with(['categorie', 'competences'])
            ->where('etat', 'Actif')
            ->where('type', 'Service')
            ->orderBy('created_at', 'desc')
            ->get();

        // Récupérer les compétences techniques (type Technique)
        $competencesTechniques = Competence::where('etat', 'Actif')
            ->where('type', 'Technique')
            ->orderBy('nom', 'asc')
            ->get();

        // Récupérer les compétences Soft Skills
        $competencesSoftSkills = Competence::where('etat', 'Actif')
            ->where('type', 'Soft Skill')
            ->orderBy('nom', 'asc')
            ->get();

        // Récupérer toutes les compétences actives
        $competences = Competence::where('etat', 'Actif')
            ->orderBy('nom', 'asc')
            ->get();

        // Récupérer les entreprises actives
        $entreprises = Entreprise::where('etat', 'Actif')
            ->orderBy('nom', 'asc')
            ->get();

        // Récupérer les catégories
        $categories = Categorie::orderBy('nom', 'asc')
            ->get();

        // Statistiques pour le dashboard
        $stats = [
            'total_experiences' => Experience::where('etat', 'Actif')->count(),
            'total_formations' => Formation::where('etat', 'Actif')->count(),
            'total_projets' => Projet::where('etat', 'Actif')->where('type', 'Projet')->count(),
            'total_services' => Projet::where('etat', 'Actif')->where('type', 'Service')->count(),
            'total_competences' => Competence::where('etat', 'Actif')->count(),
            'total_entreprises' => Entreprise::where('etat', 'Actif')->count(),
            'total_categories' => Categorie::count(),
        ];

        return view('welcome', compact(
            'user',
            'experiences',
            'formations',
            'projets',
            'services',
            'competences',
            'competencesTechniques',
            'competencesSoftSkills',
            'entreprises',
            'categories',
            'stats'
        ));
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // Hasher le mot de passe
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.liste')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Affiche les détails d'un utilisateur spécifique
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('pages.admin.user.show', compact('user'));
    }

    /**
     * Met à jour un utilisateur existant
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Hasher le mot de passe seulement s'il est fourni
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.liste')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur de la base de données
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Empêcher la suppression de l'utilisateur connecté
        $currentUser = auth()->Auth::user();
        if ($user->id === $currentUser->id) {
                    return redirect()->route('users.liste')
            ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('users.liste')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
