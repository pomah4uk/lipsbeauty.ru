<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::orderByDesc('created_at')->paginate(20);
        return view('crm.photos.photos', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.photo_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'add_photo' => 'required|image|max:10000',
            'description' => 'nullable|string|max:1000',
        ]);

        $file = $request->file('add_photo');
        $path = $file->store('photos', 'public');

        $photo = Photo::create([
            'name_photo' => '/storage/' . $path,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'description' => $request->input('description'),
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('crm.photos.index')->with('success', 'Фото успешно добавлено!');
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
        return view('crm.photo_edit', compact('photo'));
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
