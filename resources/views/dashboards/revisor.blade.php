@extends('layouts.app')
@section('title','Dashboard Revisor')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="mb-0">Dashboard Revisor</h1>
      <span class="badge text-bg-secondary">Revisor</span>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('revisor.queue') }}" class="btn btn-primary">Apri coda di revisione</a>
    </div>
  </div>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

  @php
    use App\Models\Article;
    $totInRev   = Article::where('status','in_revisione')->count();
    $totOk      = Article::where('status','accettato')->count();
    $totKo      = Article::where('status','rifiutato')->count();
    $ultimi     = Article::with('user','category')->where('status','in_revisione')->latest()->take(8)->get();
  @endphp

  {{-- Stat cards --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="text-muted small">In revisione</div>
        <div class="fs-3 fw-bold">{{ $totInRev }}</div>
      </div></div>
    </div>
    <div class="col-6 col-md-4">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="text-muted small">Accettati</div>
        <div class="fs-3 fw-bold">{{ $totOk }}</div>
      </div></div>
    </div>
    <div class="col-6 col-md-4">
      <div class="card shadow-sm h-100"><div class="card-body">
        <div class="text-muted small">Rifiutati</div>
        <div class="fs-3 fw-bold">{{ $totKo }}</div>
      </div></div>
    </div>
  </div>

  {{-- Ultimi in coda --}}
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span class="fw-semibold">Ultimi articoli in revisione</span>
      <a href="{{ route('revisor.queue') }}" class="btn btn-sm btn-outline-secondary">Vedi coda completa</a>
    </div>
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th style="width:40%">Titolo</th>
            <th style="width:18%">Autore</th>
            <th style="width:18%">Categoria</th>
            <th style="width:9%">Min</th>
            <th class="text-end" style="width:15%">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @forelse($ultimi as $a)
            <tr>
              <td class="fw-semibold">
                {{ $a->title }}
                @if($a->subtitle)
                  <div class="small text-muted">{{ $a->subtitle }}</div>
                @endif
              </td>
              <td class="text-muted">{{ $a->user->name ?? '-' }}</td>
              <td class="text-muted">{{ $a->category->name ?? '-' }}</td>
              <td>{{ $a->reading_minutes }}</td>
              <td class="text-end">
                <form action="{{ route('revisor.accept',$a) }}" method="POST" class="d-inline">@csrf
                  <button class="btn btn-sm btn-success">Accetta</button>
                </form>
                <form action="{{ route('revisor.reject',$a) }}" method="POST" class="d-inline ms-1">@csrf
                  <button class="btn btn-sm btn-danger">Rifiuta</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center text-muted p-4">Nessun articolo in revisione.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
