@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $user->nom }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : détails d'un utilisateur --}}
          <div class="mb-3">
            <label class="form-label"><strong>Nom :</strong></label>
            <p>{{ $user->nom }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Email :</strong></label>
            <p>{{ $user->email }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Poste :</strong></label>
            <p>{{ $user->poste ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Téléphone :</strong></label>
            <p>{{ $user->tel1 ?? 'N/A' }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Adresse :</strong></label>
            <p>{{ $user->adresse ?? 'N/A' }}</p>
          </div>

          <div class="mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Modifier</a>
            @if($user->id !== auth()->id())
              <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
