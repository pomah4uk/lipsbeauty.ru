<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Список услуг для CRM
    public function index()
    {
        $services = Service::orderByDesc('created_at')->paginate(20);
        return view('crm.services.index', compact('services'));
    }

    // Форма создания услуги (CRM)
    public function create()
    {
        return view('crm.services.create');
    }

    // Сохранение услуги
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'image' => 'required|image|max:4096',
        ]);

        $path = $request->file('image')->store('services', 'public');

        $service = Service::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'] ?? null,
            'is_active' => $request->has('is_active'),
            'image' => '/storage/' . $path,
        ]);

        return redirect()->route('crm.services.index')->with('success', 'Услуга добавлена!');
    }

    // Форма редактирования услуги
    public function edit(Service $service)
    {
        return view('crm.services.edit', compact('service'));
    }

    // Обновление услуги
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($service->image) {
                $oldPath = str_replace('/storage/', '', $service->image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            
            $path = $request->file('image')->store('services', 'public');
            $service->image = '/storage/' . $path;
        }

        $service->title = $data['title'];
        $service->description = $data['description'];
        $service->price = $data['price'] ?? null;
        $service->is_active = $request->has('is_active');
        $service->save();

        return redirect()->route('crm.services.index')->with('success', 'Услуга обновлена!');
    }

    // Удаление услуги
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('crm.services.index')->with('success', 'Услуга удалена!');
    }
}
