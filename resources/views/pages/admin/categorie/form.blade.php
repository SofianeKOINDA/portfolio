@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ isset($categorie) ? 'Modifier la catégorie' : 'Créer une catégorie' }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : formulaire pour ajouter/éditer une catégorie --}}
          <form method="POST" action="{{ isset($categorie) ? route('categories.update', $categorie) : route('categories.store') }}">
            @csrf
            @if(isset($categorie))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label class="form-label">Nom *</label>
              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $categorie->nom ?? '') }}" required>
              @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description', $categorie->description ?? '') }}</textarea>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">{{ isset($categorie) ? 'Mettre à jour' : 'Créer' }}</button>
              <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
