<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjetRequest;
use App\Http\Requests\UpdateProjetRequest;
use App\Models\Projet;
use App\Models\Categorie;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Contrôleur pour la gestion des projets
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les projets,
 * incluant la gestion des images et des relations avec les catégories et compétences.
 */
class ProjetController extends Controller
{
    /**
     * Affiche la liste de tous les projets
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projets = Projet::with(['categorie', 'competences'])
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Categorie::orderBy('nom', 'asc')
            ->get();

        $competences = Competence::where('etat', 'Actif')
            ->orderBy('nom', 'asc')
            ->get();

        return view('pages.admin.projet.liste', compact('projets', 'categories', 'competences'));
    }

    /**
     * Enregistre un nouveau projet dans la base de données
     *
     * @param StoreProjetRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProjetRequest $request)
    {
        $data = $request->validated();

        // Gestion des images
        $imageFields = ['photo1', 'photo2', 'photo3'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // storage/app/public/projets/nom-fichier-généré.jpg
                $data[$field] = $request->file($field)->store('projets', 'public');
            }
        }

        // Création du projet
        $projet = Projet::create($data);

        // Association des compétences si fournies
        if ($request->has('competences')) {
            $projet->competences()->attach($request->competences);
        }

        return redirect()->route('projets.liste')
            ->with('success', 'Projet créé avec succès.');
    }

    /**
     * Affiche les détails d'un projet spécifique
     *
     * @param Projet $projet
     * @return \Illuminate\View\View
     */
    public function show(Projet $projet)
    {
        $projet->load(['categorie', 'competences']);

        return view('pages.admin.projet.liste', compact('projet'));
    }

    /**
     * Met à jour un projet existant
     *
     * @param UpdateProjetRequest $request
     * @param Projet $projet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProjetRequest $request, Projet $projet)
    {
        $data = $request->validated();

        // Gestion des images
        $imageFields = ['photo1', 'photo2', 'photo3'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Supprimer l'ancienne image si elle existe
                if ($projet->$field && Storage::disk('public')->exists($projet->$field)) {
                    Storage::disk('public')->delete($projet->$field);
                }
                $data[$field] = $request->file($field)->store('projets', 'public');
            }
        }

        // Mise à jour du projet
        $projet->update($data);

        // Mise à jour des compétences
        if ($request->has('competences')) {
            $projet->competences()->sync($request->competences);
        } else {
            $projet->competences()->detach();
        }

        return redirect()->route('projets.liste')
            ->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Désactive un projet (change l'état en Inactif)
     *
     * @param Projet $projet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Projet $projet)
    {
        $projet->update(['etat' => 'Inactif']);

        return redirect()->route('projets.liste')
            ->with('success', 'Projet désactivé avec succès.');
    }

    /**
     * Active un projet (change l'état en Actif)
     *
     * @param Projet $projet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Projet $projet)
    {
        $projet->update(['etat' => 'Actif']);

        return redirect()->route('projets.liste')
            ->with('success', 'Projet activé avec succès.');
    }
}
