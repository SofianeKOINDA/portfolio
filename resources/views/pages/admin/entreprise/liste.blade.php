@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Entreprises</h3>
        <a href="{{ route('entreprises.create') }}" class="btn btn-primary">+ Nouvelle Entreprise</a>
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
              <th>Adresse</th>
              <th>État</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {{-- Commentaire étudiant : tableau des entreprises --}}
            @forelse($entreprises as $entreprise)
              <tr>
                <td>{{ $entreprise->nom }}</td>
                <td>{{ $entreprise->adresse ?? 'N/A' }}</td>
                <td>
                  <span class="badge {{ $entreprise->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $entreprise->etat }}</span>
                </td>
                <td>
                  <a href="{{ route('entreprises.show', $entreprise) }}" class="btn btn-sm btn-info">Voir</a>
                  <a href="{{ route('entreprises.update', $entreprise) }}" class="btn btn-sm btn-warning">Modifier</a>
                  <form method="POST" action="{{ route('entreprises.destroy', $entreprise) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Aucune entreprise enregistrée.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
