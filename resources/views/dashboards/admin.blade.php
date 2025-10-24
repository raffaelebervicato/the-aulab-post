@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Dashboard Admin</h1>
    <span class="badge text-bg-dark">Admin</span>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Utenti & Ruoli</h5>
          <p class="text-muted mb-3">Assegna ruoli e gestisci gli accessi.</p>
          <a href="#" class="btn btn-outline-dark disabled" aria-disabled="true">Vai (soon)</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Categorie & Tag</h5>
          <p class="text-muted mb-3">Organizza tassonomie editoriali.</p>
          <a href="#" class="btn btn-outline-dark disabled" aria-disabled="true">Vai (soon)</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Richieste ruolo</h5>
          <p class="text-muted mb-3">Approva/nega richieste “Lavora con noi”.</p>
          <a href="#" class="btn btn-outline-dark disabled" aria-disabled="true">Vai (soon)</a>
        </div>
      </div>
    </div>
  </div>
@endsection
