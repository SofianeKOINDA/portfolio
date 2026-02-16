@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ isset($competence) ? 'Modifier la compétence' : 'Créer une compétence' }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : formulaire pour ajouter/éditer une compétence --}}
          <form method="POST" action="{{ isset($competence) ? route('competences.update', $competence) : route('competences.store') }}">
            @csrf
            @if(isset($competence))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label class="form-label">Nom *</label>
              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $competence->nom ?? '') }}" required>
              @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Type *</label>
              <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="">Sélectionner...</option>
                <option value="Technique" {{ old('type', $competence->type ?? '') == 'Technique' ? 'selected' : '' }}>Technique</option>
                <option value="Soft Skill" {{ old('type', $competence->type ?? '') == 'Soft Skill' ? 'selected' : '' }}>Soft Skill</option>
              </select>
              @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Niveau (%) *</label>
              <input type="number" name="niveau" class="form-control @error('niveau') is-invalid @enderror" min="0" max="100" value="{{ old('niveau', $competence->niveau ?? 50) }}" required>
              @error('niveau') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description', $competence->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">État</label>
              <select name="etat" class="form-control">
                <option value="Actif" {{ old('etat', $competence->etat ?? 'Actif') == 'Actif' ? 'selected' : '' }}>Actif</option>
                <option value="Inactif" {{ old('etat', $competence->etat ?? 'Actif') == 'Inactif' ? 'selected' : '' }}>Inactif</option>
              </select>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">{{ isset($competence) ? 'Mettre à jour' : 'Créer' }}</button>
              <a href="{{ route('competences.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
