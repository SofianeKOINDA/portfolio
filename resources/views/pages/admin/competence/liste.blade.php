@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Compétences</h3>
        <a href="{{ route('competences.create') }}" class="btn btn-primary">+ Nouvelle Compétence</a>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          {{-- Commentaire étudiant : tableau affichant les compétences techniques et soft skills --}}
          @forelse($competences as $competence)
            <div class="row border-bottom pb-3 mb-3">
              <div class="col-md-8">
                <h5>{{ $competence->nom }}</h5>
                <small class="text-muted">
                  <strong>Type :</strong> {{ $competence->type }} | 
                  <strong>Niveau :</strong> {{ $competence->niveau }}%
                </small>
              </div>
              <div class="col-md-4 text-end">
                <span class="badge {{ $competence->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $competence->etat }}</span>
                <a href="{{ route('competences.show', $competence) }}" class="btn btn-sm btn-info">Voir</a>
                <a href="{{ route('competences.update', $competence) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form method="POST" action="{{ route('competences.destroy', $competence) }}" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                </form>
              </div>
            </div>
          @empty
            <p class="text-center text-muted">Aucune compétence enregistrée.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
