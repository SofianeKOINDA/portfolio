<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;
use App\Models\Formation;
use App\Models\Entreprise;

/**
 * Contrôleur pour la gestion des formations
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les formations,
 * incluant les relations avec les entreprises/écoles.
 */
class FormationController extends Controller
{
    /**
     * Affiche la liste de toutes les formations
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $formations = Formation::with('entreprise')
            ->orderBy('created_at', 'desc')
            ->get();

        $entreprises = Entreprise::where('etat', 'Actif')
            ->orderBy('nom', 'asc')
            ->get();

        return view('pages.admin.formation.liste', compact('formations', 'entreprises'));
    }

    /**
     * Enregistre une nouvelle formation dans la base de données
     *
     * @param StoreFormationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFormationRequest $request)
    {
        $data = $request->validated();

        Formation::create($data);

        return redirect()->route('formations.liste')
            ->with('success', 'Formation créée avec succès.');
    }

    /**
     * Affiche les détails d'une formation spécifique
     *
     * @param Formation $formation
     * @return \Illuminate\View\View
     */
    public function show(Formation $formation)
    {
        $formation->load('entreprise');

        return view('pages.admin.formation.liste', compact('formation'));
    }

    /**
     * Met à jour une formation existante
     *
     * @param UpdateFormationRequest $request
     * @param Formation $formation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $data = $request->validated();

        $formation->update($data);

        return redirect()->route('formations.liste')
            ->with('success', 'Formation mise à jour avec succès.');
    }

    /**
     * Désactive une formation (change l'état en Inactif)
     *
     * @param Formation $formation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Formation $formation)
    {
        $formation->update(['etat' => 'Inactif']);

        return redirect()->route('formations.liste')
            ->with('success', 'Formation désactivée avec succès.');
    }

    /**
     * Active une formation (change l'état en Actif)
     *
     * @param Formation $formation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Formation $formation)
    {
        $formation->update(['etat' => 'Actif']);

        return redirect()->route('formations.liste')
            ->with('success', 'Formation activée avec succès.');
    }
}
