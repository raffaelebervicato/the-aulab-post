<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('admin.categories.index')
            ->with('success','Categoria creata.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('admin.categories.index')
            ->with('success','Categoria aggiornata.');
    }

    public function destroy(Category $category)
    {
        // opzionale: impedisci delete se ci sono articoli collegati
        // if ($category->articles()->exists()) { return back()->with('error','Categoria in uso.'); }
        $category->delete();
        return back()->with('success','Categoria eliminata.');
    }
}
