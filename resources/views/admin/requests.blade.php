@extends('layouts.app')
@section('title','Richieste ruolo')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Richieste ruolo</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">« Torna alla dashboard</a>
  </div>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

  @foreach([
    ['Richieste Admin', $pendingAdmins ?? collect(), 'admin', 'dark'],
    ['Richieste Revisor', $pendingRevisors ?? collect(), 'revisor', 'secondary'],
    ['Richieste Writer', $pendingWriters ?? collect(), 'writer', 'primary'],
  ] as [$title,$list,$role,$color])
    <div class="card mb-4 shadow-sm">
      <div class="card-header fw-semibold">{{ $title }}</div>
      <div class="card-body p-0">
        <table class="table mb-0 align-middle">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th class="text-end">Azione</th>
            </tr>
          </thead>
          <tbody>
          @forelse($list as $u)
            <tr>
              <td class="fw-semibold">{{ $u->name }}</td>
              <td class="text-muted">{{ $u->email }}</td>
              <td class="text-end">
                <form method="POST" action="{{ route('admin.roles.grant', [$u, $role]) }}" class="d-inline">@csrf
                  <button class="btn btn-sm btn-{{ $color }}">Concedi {{ ucfirst($role) }}</button>
                </form>
                <form method="POST" action="{{ route('admin.roles.revoke', [$u, $role]) }}" class="d-inline ms-1">@csrf
                  <button class="btn btn-sm btn-outline-danger">Rifiuta</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="3" class="text-center text-muted">Nessuna richiesta</td></tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  @endforeach
@endsection
