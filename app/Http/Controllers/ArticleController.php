<?php

namespace App\Http\Controllers;

use App\Models\ArticleModal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = ArticleModal::orderByDesc('created_at')->paginate(20);
        return view('crm.articles', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.article_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $article = new ArticleModal();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->published_at = $request->published_at;
        $article->save();

        return redirect()->route('crm.articles.index')
            ->with('success', 'Статья успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleModal $article)
    {
        return view('crm.article_show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleModal $article)
    {
        return view('crm.article_edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleModal $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $article->published_at = $request->published_at;
        $article->save();

        return redirect()->route('crm.articles.index')
            ->with('success', 'Статья успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleModal $article)
    {
        $article->delete();

        return redirect()->route('crm.articles.index')
            ->with('success', 'Статья успешно удалена');
    }
}
