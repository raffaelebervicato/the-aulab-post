@props(['article'])

<div class="card h-100 shadow-sm">
  @if($article->image ?? false)
    <img class="card-img-top" src="{{ $article->image }}" alt="{{ $article->title }}">
  @endif

  <div class="card-body">
    <a class="stretched-link text-decoration-none" href="{{ route('articoli.show', $article->slug) }}">
      <h5 class="card-title mb-1">{{ $article->title }}</h5>
    </a>
    @if(!empty($article->subtitle))
      <p class="card-text text-muted mb-2">{{ \Illuminate\Support\Str::limit($article->subtitle, 110) }}</p>
    @endif

    <div class="d-flex align-items-center gap-2 small text-muted">
      @if(!empty($article->category))
        <a class="badge text-bg-light text-decoration-none"
           href="{{ route('articoli.index') }}?category={{ $article->category_slug ?? $article->category }}">
          #{{ $article->category }}
        </a>
      @endif
      @if(!empty($article->minutes_to_read))
        <span class="badge text-bg-secondary">{{ $article->minutes_to_read }} min</span>
      @endif
    </div>
  </div>

  <div class="card-footer small text-muted d-flex justify-content-between">
    <span>
      @if(!empty($article->author_name))
        <a class="text-decoration-none" href="{{ route('articoli.index') }}?author={{ $article->author_slug ?? $article->author_name }}">
          {{ $article->author_name }}
        </a>
      @endif
    </span>
    @if(!empty($article->published_at))
      <time datetime="{{ $article->published_at }}">{{ $article->published_at }}</time>
    @endif
  </div>
</div>
