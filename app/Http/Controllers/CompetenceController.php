<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompetenceRequest;
use App\Http\Requests\UpdateCompetenceRequest;
use App\Models\Competence;

/**
 * Contrôleur pour la gestion des compétences
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les compétences,
 * incluant les relations avec les projets.
 */
class CompetenceController extends Controller
{
    /**
     * Affiche la liste de toutes les compétences
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $competences = Competence::withCount('projets')->get();

        return view('pages.admin.competence.liste', compact('competences'));
    }

    /**
     * Enregistre une nouvelle compétence dans la base de données
     *
     * @param StoreCompetenceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCompetenceRequest $request)
    {
        $data = $request->validated();

        Competence::create($data);

        return redirect()->route('competences.liste')
            ->with('success', 'Compétence créée avec succès.');
    }

    /**
     * Affiche les détails d'une compétence spécifique
     *
     * @param Competence $competence
     * @return \Illuminate\View\View
     */
    public function show(Competence $competence)
    {
        $competence->load('projets');

        return view('pages.admin.competence.liste', compact('competence'));
    }

    /**
     * Met à jour une compétence existante
     *
     * @param UpdateCompetenceRequest $request
     * @param Competence $competence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompetenceRequest $request, Competence $competence)
    {
        $data = $request->validated();

        $competence->update($data);

        return redirect()->route('competences.liste')
            ->with('success', 'Compétence mise à jour avec succès.');
    }

    /**
     * Désactive une compétence (change l'état en Inactif)
     *
     * @param Competence $competence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Competence $competence)
    {
        $competence->update(['etat' => 'Inactif']);

        return redirect()->route('competences.liste')
            ->with('success', 'Compétence désactivée avec succès.');
    }

    /**
     * Active une compétence (change l'état en Actif)
     *
     * @param Competence $competence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Competence $competence)
    {
        $competence->update(['etat' => 'Actif']);

        return redirect()->route('competences.liste')
            ->with('success', 'Compétence activée avec succès.');
    }
}
