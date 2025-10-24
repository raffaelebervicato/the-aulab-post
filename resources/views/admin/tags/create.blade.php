@extends('layouts.app')
@section('title','Nuovo tag')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Nuovo tag</h1>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">« Indietro</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.tags.store') }}">@csrf
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name') }}" placeholder="Es. Laravel" required>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Slug (opzionale)</label>
          <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                 value="{{ old('slug') }}" placeholder="laravel">
          @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
          <div class="form-text">Se vuoto, verrà generato automaticamente.</div>
        </div>

        <button class="btn btn-primary">Crea</button>
      </form>
    </div>
  </div>
@endsection
