@extends('layouts.app')

@section('content')
<div class="container py-4">
  {{-- Commentaire étudiant : affichage d'un projet spécifique avec ses détails et compétences --}}
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">{{ $projet->nom }}</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label"><strong>Type :</strong></label>
            <p>{{ $projet->type }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Catégorie :</strong></label>
            <p>{{ $projet->categorie->nom ?? 'Non défini' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Description :</strong></label>
            <p>{{ $projet->description }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Date :</strong></label>
            <p>{{ $projet->date->format('d/m/Y') }}</p>
          </div>

          @if(!empty($projet->client))
            <div class="mb-3">
              <label class="form-label"><strong>Client :</strong></label>
              <p>{{ $projet->client }}</p>
            </div>
          @endif

          @if(!empty($projet->url))
            <div class="mb-3">
              <label class="form-label"><strong>URL :</strong></label>
              <p><a href="{{ $projet->url }}" target="_blank">{{ $projet->url }}</a></p>
            </div>
          @endif

          <div class="mb-3">
            <label class="form-label"><strong>État :</strong></label>
            <span class="badge {{ $projet->etat === 'Actif' ? 'bg-success' : 'bg-secondary' }}">{{ $projet->etat }}</span>
          </div>

          {{-- Photos du projet --}}
          @if(!empty($projet->photo1))
            <div class="mb-3">
              <label class="form-label"><strong>Photos :</strong></label>
              <div class="row">
                @if(!empty($projet->photo1))
                  <div class="col-md-4">
                    <img src="{{ asset($projet->photo1) }}" class="img-fluid" alt="Photo 1">
                  </div>
                @endif
                @if(!empty($projet->photo2))
                  <div class="col-md-4">
                    <img src="{{ asset($projet->photo2) }}" class="img-fluid" alt="Photo 2">
                  </div>
                @endif
                @if(!empty($projet->photo3))
                  <div class="col-md-4">
                    <img src="{{ asset($projet->photo3) }}" class="img-fluid" alt="Photo 3">
                  </div>
                @endif
              </div>
            </div>
          @endif

          {{-- Compétences associées --}}
          <div class="mb-3">
            <label class="form-label"><strong>Compétences :</strong></label>
            <div>
              @forelse($projet->competences as $comp)
                <span class="badge bg-info">{{ $comp->nom }}</span>
              @empty
                <p>Aucune compétence associée</p>
              @endforelse
            </div>
          </div>

          {{-- Actions --}}
          <div class="mt-4">
            <a href="{{ route('projets.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('projets.update', $projet) }}" class="btn btn-warning">Modifier</a>
            <form method="POST" action="{{ route('projets.destroy', $projet) }}" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
