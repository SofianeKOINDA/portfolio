<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use App\Models\Entreprise;

/**
 * Contrôleur pour la gestion des entreprises
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les entreprises,
 * incluant les entreprises, écoles et clients.
 */
class EntrepriseController extends Controller
{
    /**
     * Affiche la liste de toutes les entreprises
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $entreprises = Entreprise::withCount(['experiences', 'formations'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.entreprise.liste', compact('entreprises'));
    }

    /**
     * Enregistre une nouvelle entreprise dans la base de données
     *
     * @param StoreEntrepriseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEntrepriseRequest $request)
    {
        $data = $request->validated();

        Entreprise::create($data);

        return redirect()->route('entreprises.liste')
            ->with('success', 'Entreprise créée avec succès.');
    }

    /**
     * Affiche les détails d'une entreprise spécifique
     *
     * @param Entreprise $entreprise
     * @return \Illuminate\View\View
     */
    public function show(Entreprise $entreprise)
    {
        $entreprise->load(['experiences', 'formations']);

        return view('pages.admin.entreprise.show', compact('entreprise'));
    }

    /**
     * Met à jour une entreprise existante
     *
     * @param UpdateEntrepriseRequest $request
     * @param Entreprise $entreprise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise)
    {
        $data = $request->validated();

        $entreprise->update($data);

        return redirect()->route('entreprises.liste')
            ->with('success', 'Entreprise mise à jour avec succès.');
    }

    /**
     * Désactive une entreprise (change l'état en Inactif)
     *
     * @param Entreprise $entreprise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Entreprise $entreprise)
    {
        $entreprise->update(['etat' => 'Inactif']);

        return redirect()->route('entreprises.liste')
            ->with('success', 'Entreprise désactivée avec succès.');
    }

    /**
     * Active une entreprise (change l'état en Actif)
     *
     * @param Entreprise $entreprise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Entreprise $entreprise)
    {
        $entreprise->update(['etat' => 'Actif']);

        return redirect()->route('entreprises.liste')
            ->with('success', 'Entreprise activée avec succès.');
    }
}
