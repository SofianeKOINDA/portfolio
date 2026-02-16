@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Catégories</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Nouvelle Catégorie</a>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {{-- Commentaire étudiant : liste des catégories de projets --}}
            @forelse($categories as $categorie)
              <tr>
                <td>{{ $categorie->nom }}</td>
                <td>{{ Str::limit($categorie->description ?? 'N/A', 50) }}</td>
                <td>
                  <a href="{{ route('categories.show', $categorie) }}" class="btn btn-sm btn-info">Voir</a>
                  <a href="{{ route('categories.update', $categorie) }}" class="btn btn-sm btn-warning">Modifier</a>
                  <form method="POST" action="{{ route('categories.destroy', $categorie) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="text-center text-muted">Aucune catégorie enregistrée.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
