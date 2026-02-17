<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * Contrôleur pour la gestion des messages de contact
 *
 * Ce contrôleur gère toutes les opérations CRUD pour les messages de contact,
 * incluant le marquage comme lu et la gestion des réponses.
 */
class ContactController extends Controller
{
    /**
     * Affiche la liste de tous les messages de contact
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('pages.admin.contact.liste', compact('contacts'));
    }

    /**
     * Enregistre un nouveau message dans la base de données
     *
     * @param StoreContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        Contact::create($data);

        return redirect()->route('contacts.liste')
            ->with('success', 'Message créé avec succès.');
    }

    /**
     * Enregistre un message depuis le formulaire public du site
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePublic(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'nom.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'sujet.required' => 'Le sujet est requis.',
            'message.required' => 'Le message est requis.',
        ]);

        // Ajouter les valeurs par défaut
        $validated['lu'] = false;
        $validated['repondu'] = false;

        Contact::create($validated);

        return redirect()->back()
            ->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    /**
     * Affiche les détails d'un message spécifique
     *
     * @param Contact $contact
     * @return \Illuminate\View\View
     */
    public function show(Contact $contact)
    {
        // Marquer comme lu
        $contact->markAsRead();

        return view('pages.admin.contact.show', compact('contact'));
    }

    /**
     * Met à jour un message existant
     *
     * @param UpdateContactRequest $request
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();

        $contact->update($data);

        return redirect()->route('contacts.liste')
            ->with('success', 'Message mis à jour avec succès.');
    }

    /**
     * Supprime un message de la base de données
     *
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.liste')
            ->with('success', 'Message supprimé avec succès.');
    }

    /**
     * Marque un message comme lu
     *
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead(Contact $contact)
    {
        $contact->markAsRead();

        return redirect()->back()
            ->with('success', 'Message marqué comme lu.');
    }

    /**
     * Marque un message comme répondu et enregistre la réponse
     *
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsAnswered(Contact $contact)
    {
        $reponse = request('reponse');

        $contact->markAsAnswered($reponse);

        return redirect()->route('contacts.liste')
            ->with('success', 'Réponse enregistrée avec succès.');
    }
}
