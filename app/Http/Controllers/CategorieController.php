<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Categorie;

/**
 * Contrôleur pour la gestion des catégories
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les catégories,
 * incluant les relations avec les projets.
 */
class CategorieController extends Controller
{
    /**
     * Affiche la liste de toutes les catégories
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Categorie::withCount('projets')
            ->orderBy('nom')
            ->get();

        return view('pages.admin.categorie.liste', compact('categories'));
    }

    /**
     * Enregistre une nouvelle catégorie dans la base de données
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        Categorie::create($data);

        return redirect()->route('categories.liste')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche les détails d'une catégorie spécifique
     *
     * @param Categorie $categorie
     * @return \Illuminate\View\View
     */
    public function show(Categorie $categorie)
    {
        $categorie->load('projets');

        return view('pages.admin.categorie.liste', compact('categorie'));
    }

    /**
     * Met à jour une catégorie existante
     *
     * @param UpdateCategoryRequest $request
     * @param Categorie $categorie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Categorie $categorie)
    {
        $data = $request->validated();

        $categorie->update($data);

        return redirect()->route('categories.liste')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime définitivement une catégorie
     *
     * @param Categorie $categorie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Categorie $categorie)
    {
        // Vérifier s'il y a des relations avant de supprimer
        if ($categorie->projets()->count() > 0) {
            return redirect()->route('categories.liste')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des projets.');
        }

        $categorie->delete();

        return redirect()->route('categories.liste')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
