<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::get()
        ]);
    }

    public function create()
    {
        return view('article.form');
    }

    public function store(Request $request)
    {
        $inputs = $request->only('title', 'description');
        $created = Article::create($inputs);

        if ($created) {
            return redirect()->route('article.index');
        }
        else 
        {
            return back()->with('error', 'Failed to create article');
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('article.form', [
            'article' => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only('title', 'description');
        $article = Article::find($id);
        $updated = $article->update($inputs);

        if ($updated) {
            return redirect()->route('article.index');
        }
        else 
        {
            return back()->with('error', 'Failed to update article');
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $deleted = $article->delete();

        if ($deleted) {
            return redirect()->route('article.index');
        }
        else 
        {
            return back()->with('error', 'Failed to delete article');
        }
    }
}
