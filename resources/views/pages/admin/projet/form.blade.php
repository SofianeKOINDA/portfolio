@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ isset($projet) ? 'Modifier le projet' : 'Créer un nouveau projet' }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : formulaire pour créer ou éditer un projet --}}
          <form method="POST" action="{{ isset($projet) ? route('projets.update', $projet) : route('projets.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($projet))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label class="form-label">Nom *</label>
              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $projet->nom ?? '') }}" required>
              @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Type *</label>
              <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                <option value="">Sélectionner...</option>
                <option value="Projet" {{ old('type', $projet->type ?? '') == 'Projet' ? 'selected' : '' }}>Projet</option>
                <option value="Service" {{ old('type', $projet->type ?? '') == 'Service' ? 'selected' : '' }}>Service</option>
              </select>
              @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Catégorie *</label>
              <select name="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror" required>
                <option value="">Sélectionner...</option>
                @foreach($categories ?? [] as $cat)
                  <option value="{{ $cat->id }}" {{ old('categorie_id', $projet->categorie_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->nom }}</option>
                @endforeach
              </select>
              @error('categorie_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Description *</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $projet->description ?? '') }}</textarea>
              @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Date *</label>
              <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $projet->date ?? '') }}" required>
              @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Client</label>
              <input type="text" name="client" class="form-control" value="{{ old('client', $projet->client ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">URL</label>
              <input type="url" name="url" class="form-control" value="{{ old('url', $projet->url ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">État</label>
              <select name="etat" class="form-control">
                <option value="Actif" {{ old('etat', $projet->etat ?? 'Actif') == 'Actif' ? 'selected' : '' }}>Actif</option>
                <option value="Inactif" {{ old('etat', $projet->etat ?? 'Actif') == 'Inactif' ? 'selected' : '' }}>Inactif</option>
              </select>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">{{ isset($projet) ? 'Mettre à jour' : 'Créer' }}</button>
              <a href="{{ route('projets.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
