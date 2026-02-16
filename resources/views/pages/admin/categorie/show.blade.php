@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $categorie->nom }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : détails d'une catégorie --}}
          <div class="mb-3">
            <label class="form-label"><strong>Nom :</strong></label>
            <p>{{ $categorie->nom }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description :</strong></label>
            <p>{{ $categorie->description ?? 'N/A' }}</p>
          </div>

          <div class="mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-warning">Modifier</a>
            <form method="POST" action="{{ route('categories.destroy', $categorie) }}" style="display: inline;">
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
