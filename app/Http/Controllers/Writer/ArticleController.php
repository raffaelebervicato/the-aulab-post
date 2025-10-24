<?php
namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', auth()->id())
            ->latest()->paginate(10);
        return view('writer.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('writer.articles.create', compact('categories','tags'));
    }

    public function store(ArticleRequest $r)
    {
        $data = $r->validated();
        $data['user_id'] = auth()->id();
        $data['status']  = 'in_revisione';

        if ($r->hasFile('cover_image')) {
            $data['cover_image'] = $r->file('cover_image')->store('covers','public');
        }

        $article = Article::create($data);
        if (!empty($data['tags'])) $article->tags()->sync($data['tags']);

        return redirect()->route('writer.articles.index')->with('success','Articolo inviato in revisione.');
    }

    public function edit(Article $article)
    {
        $this->authorizeOwner($article);
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('writer.articles.edit', compact('article','categories','tags'));
    }

    public function update(ArticleRequest $r, Article $article)
    {
        $this->authorizeOwner($article);
        $data = $r->validated();

        // ogni modifica rimette in revisione
        $data['status'] = 'in_revisione';

        if ($r->hasFile('cover_image')) {
            if ($article->cover_image) Storage::disk('public')->delete($article->cover_image);
            $data['cover_image'] = $r->file('cover_image')->store('covers','public');
        }

        $article->update($data);
        $article->tags()->sync($data['tags'] ?? []);

        return redirect()->route('writer.articles.index')->with('success','Articolo aggiornato e rimesso in revisione.');
    }

    public function destroy(Article $article)
    {
        $this->authorizeOwner($article);
        if ($article->cover_image) Storage::disk('public')->delete($article->cover_image);
        $article->tags()->detach();
        $article->delete();

        return back()->with('success','Articolo eliminato.');
    }

    private function authorizeOwner(Article $article)
    {
        abort_unless($article->user_id === auth()->id(), 403);
    }
}
