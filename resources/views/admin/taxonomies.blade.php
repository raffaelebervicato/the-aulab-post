@extends('layouts.app')
@section('title','Categorie & Tag')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Categorie & Tag</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">« Torna alla dashboard</a>
  </div>

  <div class="alert alert-info">
    Questa sezione è un placeholder. Nel prossimo step aggiungiamo:
    <ul class="mb-0">
      <li>CRUD Categorie (nome, slug)</li>
      <li>CRUD Tag (nome, slug)</li>
      <li>Validazioni, ricerca, paginazione</li>
    </ul>
  </div>
@endsection
