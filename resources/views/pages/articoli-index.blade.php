@extends('layouts.app')
@section('title','Articoli')

@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <h1 class="mb-0">Tutti gli articoli</h1>

    {{-- Filtri UI (solo frontend per ora) --}}
    <form method="GET" action="{{ route('articoli.index') }}" class="d-flex gap-2">
      <input class="form-control" name="query" value="{{ request('query') }}" placeholder="Cerca titolo o testo…">
      <select class="form-select" name="category">
        <option value="">Tutte le categorie</option>
        {{-- placeholder categorie statiche per ora --}}
        @foreach(['Politica','Economia','Tech','Sport','Cultura','Attualità'] as $cat)
          <option value="{{ \Illuminate\Support\Str::slug($cat) }}" @selected(request('category')===\Illuminate\Support\Str::slug($cat))>{{ $cat }}</option>
        @endforeach
      </select>
      <button class="btn btn-primary">Filtra</button>
    </form>
  </div>

  @php
    // Placeholder: finta collezione per vedere la UI
    $articles = $articles ?? collect(range(1,8))->map(function($i){
      return (object)[
        'slug' => "articolo-$i",
        'title' => "Titolo dell’articolo #$i",
        'subtitle' => "Sottotitolo di esempio per l’articolo #$i con una breve anteprima del contenuto.",
        'image' => "https://picsum.photos/seed/aulab$i/800/450",
        'category' => ['Politica','Economia','Tech','Sport'][($i)%4],
        'category_slug' => ['politica','economia','tech','sport'][($i)%4],
        'author_name' => ['Sara','Lorenzo','Marta','Corrado'][($i)%4],
        'author_slug' => ['sara','lorenzo','marta','corrado'][($i)%4],
        'minutes_to_read' => rand(2,8),
        'published_at' => now()->subDays($i)->format('d/m/Y'),
      ];
    });
  @endphp

  @if($articles->isEmpty())
    <div class="text-center text-muted py-5">Nessun articolo trovato.</div>
  @else
    <div class="row g-3">
      @foreach($articles as $article)
        <div class="col-12 col-sm-6 col-lg-3">
          <x-article-card :article="$article" />
        </div>
      @endforeach
    </div>

    {{-- Paginazione placeholder --}}
    <nav class="mt-4" aria-label="Paginazione articoli">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled"><span class="page-link">«</span></li>
        <li class="page-item active"><span class="page-link">1</span></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">»</a></li>
      </ul>
    </nav>
  @endif
@endsection
