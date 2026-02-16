@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <h3 class="mb-4">Contacts & Messages</h3>

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
              <th>Email</th>
              <th>Sujet</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {{-- Commentaire étudiant : liste de tous les messages de contact reçus --}}
            @forelse($contacts as $contact)
              <tr>
                <td>{{ $contact->nom }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->sujet }}</td>
                <td>
                  <span class="badge {{ $contact->lu ? 'bg-success' : 'bg-warning' }}">
                    {{ $contact->lu ? 'Lu' : 'Non lu' }}
                  </span>
                  @if($contact->repondu)
                    <span class="badge bg-info">Répondu</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-info">Voir</a>
                  <form method="POST" action="{{ route('contacts.destroy', $contact) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted">Aucun message pour le moment.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
