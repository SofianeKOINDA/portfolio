<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompetenceProjetRequest;
use App\Http\Requests\UpdateCompetenceProjetRequest;
use App\Models\Competence;
use App\Models\Projet;
use Illuminate\Http\Request;

/**
 * Contrôleur pour la gestion des associations compétence-projet
 *
 * Ce contrôleur gère les relations many-to-many entre les compétences et les projets.
 * Note: Ce contrôleur est principalement utilisé pour des opérations spécifiques
 * sur les associations, car la plupart des opérations sont gérées dans ProjetController.
 */
class CompetenceProjetController extends Controller
{
    /**
     * Affiche la liste de toutes les associations compétence-projet
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projets = Projet::with(['competences', 'categorie'])
            ->whereHas('competences')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.competence-projet.liste', compact('projets'));
    }

    /**
     * Enregistre une nouvelle association compétence-projet
     *
     * @param StoreCompetenceProjetRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCompetenceProjetRequest $request)
    {
        $data = $request->validated();

        $projet = Projet::find($data['projet_id']);
        $projet->competences()->attach($data['competence_id']);

        return redirect()->route('competence-projets.liste')
            ->with('success', 'Association créée avec succès.');
    }

    /**
     * Affiche les détails d'une association spécifique
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Cette méthode n'est généralement pas utilisée pour les tables pivot
        // mais peut être utile pour afficher les détails d'un projet avec ses compétences
        $projet = Projet::with('competences')->findOrFail($id);

        return view('pages.admin.competence-projet.show', compact('projet'));
    }

    /**
     * Met à jour une association existante
     *
     * @param UpdateCompetenceProjetRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompetenceProjetRequest $request, $id)
    {
        $data = $request->validated();
        $projet = Projet::findOrFail($id);

        // Synchroniser les compétences
        if (isset($data['competence_id'])) {
            $projet->competences()->sync([$data['competence_id']]);
        }

        return redirect()->route('competence-projets.liste')
            ->with('success', 'Association mise à jour avec succès.');
    }

    /**
     * Supprime une association compétence-projet
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Cette méthode peut être utilisée pour supprimer une association spécifique
        // mais généralement, on utilise sync() dans le ProjetController

        return redirect()->route('competence-projets.liste')
            ->with('success', 'Association supprimée avec succès.');
    }

    /**
     * Supprime une compétence spécifique d'un projet
     *
     * @param Request $request
     * @param int $projetId
     * @param int $competenceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachCompetence(Request $request, $projetId, $competenceId)
    {
        $projet = Projet::findOrFail($projetId);
        $projet->competences()->detach($competenceId);

        return redirect()->back()
            ->with('success', 'Compétence retirée du projet avec succès.');
    }
}
