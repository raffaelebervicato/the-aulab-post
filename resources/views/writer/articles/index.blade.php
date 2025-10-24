@extends('layouts.app')
@section('title','I miei articoli')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="mb-0">I miei articoli</h1>
  <a href="{{ route('writer.articles.create') }}" class="btn btn-primary">+ Nuovo articolo</a>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table align-middle mb-0">
      <thead><tr>
        <th>Titolo</th><th>Categoria</th><th>Stato</th><th class="text-end">Azioni</th>
      </tr></thead>
      <tbody>
        @forelse($articles as $a)
          <tr>
            <td class="fw-semibold">{{ $a->title }}</td>
            <td class="text-muted">{{ $a->category->name ?? '-' }}</td>
            <td>
              @if($a->status==='in_revisione') <span class="badge text-bg-warning">In revisione</span>
              @elseif($a->status==='accettato') <span class="badge text-bg-success">Accettato</span>
              @else <span class="badge text-bg-danger">Rifiutato</span>
              @endif
            </td>
            <td class="text-end">
              <a href="{{ route('writer.articles.edit',$a) }}" class="btn btn-sm btn-outline-secondary">Modifica</a>
              <form action="{{ route('writer.articles.destroy',$a) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Eliminare l\\'articolo?');">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Elimina</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">Nessun articolo</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $articles->links() }}</div>
@endsection
