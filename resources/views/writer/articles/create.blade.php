@extends('layouts.app')
@section('title','Nuovo articolo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="mb-0">Nuovo articolo</h1>
  <a href="{{ route('writer.articles.index') }}" class="btn btn-outline-secondary">« Indietro</a>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="POST" action="{{ route('writer.articles.store') }}" enctype="multipart/form-data">@csrf

      <div class="mb-3">
        <label class="form-label">Titolo</label>
        <input name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title') }}" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Sottotitolo</label>
        <input name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
               value="{{ old('subtitle') }}">
        @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Categoria</label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
          <option value="">— Seleziona —</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Tag</label>
        <select name="tags[]" class="form-select" multiple>
          @foreach($tags as $t)
            <option value="{{ $t->id }}" @selected(collect(old('tags',[]))->contains($t->id))>{{ $t->name }}</option>
          @endforeach
        </select>
        <div class="form-text">Tieni premuto CTRL/CMD per selezioni multiple.</div>
      </div>

      <div class="mb-3">
        <label class="form-label">Corpo</label>
        <textarea name="body" rows="8" class="form-control @error('body') is-invalid @enderror" required>{{ old('body') }}</textarea>
        @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Immagine di copertina</label>
        <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
        @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 text-center">
        <img id="coverPreview"
             src="{{ isset($article) && $article->cover_image ? asset('storage/'.$article->cover_image) : 'https://via.placeholder.com/600x340?text=Anteprima+immagine' }}"
             class="img-fluid rounded shadow-sm"
             style="max-height: 200px; object-fit: cover;"
             alt="Anteprima immagine">
      </div>


      <button class="btn btn-primary">Invia in revisione</button>
    </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
      const input = document.querySelector('input[name="cover_image"]');
      const preview = document.getElementById('coverPreview');
      if (!input || !preview) return;

      input.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => preview.src = ev.target.result;
        reader.readAsDataURL(file);
      });
    });
    </script>

@endsection
