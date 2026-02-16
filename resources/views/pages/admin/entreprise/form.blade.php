@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ isset($entreprise) ? 'Modifier l\'entreprise' : 'Créer une entreprise' }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : formulaire pour ajouter/éditer une entreprise --}}
          <form method="POST" action="{{ isset($entreprise) ? route('entreprises.update', $entreprise) : route('entreprises.store') }}">
            @csrf
            @if(isset($entreprise))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label class="form-label">Nom *</label>
              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $entreprise->nom ?? '') }}" required>
              @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Adresse</label>
              <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $entreprise->adresse ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Téléphone</label>
              <input type="tel" name="tel" class="form-control" value="{{ old('tel', $entreprise->tel ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email', $entreprise->email ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">État</label>
              <select name="etat" class="form-control">
                <option value="Actif" {{ old('etat', $entreprise->etat ?? 'Actif') == 'Actif' ? 'selected' : '' }}>Actif</option>
                <option value="Inactif" {{ old('etat', $entreprise->etat ?? 'Actif') == 'Inactif' ? 'selected' : '' }}>Inactif</option>
              </select>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">{{ isset($entreprise) ? 'Mettre à jour' : 'Créer' }}</button>
              <a href="{{ route('entreprises.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
