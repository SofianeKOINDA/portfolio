@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ isset($experience) ? 'Modifier l\'expérience' : 'Créer une expérience' }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : formulaire pour ajouter/éditer une expérience professionnelle --}}
          <form method="POST" action="{{ isset($experience) ? route('experiences.update', $experience) : route('experiences.store') }}">
            @csrf
            @if(isset($experience))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label class="form-label">Poste *</label>
              <input type="text" name="poste" class="form-control @error('poste') is-invalid @enderror" value="{{ old('poste', $experience->poste ?? '') }}" required>
              @error('poste') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Entreprise *</label>
              <select name="entreprise_id" class="form-control @error('entreprise_id') is-invalid @enderror" required>
                <option value="">Sélectionner...</option>
                @foreach($entreprises ?? [] as $ent)
                  <option value="{{ $ent->id }}" {{ old('entreprise_id', $experience->entreprise_id ?? '') == $ent->id ? 'selected' : '' }}>{{ $ent->nom }}</option>
                @endforeach
              </select>
              @error('entreprise_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Date de début *</label>
              <input type="date" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', $experience->date_debut ?? '') }}" required>
              @error('date_debut') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Date de fin</label>
              <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin', $experience->date_fin ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description', $experience->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">État</label>
              <select name="etat" class="form-control">
                <option value="Actif" {{ old('etat', $experience->etat ?? 'Actif') == 'Actif' ? 'selected' : '' }}>Actif</option>
                <option value="Inactif" {{ old('etat', $experience->etat ?? 'Actif') == 'Inactif' ? 'selected' : '' }}>Inactif</option>
              </select>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">{{ isset($experience) ? 'Mettre à jour' : 'Créer' }}</button>
              <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
