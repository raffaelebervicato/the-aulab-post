@extends('layouts.app')
@section('title', isset($slug) ? "Articolo: $slug" : 'Articolo')

@section('content')
  @php
    // Placeholder articolo singolo per UI
    $article = (object)[
      'title' => 'Titolo dell’articolo di esempio',
      'subtitle' => 'Sottotitolo chiaro e coinvolgente per incuriosire il lettore.',
      'image' => 'https://picsum.photos/seed/aulab-hero/1200/600',
      'category' => 'Tech',
      'category_slug' => 'tech',
      'author_name' => 'Sara',
      'author_slug' => 'sara',
      'minutes_to_read' => 5,
      'published_at' => now()->subDays(2)->format('d/m/Y'),
      'body' => '<p>Contenuto di esempio: corpo dell’articolo con <strong>testo formattato</strong>, paragrafi e magari una lista.</p><ul><li>Punto A</li><li>Punto B</li></ul><p>Altro paragrafo conclusivo.</p>',
      'tags' => ['laravel','bootstrap','vite'],
    ];
  @endphp

  {{-- HERO --}}
  <div class="mb-4">
    <h1 class="mb-2">{{ $article->title }}</h1>
    @if(!empty($article->subtitle))
      <p class="lead text-muted">{{ $article->subtitle }}</p>
    @endif
    <div class="d-flex flex-wrap gap-2 small text-muted">
      <span>Pubblicato il {{ $article->published_at }}</span>
      <span>·</span>
      <a class="text-decoration-none" href="{{ route('articoli.index') }}?author={{ $article->author_slug }}">{{ $article->author_name }}</a>
      <span>·</span>
      <a class="text-decoration-none" href="{{ route('articoli.index') }}?category={{ $article->category_slug }}">#{{ $article->category }}</a>
      <span class="badge text-bg-secondary ms-2">{{ $article->minutes_to_read }} min</span>
    </div>
  </div>

  @if(!empty($article->image))
    <img class="img-fluid rounded mb-4" src="{{ $article->image }}" alt="{{ $article->title }}">
  @endif

  {{-- BODY --}}
  <article class="mb-4 prose">
    {!! $article->body !!}
  </article>

  {{-- TAGS --}}
  @if(!empty($article->tags))
    <div class="d-flex flex-wrap gap-2 mt-3">
      @foreach($article->tags as $tag)
        <a href="{{ route('articoli.index') }}?tag={{ $tag }}" class="badge rounded-pill text-bg-light text-decoration-none">#{{ $tag }}</a>
      @endforeach
    </div>
  @endif

  {{-- Navigazione successivo/precedente (placeholder) --}}
  <hr class="my-4">
  <div class="d-flex justify-content-between">
    <a href="#" class="btn btn-outline-secondary disabled" aria-disabled="true">« Precedente</a>
    <a href="#" class="btn btn-outline-secondary">Successivo »</a>
  </div>
@endsection
