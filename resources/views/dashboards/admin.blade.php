@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Dashboard Admin</h1>
    <span class="badge text-bg-dark">Admin</span>
  </div>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

  <div class="row g-3">
    {{-- Utenti & Ruoli --}}
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Utenti & Ruoli</h5>
          <p class="text-muted mb-3">Assegna ruoli e gestisci gli accessi.</p>
          <a href="{{ route('admin.users.roles') }}" class="btn btn-outline-dark w-100">Gestisci utenti</a>
        </div>
      </div>
    </div>

    {{-- Categorie & Tag --}}
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Categorie & Tag</h5>
          <p class="text-muted mb-3">Organizza tassonomie editoriali.</p>
          <div class="d-grid gap-2 d-md-block">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary me-2">Categorie</a>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-primary">Tag</a>
          </div>
        </div>
      </div>
    </div>

    {{-- Richieste Ruolo --}}
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Richieste ruolo</h5>
          <p class="text-muted mb-3">Approva/nega richieste “Lavora con noi”.</p>
          <a href="{{ route('admin.requests') }}" class="btn btn-outline-dark w-100">Vedi richieste</a>
        </div>
      </div>
    </div>
  </div>
@endsection
