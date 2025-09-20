<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MemorialController extends Controller
{
    /**
     * Сохранить мемориал
     */
    public function store(Request $request)
    {
        // Валидация входных данных
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'birth_date'     => 'nullable|date',
            'death_date'     => 'nullable|date|after:birth_date',
            'grave_location' => 'nullable|string|max:255',
            'qr_code'        => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB для фона
        ]);

        // Обработка основного изображения
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('memorials', 'public');
        }

        // Обработка фонового изображения - ИСПРАВЛЕНО: объявляем переменную заранее
        $backgroundImagePath = null;
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->file('background_image')->store('memorials/backgrounds', 'public');
        }

        $qrCode = Str::uuid()->toString();

        // Добавить admin_id и qr_code
        $validated['qr_code'] = $qrCode;
        $validated['admin_id'] = Auth::id();
        $validated['photo'] = $imagePath;
        $validated['background_image'] = $backgroundImagePath; // Теперь переменная определена

        // Убираем 'image' из validated, так как его не должно быть в БД
        unset($validated['image']);

        // Создать запись в таблице memorials
        $memorial = Memorial::create($validated);

        return redirect()->route('memorial.edit')->with('success', 'Memorial page created!');
    }
}
