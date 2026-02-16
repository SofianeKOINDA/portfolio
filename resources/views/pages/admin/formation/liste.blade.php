@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Formations</h3>
        <a href="{{ route('formations.create') }}" class="btn btn-primary">+ Nouvelle Formation</a>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          {{-- Commentaire étudiant : tableau listant les formations actives --}}
          @forelse($formations as $formation)
            <div class="row border-bottom pb-3 mb-3">
              <div class="col-md-8">
                <h5>{{ $formation->diplome }}</h5>
                <small class="text-muted">
                  <strong>École :</strong> {{ $formation->entreprise->nom ?? 'Non défini' }} | 
                  <strong>Dates :</strong> {{ $formation->date_debut ?? 'N/A' }} à {{ $formation->date_fin ?? 'N/A' }}
                </small>
              </div>
              <div class="col-md-4 text-end">
                <span class="badge {{ $formation->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $formation->etat }}</span>
                <a href="{{ route('formations.show', $formation) }}" class="btn btn-sm btn-info">Voir</a>
                <a href="{{ route('formations.update', $formation) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form method="POST" action="{{ route('formations.destroy', $formation) }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                </form>
              </div>
            </div>
          @empty
            <p class="text-center text-muted">Aucune formation enregistrée.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
