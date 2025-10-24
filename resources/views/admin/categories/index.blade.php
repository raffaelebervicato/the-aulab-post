@extends('layouts.app')
@section('title','Categorie')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Categorie</h1>
    <div>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">« Dashboard</a>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Nuova</a>
    </div>
  </div>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Slug</th>
            <th class="text-end">Azioni</th>
          </tr>
        </thead>
        <tbody>
        @forelse($categories as $c)
          <tr>
            <td class="fw-semibold">{{ $c->name }}</td>
            <td class="text-muted">{{ $c->slug }}</td>
            <td class="text-end">
              <a href="{{ route('admin.categories.edit',$c) }}" class="btn btn-sm btn-outline-secondary">Modifica</a>
              <form action="{{ route('admin.categories.destroy',$c) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Eliminare la categoria?');">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Elimina</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="text-center text-muted">Nessuna categoria</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3">
    {{ $categories->links() }}
  </div>
@endsection
