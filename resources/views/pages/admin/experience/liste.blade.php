@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Expériences Professionnelles</h3>
        <a href="{{ route('experiences.create') }}" class="btn btn-primary">+ Nouvelle Expérience</a>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          {{-- Commentaire étudiant : boucle affichant toutes les expériences --}}
          @forelse($experiences as $experience)
            <div class="row border-bottom pb-3 mb-3">
              <div class="col-md-8">
                <h5>{{ $experience->poste }}</h5>
                <small class="text-muted">
                  <strong>Entreprise :</strong> {{ $experience->entreprise->nom ?? 'N/A' }} | 
                  <strong>Période :</strong> {{ $experience->date_debut ?? 'N/A' }} - {{ $experience->date_fin ?? 'Actuellement' }}
                </small>
              </div>
              <div class="col-md-4 text-end">
                <span class="badge {{ $experience->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $experience->etat }}</span>
                <a href="{{ route('experiences.show', $experience) }}" class="btn btn-sm btn-info">Voir</a>
                <a href="{{ route('experiences.update', $experience) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form method="POST" action="{{ route('experiences.destroy', $experience) }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                </form>
              </div>
            </div>
          @empty
            <p class="text-center text-muted">Aucune expérience enregistrée.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
