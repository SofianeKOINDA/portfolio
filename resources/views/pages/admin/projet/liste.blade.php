@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Projets & Services</h3>
        {{-- Lien pour créer un nouveau projet --}}
        <a href="{{ route('projets.create') }}" class="btn btn-primary">+ Nouveau Projet</a>
      </div>

      {{-- Messages de succès/erreur --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- Tableau des projets --}}
      <div class="card">
        <div class="card-body">
          {{-- Commentaire étudiant : je boucle sur les projets pour afficher une liste complète --}}
          @forelse($projets as $projet)
            <div class="row border-bottom pb-3 mb-3">
              <div class="col-md-8">
                <h5>{{ $projet->nom }}</h5>
                <small class="text-muted">
                  <strong>Type :</strong> {{ $projet->type }} | 
                  <strong>Catégorie :</strong> {{ $projet->categorie->nom ?? 'Non défini' }}
                </small>
              </div>
              <div class="col-md-4 text-end">
                <span class="badge {{ $projet->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $projet->etat }}</span>
                <a href="{{ route('projets.show', $projet) }}" class="btn btn-sm btn-info">Voir</a>
                <a href="{{ route('projets.update', $projet) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form method="POST" action="{{ route('projets.destroy', $projet) }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                </form>
              </div>
            </div>
          @empty
            <p class="text-center text-muted">Aucun projet pour le moment.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
