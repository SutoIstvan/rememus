<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Family;

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
        'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        'family_tree' => 'nullable|array',
        'family_tree.*.id' => 'required|string',
        'family_tree.*.name' => 'required|string|max:255',
        'family_tree.*.role' => 'required|string|in:main_person,father,mother,grandfather_paternal,grandmother_paternal,grandfather_maternal,grandmother_maternal,spouse,sibling,child',
        'family_tree.*.avatar' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120',
        'family_tree.*.qr_code' => 'nullable|string',
        'family_tree.*.position' => 'nullable|string', // JSON строка
    ]);

    // Обработка основного изображения
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('memorials', 'public');
    }

    // Обработка фонового изображения
    $backgroundImagePath = null;
    if ($request->hasFile('background_image')) {
        $backgroundImagePath = $request->file('background_image')->store('memorials/backgrounds', 'public');
    }

    $qrCode = Str::uuid()->toString();

    // Создать запись в таблице memorials
    $memorial = Memorial::create([
        'name' => $validated['name'],
        'birth_date' => $validated['birth_date'] ?? null,
        'death_date' => $validated['death_date'] ?? null,
        'grave_location' => $validated['grave_location'] ?? null,
        'qr_code' => $qrCode,
        'admin_id' => Auth::id(),
        'photo' => $imagePath,
        'background_image' => $backgroundImagePath,
    ]);

    // Сохранение членов семьи
    if (!empty($validated['family_tree'])) {
        foreach ($validated['family_tree'] as $index => $familyMember) {
            // Пропускаем пустые записи
            if (empty($familyMember['name'])) {
                continue;
            }

            // Обработка аватара члена семьи
            $avatarPath = null;
            if ($request->hasFile("family_tree.{$index}.avatar")) {
                $avatarPath = $request->file("family_tree.{$index}.avatar")
                    ->store('memorials/family_avatars', 'public');
            }

            // Декодируем position из JSON строки обратно в массив для сохранения
            $position = null;
            if (!empty($familyMember['position'])) {
                $position = json_decode($familyMember['position'], true);
            }

            Family::create([
                'memorial_id' => $memorial->id,
                'name' => $familyMember['name'],
                'role' => $familyMember['role'],
                'avatar' => $avatarPath,
                'qr_code' => $familyMember['qr_code'] ?? null,
                'position' => $position, // Сохраняем как массив/JSON в БД
                'node_id' => $familyMember['id'],
            ]);
        }
    }

    return redirect()->route('memorial.edit')->with('success', 'Memorial page created!');
}
}
