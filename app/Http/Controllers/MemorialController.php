<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Family;
use App\Models\Image;
use App\Models\Timeline;

class MemorialController extends Controller
{
    /**
     * Сохранить мемориал
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'birth_date'     => 'nullable|date',
            'death_date'     => 'nullable|date|after:birth_date',
            'grave_location' => 'nullable|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'background_url' => 'nullable|string|max:500', // 🔥 URL предустановленного фона

            'family_tree' => 'nullable|array',
            'family_tree.*.id' => 'required|string',
            'family_tree.*.name' => 'required|string|max:255',
            'family_tree.*.role' => 'required|string',
            'family_tree.*.avatar' => 'nullable|image|max:5120',
            'family_tree.*.qr_code' => 'nullable|string',
            'family_tree.*.position' => 'nullable|string',

            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5120',

            // 🔥 TIMELINE
            'timeline' => 'nullable|array',
            'timeline.*.id' => 'required|string',
            'timeline.*.title' => 'required|string|max:255',
            'timeline.*.description' => 'nullable|string',
            'timeline.*.type' => 'nullable|string|max:100',
            'timeline.*.location' => 'nullable|string|max:255',
            'timeline.*.related_person' => 'nullable|string|max:255',
            'timeline.*.date' => 'nullable|date',
            'timeline.*.date_from' => 'nullable|date',
            'timeline.*.date_to' => 'nullable|date|after_or_equal:timeline.*.date_from',
            'timeline.*.media' => 'nullable|image|max:10240',
            'timeline.*.order' => 'nullable|integer',

            // 🔥 BURIAL LOCATION
            'grave_parcel' => 'nullable|string|max:255',
            'grave_line' => 'nullable|string|max:255',
            'grave_number' => 'nullable|string|max:255',
            'coordinates' => 'nullable|string|max:255',
            'grave_photo' => 'nullable|image|max:20480',

            // 🔥 FEATURES / BIOGRAPHY
            'characteristics' => 'nullable|array',
            'hobbies' => 'nullable|array',
            'characteristics.*' => 'string|max:255',
            'hobbies.*' => 'string|max:255',

            'custom_traits' => 'nullable|string',
            'additional_hobbies' => 'nullable|string',
            'retirement' => 'nullable|string',
            'habits' => 'nullable|string',
            'stories' => 'nullable|string',
            'wisdom' => 'nullable|string',
        ]);

        // Основные изображения
        $imagePath = $request->file('image')?->store('memorials', 'public');

        // 🔥 Обработка фона: либо загруженный файл, либо URL предустановленного
        $backgroundImagePath = null;
        if ($request->hasFile('background_image')) {
            // Пользователь загрузил свой фон
            $backgroundImagePath = $request->file('background_image')
                ->store('memorials/backgrounds', 'public');
        } elseif (!empty($validated['background_url'])) {
            // Пользователь выбрал предустановленный фон
            $backgroundImagePath = $validated['background_url'];
        }

        // 🔥 Обработка фото могилы
        $gravePhotoPath = $request->file('grave_photo')?->store('memorials/grave', 'public');

        $memorial = Memorial::create([
            'name' => $validated['name'],
            'birth_date' => $validated['birth_date'] ?? null,
            'death_date' => $validated['death_date'] ?? null,
            'grave_location' => $validated['grave_location'] ?? null,

            // 🔥 FEATURES
            'characteristics' => $validated['characteristics'] ?? [],
            'custom_traits' => $validated['custom_traits'] ?? null,
            'hobbies' => $validated['hobbies'] ?? [],
            'additional_hobbies' => $validated['additional_hobbies'] ?? null,
            'retirement' => $validated['retirement'] ?? null,
            'habits' => $validated['habits'] ?? null,
            'stories' => $validated['stories'] ?? null,
            'wisdom' => $validated['wisdom'] ?? null,

            // 🔥 BURIAL LOCATION
            'grave_parcel' => $validated['grave_parcel'] ?? null,
            'grave_line' => $validated['grave_line'] ?? null,
            'grave_number' => $validated['grave_number'] ?? null,
            'grave_coordinates' => $validated['coordinates'] ?? null,

            'qr_code' => Str::uuid(),
            'admin_id' => Auth::id(),
            'photo' => $imagePath,
            'background_image' => $backgroundImagePath, // 🔥 Сохраняем либо путь к файлу, либо URL
        ]);

        // Семья
        if (!empty($validated['family_tree'])) {
            foreach ($validated['family_tree'] as $index => $member) {
                $avatar = $request->file("family_tree.$index.avatar")
                    ?->store('memorials/family_avatars', 'public');

                Family::create([
                    'memorial_id' => $memorial->id,
                    'name' => $member['name'],
                    'role' => $member['role'],
                    'avatar' => $avatar,
                    'qr_code' => $member['qr_code'] ?? null,
                    'position' => isset($member['position'])
                        ? json_decode($member['position'], true)
                        : null,
                    'node_id' => $member['id'],
                ]);
            }
        }

        // Галерея
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $photo) {
                Image::create([
                    'memorial_id' => $memorial->id,
                    'image_path' => $photo->store('memorials/gallery', 'public'),
                    'order' => $index,
                ]);
            }
        }

        // 🔥 TIMELINE
        if (!empty($validated['timeline'])) {
            foreach ($validated['timeline'] as $index => $event) {
                $media = $request->file("timeline.$index.media")
                    ?->store('memorials/timeline', 'public');

                Timeline::create([
                    'memorial_id' => $memorial->id,
                    'title' => $event['title'],
                    'description' => $event['description'] ?? null,
                    'type' => $event['type'] ?? null,
                    'location' => $event['location'] ?? null,
                    'related_person' => $event['related_person'] ?? null,
                    'media' => $media,
                    'order' => $event['order'] ?? $index,
                    'date' => $event['date'] ?? null,
                    'date_from' => $event['date_from'] ?? null,
                    'date_to' => $event['date_to'] ?? null,
                ]);
            }
        }

        return redirect()
            ->route('memorial.edit', $memorial)
            ->with('success', 'Memorial page created!');
    }
}
