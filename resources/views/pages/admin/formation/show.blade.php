@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $formation->diplome }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : page de détail d'une formation --}}
          <div class="mb-3">
            <label class="form-label"><strong>École / Université :</strong></label>
            <p>{{ $formation->entreprise->nom ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Diplôme :</strong></label>
            <p>{{ $formation->diplome }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Date de début :</strong></label>
            <p>{{ $formation->date_debut ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Date de fin :</strong></label>
            <p>{{ $formation->date_fin ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description :</strong></label>
            <p>{{ $formation->description }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>État :</strong></label>
            <span class="badge {{ $formation->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $formation->etat }}</span>
          </div>

          <div class="mt-4">
            <a href="{{ route('formations.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('formations.edit', $formation) }}" class="btn btn-warning">Modifier</a>
            <form method="POST" action="{{ route('formations.destroy', $formation) }}" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
