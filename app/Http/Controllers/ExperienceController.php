<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use App\Models\Entreprise;

/**
 * Contrôleur pour la gestion des expériences professionnelles
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les expériences,
 * incluant les relations avec les entreprises.
 */
class ExperienceController extends Controller
{
    /**
     * Affiche la liste de toutes les expériences
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $experiences = Experience::with('entreprise')
            ->orderBy('created_at', 'desc')
            ->get();

        $entreprises = Entreprise::where('etat', 'Actif')
            ->orderBy('nom', 'asc')
            ->get();

        return view('pages.admin.experience.liste', compact('experiences', 'entreprises'));
    }

    /**
     * Enregistre une nouvelle expérience dans la base de données
     *
     * @param StoreExperienceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreExperienceRequest $request)
    {
        $data = $request->validated();

        Experience::create($data);

        return redirect()->route('experiences.liste')
            ->with('success', 'Expérience créée avec succès.');
    }

    /**
     * Affiche les détails d'une expérience spécifique
     *
     * @param Experience $experience
     * @return \Illuminate\View\View
     */
    public function show(Experience $experience)
    {
        $experience->load('entreprise');

        return view('pages.admin.experience.liste', compact('experience'));
    }

    /**
     * Met à jour une expérience existante
     *
     * @param UpdateExperienceRequest $request
     * @param Experience $experience
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $data = $request->validated();

        $experience->update($data);

        return redirect()->route('experiences.liste')
            ->with('success', 'Expérience mise à jour avec succès.');
    }

    /**
     * Désactive une expérience (change l'état en Inactif)
     *
     * @param Experience $experience
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Experience $experience)
    {
        $experience->update(['etat' => 'Inactif']);

        return redirect()->route('experiences.liste')
            ->with('success', 'Expérience désactivée avec succès.');
    }

    /**
     * Active une expérience (change l'état en Actif)
     *
     * @param Experience $experience
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Experience $experience)
    {
        $experience->update(['etat' => 'Actif']);

        return redirect()->route('experiences.liste')
            ->with('success', 'Expérience activée avec succès.');
    }
}
