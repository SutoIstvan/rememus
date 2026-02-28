<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Family;
use App\Models\Image;
use App\Models\Timeline;
use App\Services\BiographyGeneratorService;

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
            'birth_place'    => 'nullable|string|max:255',
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

            // Section toggles
            'family_tree_enabled' => 'nullable|boolean',
            'gallery_enabled' => 'nullable|boolean',
            'timeline_enabled' => 'nullable|boolean',
            'features_enabled' => 'nullable|boolean',
            'burial_location_enabled' => 'nullable|boolean',
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
            'birth_place' => $validated['birth_place'] ?? null,
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

            // Section toggles
            'family_tree_enabled' => $validated['family_tree_enabled'] ?? true,
            'gallery_enabled' => $validated['gallery_enabled'] ?? true,
            'timeline_enabled' => $validated['timeline_enabled'] ?? true,
            'features_enabled' => $validated['features_enabled'] ?? true,
            'burial_location_enabled' => $validated['burial_location_enabled'] ?? true,

            'qr_code' => Str::uuid(),
            'admin_id' => Auth::id(),
            'photo' => $imagePath,
            'background_image' => $backgroundImagePath, // 🔥 Сохраняем либо путь к файлу, либо URL
            'grave_photo' => $gravePhotoPath,
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
                if ($request->hasFile("timeline.$index.media")) {
                    $path = $request->file("timeline.$index.media")->store('memorials/timeline', 'public');
                    $media = Storage::url($path);
                } else {
                    $media = null;
                }

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

        // ── Автогенерация биографии и девиза через OpenAI ────────────
        try {
            $memorial->load(['family', 'timeline']);
            $generated = app(BiographyGeneratorService::class)->generate($memorial);
            $updateData = [];
            if (!empty($generated['biography'])) {
                $updateData['biography'] = $generated['biography'];
            }
            if (!empty($generated['motto'])) {
                $updateData['motto'] = $generated['motto'];
            }
            if (!empty($updateData)) {
                $memorial->update($updateData);
            }
        } catch (\Throwable $e) {
            // Не прерываем сохранение при ошибке генерации
            \Log::warning('Biography generation failed on store: ' . $e->getMessage());
        }

        return redirect()
            ->route('memorial.edit', $memorial)
            ->with('success', 'Memorial page created!');
    }

    /**
     * Show the public memorial view page.
     */
    public function show(Memorial $memorial)
    {
        $memorial->load(['family', 'images', 'timeline']);

        return \Inertia\Inertia::render('View', [
            'memorial' => $memorial
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Memorial $memorial)
    {
        if (Auth::id() !== $memorial->admin_id) {
            abort(403);
        }

        $memorial->load(['family', 'images', 'timeline']);

        return \Inertia\Inertia::render('MemorialEdit', [
            'memorial' => $memorial
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Memorial $memorial)
    {
        if (Auth::id() !== $memorial->admin_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'birth_date'     => 'nullable|date',
            'death_date'     => 'nullable|date|after:birth_date',
            'birth_place'    => 'nullable|string|max:255',
            'grave_location' => 'nullable|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'background_url' => 'nullable|string|max:500',
            'motto' => 'nullable|string|max:255',
            'biography' => 'nullable|string',

            'family_tree' => 'nullable|array',
            'family_tree.*.id' => 'required|string', // Can be UUID or node_id string
            'family_tree.*.name' => 'required|string|max:255',
            'family_tree.*.role' => 'required|string',
            'family_tree.*.avatar' => 'nullable|image|max:5120',
            'family_tree.*.qr_code' => 'nullable|string',
            'family_tree.*.position' => 'nullable|string',

            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5120',
            'deleted_gallery_ids' => 'nullable|array',
            'deleted_gallery_ids.*' => 'integer',

            // TIMELINE
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

            // BURIAL LOCATION
            'grave_parcel' => 'nullable|string|max:255',
            'grave_line' => 'nullable|string|max:255',
            'grave_number' => 'nullable|string|max:255',
            'coordinates' => 'nullable|string|max:255',
            'grave_photo' => 'nullable|image|max:20480',

            // FEATURES / BIOGRAPHY
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

            // Section toggles
            'family_tree_enabled' => 'nullable|boolean',
            'gallery_enabled' => 'nullable|boolean',
            'timeline_enabled' => 'nullable|boolean',
            'features_enabled' => 'nullable|boolean',
            'burial_location_enabled' => 'nullable|boolean',
        ]);

        // Main Memorial Update
        $memorialData = [
            'name' => $validated['name'],
            'birth_date' => $validated['birth_date'] ?? null,
            'death_date' => $validated['death_date'] ?? null,
            'birth_place' => $validated['birth_place'] ?? null,
            'birth_place' => $validated['birth_place'] ?? null,
            'grave_location' => $validated['grave_location'] ?? null,
            'motto' => $validated['motto'] ?? null,
            'biography' => $validated['biography'] ?? null,
            'characteristics' => $validated['characteristics'] ?? [],
            'custom_traits' => $validated['custom_traits'] ?? null,
            'hobbies' => $validated['hobbies'] ?? [],
            'additional_hobbies' => $validated['additional_hobbies'] ?? null,
            'retirement' => $validated['retirement'] ?? null,
            'habits' => $validated['habits'] ?? null,
            'stories' => $validated['stories'] ?? null,
            'wisdom' => $validated['wisdom'] ?? null,
            'grave_parcel' => $validated['grave_parcel'] ?? null,
            'grave_line' => $validated['grave_line'] ?? null,
            'grave_number' => $validated['grave_number'] ?? null,
            'grave_coordinates' => $validated['coordinates'] ?? null,
            'family_tree_enabled' => $validated['family_tree_enabled'] ?? true,
            'gallery_enabled' => $validated['gallery_enabled'] ?? true,
            'timeline_enabled' => $validated['timeline_enabled'] ?? true,
            'features_enabled' => $validated['features_enabled'] ?? true,
            'burial_location_enabled' => $validated['burial_location_enabled'] ?? true,
            // 'background_image' is handled below
        ];

        // Handle Images
        if ($request->hasFile('image')) {
            $memorialData['photo'] = $request->file('image')->store('memorials', 'public');
        }

        if ($request->hasFile('background_image')) {
            $memorialData['background_image'] = $request->file('background_image')->store('memorials/backgrounds', 'public');
        } elseif (!empty($validated['background_url'])) {
            $memorialData['background_image'] = $validated['background_url'];
        }

        if ($request->hasFile('grave_photo')) {
            $memorialData['grave_photo'] = $request->file('grave_photo')->store('memorials/grave', 'public');
        }

        $memorial->update($memorialData);

        // SYNC FAMILY
        $existingFamilyIds = $memorial->family()->pluck('id')->toArray();
        $comingIds = [];

        if (!empty($validated['family_tree'])) {
            foreach ($validated['family_tree'] as $index => $member) {
                // Try to find by ID (if it's a UUID/Integer from DB) OR by node_id
                // Since Create uses String UUID for node_id, and DB ID is auto-inc...
                // MemorialEdit passes existing IDs (integers). New items are strings.

                $familyMember = null;
                if (is_numeric($member['id'])) {
                    $familyMember = $memorial->family()->find($member['id']);
                } else {
                    // Check by node_id just in case, but usually we rely on DB ID for updates
                    $familyMember = $memorial->family()->where('node_id', $member['id'])->first();
                }

                if ($familyMember) {
                    $comingIds[] = $familyMember->id;
                    $updateData = [
                        'name' => $member['name'],
                        'role' => $member['role'],
                        'qr_code' => $member['qr_code'] ?? null,
                        'position' => isset($member['position']) ? json_decode($member['position'], true) : null,
                    ];

                    if ($request->hasFile("family_tree.$index.avatar")) {
                        $updateData['avatar'] = $request->file("family_tree.$index.avatar")->store('memorials/family_avatars', 'public');
                    }

                    $familyMember->update($updateData);
                } else {
                    // Create new
                    $avatar = $request->file("family_tree.$index.avatar")
                        ?->store('memorials/family_avatars', 'public');

                    $newMember = Family::create([
                        'memorial_id' => $memorial->id,
                        'name' => $member['name'],
                        'role' => $member['role'],
                        'avatar' => $avatar,
                        'qr_code' => $member['qr_code'] ?? null,
                        'position' => isset($member['position']) ? json_decode($member['position'], true) : null,
                        'node_id' => $member['id'], // Use the frontend ID as node_id
                    ]);
                    $comingIds[] = $newMember->id;
                }
            }
        }

        if ($validated['family_tree_enabled'] ?? true) {
            $memorial->family()->whereNotIn('id', $comingIds)->delete();
        }

        // SYNC TIMELINE
        $existingTimelineIds = $memorial->timeline()->pluck('id')->toArray();
        $comingTimelineIds = [];

        if (!empty($validated['timeline'])) {
            foreach ($validated['timeline'] as $index => $event) {
                $timelineItem = null;
                if (is_numeric($event['id'])) {
                    $timelineItem = $memorial->timeline()->find($event['id']);
                }

                if ($timelineItem) {
                    $comingTimelineIds[] = $timelineItem->id;
                    $updateData = [
                        'title' => $event['title'],
                        'description' => $event['description'] ?? null,
                        'type' => $event['type'] ?? null,
                        'location' => $event['location'] ?? null,
                        'related_person' => $event['related_person'] ?? null,
                        'date' => $event['date'] ?? null,
                        'date_from' => $event['date_from'] ?? null,
                        'date_to' => $event['date_to'] ?? null,
                        'order' => $event['order'] ?? $index,
                    ];

                    if ($request->hasFile("timeline.$index.media")) {
                        $path = $request->file("timeline.$index.media")->store('memorials/timeline', 'public');
                        $updateData['media'] = Storage::url($path);
                    }

                    $timelineItem->update($updateData);
                } else {
                    if ($request->hasFile("timeline.$index.media")) {
                        $path = $request->file("timeline.$index.media")->store('memorials/timeline', 'public');
                        $media = Storage::url($path);
                    } else {
                        $media = null;
                    }

                    $newItem = Timeline::create([
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
                    $comingTimelineIds[] = $newItem->id;
                }
            }
        }

        if ($validated['timeline_enabled'] ?? true) {
            $memorial->timeline()->whereNotIn('id', $comingTimelineIds)->delete();
        }

        // SYNC GALLERY
        if (!empty($validated['deleted_gallery_ids'])) {
            // In real app, delete files from storage too
            Image::destroy($validated['deleted_gallery_ids']);
        }

        if ($request->hasFile('gallery')) {
            $maxOrder = $memorial->images()->max('order') ?? 0;
            foreach ($request->file('gallery') as $index => $photo) {
                Image::create([
                    'memorial_id' => $memorial->id,
                    'image_path' => $photo->store('memorials/gallery', 'public'),
                    'order' => $maxOrder + 1 + $index,
                ]);
            }
        }

        // ── Автогенерация биографии и девиза через OpenAI ────────────
        try {
            $memorial->load(['family', 'timeline']);
            $generated = app(BiographyGeneratorService::class)->generate($memorial);
            $updateData = [];
            if (!empty($generated['biography'])) {
                $updateData['biography'] = $generated['biography'];
            }
            if (!empty($generated['motto'])) {
                $updateData['motto'] = $generated['motto'];
            }
            if (!empty($updateData)) {
                $memorial->update($updateData);
            }
        } catch (\Throwable $e) {
            // Не прерываем обновление при ошибке генерации
            \Log::warning('Biography generation failed on update: ' . $e->getMessage());
        }

        return redirect()
            ->route('memorial.edit', $memorial)
            ->with('success', 'Memorial updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memorial $memorial)
    {
        if (Auth::id() !== $memorial->admin_id) {
            abort(403);
        }

        $memorial->delete(); // Soft delete as per model use SoftDeletes

        return redirect()->back()->with('success', 'Memorial deleted successfully');
    }
}
