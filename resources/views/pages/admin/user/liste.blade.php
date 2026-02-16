@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Utilisateurs</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Nouvel Utilisateur</a>
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
              <th>Email</th>
              <th>Poste</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {{-- Commentaire étudiant : liste des utilisateurs du système --}}
            @forelse($users as $user)
              <tr>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->poste ?? 'N/A' }}</td>
                <td>
                  <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-info">Voir</a>
                  <a href="{{ route('users.update', $user) }}" class="btn btn-sm btn-warning">Modifier</a>
                  @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sûr ?')">Supprimer</button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Aucun utilisateur.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
