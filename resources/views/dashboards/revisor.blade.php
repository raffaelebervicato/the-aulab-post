@extends('layouts.app')
@section('title','Dashboard Revisor')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Dashboard Revisor</h1>
    <span class="badge text-bg-secondary">Revisor</span>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-3">Coda di revisione</h5>

      {{-- Placeholder lista articoli da revisionare --}}
      <div class="list-group">
        <div class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <div class="fw-semibold">Titolo articolo di esempio</div>
            <div class="small text-muted">Autore: Mario • Categoria: Tech • 5 min</div>
          </div>
          <div class="btn-group">
            <button class="btn btn-sm btn-success" disabled>Accetta</button>
            <button class="btn btn-sm btn-danger" disabled>Rifiuta</button>
          </div>
        </div>
        <div class="list-group-item text-muted text-center">Integriamo i dati reali dopo.</div>
      </div>
    </div>
  </div>
@endsection
