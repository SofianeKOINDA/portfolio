@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $competence->nom }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : détails d'une compétence --}}
          <div class="mb-3">
            <label class="form-label"><strong>Nom :</strong></label>
            <p>{{ $competence->nom }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Type :</strong></label>
            <p>{{ $competence->type }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Niveau :</strong></label>
            <p>{{ $competence->niveau }}%</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description :</strong></label>
            <p>{{ $competence->description ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>État :</strong></label>
            <span class="badge {{ $competence->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $competence->etat }}</span>
          </div>

          <div class="mt-4">
            <a href="{{ route('competences.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('competences.edit', $competence) }}" class="btn btn-warning">Modifier</a>
            <form method="POST" action="{{ route('competences.destroy', $competence) }}" style="display: inline;">
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
