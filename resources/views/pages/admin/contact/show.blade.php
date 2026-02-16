@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5>{{ $contact->nom }}</h5>
        </div>
        <div class="card-body">
          {{-- Commentaire étudiant : détails d'un message de contact --}}
          <div class="mb-3">
            <label class="form-label"><strong>Nom :</strong></label>
            <p>{{ $contact->nom }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Email :</strong></label>
            <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Sujet :</strong></label>
            <p>{{ $contact->sujet }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Message :</strong></label>
            <p>{{ $contact->message }}</p>
          </div>

          <div class="mb-3">
            <label class="form-label"><strong>Statut :</strong></label>
            <p>
              <span class="badge {{ $contact->lu ? 'bg-success' : 'bg-warning' }}">{{ $contact->lu ? 'Lu' : 'Non lu' }}</span>
              @if($contact->repondu)
                <span class="badge bg-info">Répondu</span>
              @endif
            </p>
          </div>

          <div class="mt-4">
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Retour</a>
            @if(!$contact->repondu)
              <form method="POST" action="{{ route('contacts.mark-reply', $contact) }}" style="display: inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Marquer comme répondu</button>
              </form>
            @endif
            <form method="POST" action="{{ route('contacts.destroy', $contact) }}" style="display: inline;">
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
