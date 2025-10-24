<?php
namespace App\Http\Controllers\Revisor;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ReviewController extends Controller
{
    public function index()
    {
        $queue = Article::with('user','category')
            ->inRevisione()->latest()->paginate(10);

        return view('revisor.queue', compact('queue'));
    }

    public function accept(Article $article)
    {
        $article->update(['status'=>'accettato']);
        return back()->with('success','Articolo accettato.');
    }

    public function reject(Article $article)
    {
        $article->update(['status'=>'rifiutato']);
        return back()->with('success','Articolo rifiutato.');
    }
}
