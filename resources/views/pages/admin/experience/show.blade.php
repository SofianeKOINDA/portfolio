@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $experience->poste }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : détails d'une expérience professionnelle --}}
          <div class="mb-3">
            <label class="form-label"><strong>Poste :</strong></label>
            <p>{{ $experience->poste }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Entreprise :</strong></label>
            <p>{{ $experience->entreprise->nom ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Période :</strong></label>
            <p>{{ $experience->date_debut ?? 'N/A' }} - {{ $experience->date_fin ?? 'Actuellement' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description :</strong></label>
            <p>{{ $experience->description }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>État :</strong></label>
            <span class="badge {{ $experience->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $experience->etat }}</span>
          </div>

          <div class="mt-4">
            <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('experiences.edit', $experience) }}" class="btn btn-warning">Modifier</a>
            <form method="POST" action="{{ route('experiences.destroy', $experience) }}" style="display: inline;">
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
