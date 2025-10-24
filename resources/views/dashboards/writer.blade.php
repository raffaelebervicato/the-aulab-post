@extends('layouts.app')
@section('title','Dashboard Writer')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="mb-0">Dashboard Writer</h1>
      <span class="badge text-bg-primary">Writer</span>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('writer.articles.index') }}" class="btn btn-outline-secondary">Lista articoli</a>
      <a href="{{ route('writer.articles.create') }}" class="btn btn-primary">+ Nuovo articolo</a>
    </div>
  </div>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

  @php
    use App\Models\Article;
    $uid = auth()->id();
    $tot        = Article::where('user_id',$uid)->count();
    $rev        = Article::where('user_id',$uid)->where('status','in_revisione')->count();
    $acc        = Article::where('user_id',$uid)->where('status','accettato')->count();
    $rif        = Article::where('user_id',$uid)->where('status','rifiutato')->count();
    $recenti    = Article::where('user_id',$uid)->latest()->take(5)->get();
  @endphp

  {{-- Stat cards --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small">Totali</div>
          <div class="fs-3 fw-bold">{{ $tot }}</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small">In revisione</div>
          <div class="fs-3 fw-bold">{{ $rev }}</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small">Accettati</div>
          <div class="fs-3 fw-bold">{{ $acc }}</div>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small">Rifiutati</div>
          <div class="fs-3 fw-bold">{{ $rif }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Ultimi articoli --}}
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span class="fw-semibold">Ultimi 5 articoli</span>
      <a href="{{ route('writer.articles.index') }}" class="btn btn-sm btn-outline-secondary">Vedi tutti</a>
    </div>
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th style="width:42%">Titolo</th>
            <th style="width:18%">Categoria</th>
            <th style="width:15%">Stato</th>
            <th style="width:10%">Min</th>
            <th class="text-end" style="width:15%">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recenti as $a)
            <tr>
              <td class="fw-semibold">
                {{ $a->title }}
                @if($a->subtitle)
                  <div class="small text-muted">{{ $a->subtitle }}</div>
                @endif
              </td>
              <td class="text-muted">{{ $a->category->name ?? '-' }}</td>
              <td>
                @if($a->status==='in_revisione')
                  <span class="badge text-bg-warning">In revisione</span>
                @elseif($a->status==='accettato')
                  <span class="badge text-bg-success">Accettato</span>
                @else
                  <span class="badge text-bg-danger">Rifiutato</span>
                @endif
              </td>
              <td>{{ $a->reading_minutes }}</td>
              <td class="text-end">
                <a href="{{ route('writer.articles.edit',$a) }}" class="btn btn-sm btn-outline-secondary">Modifica</a>
                <form action="{{ route('writer.articles.destroy',$a) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Eliminare l\'articolo?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Elimina</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted p-4">
                Nessun articolo ancora. <a href="{{ route('writer.articles.create') }}">Creane uno ora</a>.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
