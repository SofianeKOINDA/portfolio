@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $entreprise->nom }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : détails d'une entreprise --}}
          <div class="mb-3">
            <label class="form-label"><strong>Nom :</strong></label>
            <p>{{ $entreprise->nom }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse :</strong></label>
            <p>{{ $entreprise->adresse ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Téléphone :</strong></label>
            <p>{{ $entreprise->tel ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Email :</strong></label>
            <p>{{ $entreprise->email ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>État :</strong></label>
            <span class="badge {{ $entreprise->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $entreprise->etat }}</span>
          </div>

          <div class="mt-4">
            <a href="{{ route('entreprises.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('entreprises.edit', $entreprise) }}" class="btn btn-warning">Modifier</a>
            <form method="POST" action="{{ route('entreprises.destroy', $entreprise) }}" style="display: inline;">
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
