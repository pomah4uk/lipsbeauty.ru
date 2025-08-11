<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::orderByDesc('created_at')->paginate(20);
        $totalPhotos = Photo::count();
        $photosLastWeek = Photo::where('created_at', '>=', now()->subDays(7))->count();
        return view('crm.photos.index', compact('photos', 'totalPhotos', 'photosLastWeek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.photos.photo_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'add_photo' => 'required|image|max:10000', // 10 MB
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            Log::info('PhotoController@store called');
            $file = $request->file('add_photo');
            if (!$file) {
                Log::warning('Photo upload: no file in request');
                return back()->with('error', 'Файл не был загружен.')->withInput();
            }

            $path = $file->store('photos', 'public');
            if (!$path) {
                Log::error('Photo upload: store() returned empty path');
                return back()->with('error', 'Не удалось сохранить файл. Проверьте права на запись в storage.')->withInput();
            }

            $photo = Photo::create([
                // без ведущего слеша, чтобы корректно работать через asset() в подпапках
                'name_photo' => 'storage/' . $path,
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'description' => $request->input('description'),
                'uploaded_by' => Auth::id(),
            ]);
            Log::info('Photo uploaded', [
                'id' => $photo->id,
                'path' => $path,
                'original_name' => $photo->original_name,
            ]);
            return redirect()->route('crm.photos.index')->with('success', 'Фото успешно добавлено!');
        } catch (\Throwable $e) {
            Log::error('Photo upload failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Ошибка при загрузке файла: ' . $e->getMessage())->withInput();
        }
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
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('crm.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $request->validate([
            'description' => 'nullable|string|max:1000',
        ]);
        $photo->description = $request->input('description');
        $photo->save();
        return redirect()->route('crm.photos.index')->with('success', 'Фото обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        if ($photo->path && Storage::disk('public')->exists($photo->path)) {
            Storage::disk('public')->delete($photo->path);
        }
        $photo->delete();
        return redirect()->route('crm.photos.index')->with('success', 'Фото удалено!');
    }
}
