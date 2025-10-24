@extends('layouts.app')
@section('title','Coda di revisione')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="mb-0">Coda di revisione</h1>
  <a href="{{ route('revisor.dashboard') }}" class="btn btn-outline-secondary">« Dashboard Revisor</a>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table align-middle mb-0">
      <thead><tr>
        <th>Titolo</th><th>Autore</th><th>Categoria</th><th>Min</th><th class="text-end">Azioni</th>
      </tr></thead>
      <tbody>
        @forelse($queue as $a)
          <tr>
            <td class="fw-semibold">{{ $a->title }}</td>
            <td class="text-muted">{{ $a->user->name }}</td>
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
          <tr><td colspan="5" class="text-center text-muted">Nessun articolo in revisione</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $queue->links() }}</div>
@endsection
