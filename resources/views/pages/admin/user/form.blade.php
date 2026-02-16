@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ isset($user) ? 'Modifier l\'utilisateur' : 'Créer un utilisateur' }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : formulaire pour ajouter/éditer un utilisateur --}}
          <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
            @csrf
            @if(isset($user))
              @method('PUT')
            @endif

            <div class="mb-3">
              <label class="form-label">Nom *</label>
              <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $user->nom ?? '') }}" required>
              @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Email *</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? '') }}" required>
              @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Mot de passe {{ isset($user) ? '(laisser vide pour conserver)' : '*' }}</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" {{ !isset($user) ? 'required' : '' }}>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Poste</label>
              <input type="text" name="poste" class="form-control" value="{{ old('poste', $user->poste ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Téléphone 1</label>
              <input type="tel" name="tel1" class="form-control" value="{{ old('tel1', $user->tel1 ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Téléphone 2</label>
              <input type="tel" name="tel2" class="form-control" value="{{ old('tel2', $user->tel2 ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Adresse</label>
              <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $user->adresse ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Slogan</label>
              <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $user->slogan ?? '') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description', $user->description ?? '') }}</textarea>
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Mettre à jour' : 'Créer' }}</button>
              <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
