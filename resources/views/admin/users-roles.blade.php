@extends('layouts.app')
@section('title','Utenti & Ruoli')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Utenti & Ruoli</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">« Torna alla dashboard</a>
  </div>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th class="text-center">Admin</th>
            <th class="text-center">Revisor</th>
            <th class="text-center">Writer</th>
            <th class="text-end">Azione rapida</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $u)
            <tr>
              <td class="fw-semibold">{{ $u->name }}</td>
              <td class="text-muted">{{ $u->email }}</td>

              {{-- Badges ruolo (true/null/false) --}}
              @foreach (['admin'=>'dark','revisor'=>'secondary','writer'=>'primary'] as $role => $color)
                @php
                  $col = 'is_'.$role;
                  $val = $u->$col;
                @endphp
                <td class="text-center">
                  @if($val === true)
                    <span class="badge text-bg-{{ $color }}">Attivo</span>
                  @elseif(is_null($val))
                    <span class="badge text-bg-warning">Richiesta</span>
                  @else
                    <span class="badge text-bg-light text-dark">—</span>
                  @endif
                </td>
              @endforeach

              <td class="text-end">
                <div class="btn-group">
                  {{-- Concedi/Revoca admin --}}
                  <form method="POST" action="{{ route('admin.roles.grant', [$u, 'admin']) }}">@csrf
                    <button class="btn btn-sm btn-outline-dark" {{ $u->is_admin ? 'disabled' : '' }}>Concedi Admin</button>
                  </form>
                  <form method="POST" action="{{ route('admin.roles.revoke', [$u, 'admin']) }}" class="ms-1">@csrf
                    <button class="btn btn-sm btn-outline-danger" {{ !$u->is_admin ? 'disabled' : '' }}>Revoca</button>
                  </form>
                </div>
                <div class="btn-group mt-1">
                  {{-- Concedi/Revoca revisor --}}
                  <form method="POST" action="{{ route('admin.roles.grant', [$u, 'revisor']) }}">@csrf
                    <button class="btn btn-sm btn-outline-secondary" {{ $u->is_revisor ? 'disabled' : '' }}>Concedi Revisor</button>
                  </form>
                  <form method="POST" action="{{ route('admin.roles.revoke', [$u, 'revisor']) }}" class="ms-1">@csrf
                    <button class="btn btn-sm btn-outline-danger" {{ !$u->is_revisor ? 'disabled' : '' }}>Revoca</button>
                  </form>
                </div>
                <div class="btn-group mt-1">
                  {{-- Concedi/Revoca writer --}}
                  <form method="POST" action="{{ route('admin.roles.grant', [$u, 'writer']) }}">@csrf
                    <button class="btn btn-sm btn-outline-primary" {{ $u->is_writer ? 'disabled' : '' }}>Concedi Writer</button>
                  </form>
                  <form method="POST" action="{{ route('admin.roles.revoke', [$u, 'writer']) }}" class="ms-1">@csrf
                    <button class="btn btn-sm btn-outline-danger" {{ !$u->is_writer ? 'disabled' : '' }}>Revoca</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-muted">Nessun utente</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
