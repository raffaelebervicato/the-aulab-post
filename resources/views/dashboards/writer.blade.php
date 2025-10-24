@extends('layouts.app')
@section('title','Dashboard Writer')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">Dashboard Writer</h1>
    <span class="badge text-bg-primary">Writer</span>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">I tuoi articoli</h5>
    <a href="#" class="btn btn-primary disabled" aria-disabled="true">+ Nuovo articolo (soon)</a>
  </div>

  {{-- Placeholder griglia articoli propri --}}
  <div class="row g-3">
    @foreach(range(1,4) as $i)
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm">
          <img src="https://picsum.photos/seed/wr{{ $i }}/600/340" class="card-img-top" alt="">
          <div class="card-body">
            <h6 class="card-title">Titolo #{{ $i }}</h6>
            <div class="small text-muted mb-2">Stato: <span class="badge text-bg-warning">In revisione</span></div>
            <div class="btn-group w-100">
              <button class="btn btn-sm btn-outline-secondary" disabled>Modifica</button>
              <button class="btn btn-sm btn-outline-danger" disabled>Elimina</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
