<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->paginate(20);
        return view('crm.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'img_path' => 'required|image|max:10000',
        ]);
    
        $path = $request->file('img_path')->store('posts', 'public');
    
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'excerpt' => $data['excerpt'] ?? null,
            'is_published' => $request->has('is_published'),
            'img_path' => Storage::url($path),
            'published_at' => $request->has('is_published') ? now() : null,
        ]);
    
        return redirect()->route('crm.posts.index')->with('success', 'Пост добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('crm.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'img_path' => 'nullable|image|max:10000',
        ]);

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->excerpt = $data['excerpt'] ?? null;
        $post->is_published = $request->has('is_published');
        
        // Если загружено новое изображение
        if ($request->hasFile('img_path')) {
            // Удаляем старое изображение
            if ($post->img_path) {
                $oldFilePath = str_replace('/storage/', '', $post->img_path);
                Storage::disk('public')->delete($oldFilePath);
            }
            
            // Сохраняем новое изображение
            $path = $request->file('img_path')->store('posts', 'public');
            $post->img_path = Storage::url($path);
        }
        
        // Устанавливаем дату публикации, если пост публикуется впервые
        if ($post->is_published && !$post->published_at) {
            $post->published_at = now();
        }
        
        $post->save();
        
        return redirect()->route('crm.posts.index')->with('success', 'Пост обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Удаляем файл изображения из хранилища
        if ($post->img_path) {
            // Преобразуем URL в относительный путь для удаления
            $filePath = str_replace('/storage/', '', $post->img_path);
            Storage::disk('public')->delete($filePath);
        }
        
        $post->delete();
    
        return redirect()->route('crm.posts.index')->with('success', 'Пост удален!');
    }
}
