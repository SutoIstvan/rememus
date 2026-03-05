<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Family;
use App\Models\Image;
use App\Models\Timeline;
use App\Services\BiographyGeneratorService;
use App\Services\ImageService;

class MemorialController extends Controller
{
    public function __construct(private ImageService $imageService) {}

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

            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'background_url'   => 'nullable|string|max:500',

            'family_tree'          => 'nullable|array',
            'family_tree.*.id'     => 'required|string',
            'family_tree.*.name'   => 'required|string|max:255',
            'family_tree.*.role'   => 'required|string',
            'family_tree.*.avatar' => 'nullable|image|max:5120',
            'family_tree.*.qr_code'   => 'nullable|string',
            'family_tree.*.position'  => 'nullable|string',

            'gallery'   => 'nullable|array',
            'gallery.*' => 'image|max:5120',

            'timeline'                  => 'nullable|array',
            'timeline.*.id'             => 'required|string',
            'timeline.*.title'          => 'required|string|max:255',
            'timeline.*.description'    => 'nullable|string',
            'timeline.*.type'           => 'nullable|string|max:100',
            'timeline.*.location'       => 'nullable|string|max:255',
            'timeline.*.related_person' => 'nullable|string|max:255',
            'timeline.*.date'           => 'nullable|date',
            'timeline.*.date_from'      => 'nullable|date',
            'timeline.*.date_to'        => 'nullable|date|after_or_equal:timeline.*.date_from',
            'timeline.*.media'          => 'nullable|image|max:10240',
            'timeline.*.order'          => 'nullable|integer',

            'grave_parcel'  => 'nullable|string|max:255',
            'grave_line'    => 'nullable|string|max:255',
            'grave_number'  => 'nullable|string|max:255',
            'coordinates'   => 'nullable|string|max:255',
            'grave_photo'   => 'nullable|image|max:20480',

            'characteristics'   => 'nullable|array',
            'hobbies'           => 'nullable|array',
            'characteristics.*' => 'string|max:255',
            'hobbies.*'         => 'string|max:255',

            'custom_traits'       => 'nullable|string',
            'additional_hobbies'  => 'nullable|string',
            'retirement'          => 'nullable|string',
            'habits'              => 'nullable|string',
            'stories'             => 'nullable|string',
            'wisdom'              => 'nullable|string',

            'family_tree_enabled'     => 'nullable|boolean',
            'gallery_enabled'         => 'nullable|boolean',
            'timeline_enabled'        => 'nullable|boolean',
            'features_enabled'        => 'nullable|boolean',
            'burial_location_enabled' => 'nullable|boolean',
        ]);

        // We need the slug first — generate it so we can use it for folder names
        $slug = Memorial::generateUniqueSlugStatic($validated['name']);

        // Profile photo — full size only, no thumb
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->processAndStore(
                $request->file('image'), $slug, 'profile', 1200
            );
        }

        // Background — full size only, no thumb
        $backgroundImagePath = null;
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $this->imageService->processAndStore(
                $request->file('background_image'), $slug, 'background', 1920
            );
        } elseif (!empty($validated['background_url'])) {
            $backgroundImagePath = $validated['background_url'];
        }

        // Grave photo — full size only
        $gravePhotoPath = null;
        if ($request->hasFile('grave_photo')) {
            $gravePhotoPath = $this->imageService->processAndStore(
                $request->file('grave_photo'), $slug, 'grave', 1200
            );
        }

        $memorial = Memorial::create([
            'slug'        => $slug,
            'name'        => $validated['name'],
            'birth_date'  => $validated['birth_date'] ?? null,
            'death_date'  => $validated['death_date'] ?? null,
            'birth_place' => $validated['birth_place'] ?? null,
            'grave_location' => $validated['grave_location'] ?? null,

            'characteristics'    => $validated['characteristics'] ?? [],
            'custom_traits'      => $validated['custom_traits'] ?? null,
            'hobbies'            => $validated['hobbies'] ?? [],
            'additional_hobbies' => $validated['additional_hobbies'] ?? null,
            'retirement'         => $validated['retirement'] ?? null,
            'habits'             => $validated['habits'] ?? null,
            'stories'            => $validated['stories'] ?? null,
            'wisdom'             => $validated['wisdom'] ?? null,

            'grave_parcel'      => $validated['grave_parcel'] ?? null,
            'grave_line'        => $validated['grave_line'] ?? null,
            'grave_number'      => $validated['grave_number'] ?? null,
            'grave_coordinates' => $validated['coordinates'] ?? null,

            'family_tree_enabled'     => $validated['family_tree_enabled'] ?? true,
            'gallery_enabled'         => $validated['gallery_enabled'] ?? true,
            'timeline_enabled'        => $validated['timeline_enabled'] ?? true,
            'features_enabled'        => $validated['features_enabled'] ?? true,
            'burial_location_enabled' => $validated['burial_location_enabled'] ?? true,

            'qr_code'          => Str::uuid(),
            'admin_id'         => Auth::id(),
            'photo'            => $imagePath,
            'background_image' => $backgroundImagePath,
            'grave_photo'      => $gravePhotoPath,
        ]);

        // Family — full + thumb (400px full / 100px thumb)
        if (!empty($validated['family_tree'])) {
            foreach ($validated['family_tree'] as $index => $member) {
                $avatar = null;
                $avatarThumb = null;

                if ($request->hasFile("family_tree.$index.avatar")) {
                    $result = $this->imageService->processAndStoreWithThumb(
                        $request->file("family_tree.$index.avatar"),
                        $slug, 'family', 400, 100
                    );
                    $avatar = $result['path'];
                    $avatarThumb = $result['thumb'];
                }

                Family::create([
                    'memorial_id'  => $memorial->id,
                    'name'         => $member['name'],
                    'role'         => $member['role'],
                    'avatar'       => $avatar,
                    'avatar_thumb' => $avatarThumb,
                    'qr_code'      => $member['qr_code'] ?? null,
                    'position'     => isset($member['position'])
                        ? json_decode($member['position'], true)
                        : null,
                    'node_id' => $member['id'],
                ]);
            }
        }

        // Gallery — full (1200px) + thumb (400px)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $photo) {
                $result = $this->imageService->processAndStoreWithThumb(
                    $photo, $slug, 'gallery', 1200, 400
                );
                Image::create([
                    'memorial_id' => $memorial->id,
                    'image_path'  => $result['path'],
                    'thumb_path'  => $result['thumb'],
                    'order'       => $index,
                ]);
            }
        }

        // Timeline — full (1200px) + thumb (400px)
        if (!empty($validated['timeline'])) {
            foreach ($validated['timeline'] as $index => $event) {
                $media = null;
                $mediaThumb = null;

                if ($request->hasFile("timeline.$index.media")) {
                    $result = $this->imageService->processAndStoreWithThumb(
                        $request->file("timeline.$index.media"),
                        $slug, 'timeline', 1200, 400
                    );
                    $media = $result['path'];
                    $mediaThumb = $result['thumb'];
                }

                Timeline::create([
                    'memorial_id'    => $memorial->id,
                    'title'          => $event['title'],
                    'description'    => $event['description'] ?? null,
                    'type'           => $event['type'] ?? null,
                    'location'       => $event['location'] ?? null,
                    'related_person' => $event['related_person'] ?? null,
                    'media'          => $media,
                    'media_thumb'    => $mediaThumb,
                    'order'          => $event['order'] ?? $index,
                    'date'           => $event['date'] ?? null,
                    'date_from'      => $event['date_from'] ?? null,
                    'date_to'        => $event['date_to'] ?? null,
                ]);
            }
        }

        // Auto-generate biography via OpenAI
        try {
            $memorial->load(['family', 'timeline']);
            $generated = app(BiographyGeneratorService::class)->generate($memorial);
            $updateData = [];
            if (!empty($generated['biography'])) $updateData['biography'] = $generated['biography'];
            if (!empty($generated['motto']))     $updateData['motto']     = $generated['motto'];
            if (!empty($updateData)) $memorial->update($updateData);
        } catch (\Throwable $e) {
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

        $memorial->load(['comments' => function ($query) {
            $query->where('status', 'approved')->orderBy('created_at', 'desc');
        }]);

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

            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'background_url'   => 'nullable|string|max:500',
            'motto'            => 'nullable|string|max:255',
            'biography'        => 'nullable|string',

            'family_tree'          => 'nullable|array',
            'family_tree.*.id'     => 'required|string',
            'family_tree.*.name'   => 'required|string|max:255',
            'family_tree.*.role'   => 'required|string',
            'family_tree.*.avatar' => 'nullable|image|max:5120',
            'family_tree.*.qr_code'  => 'nullable|string',
            'family_tree.*.position' => 'nullable|string',

            'gallery'              => 'nullable|array',
            'gallery.*'            => 'image|max:5120',
            'deleted_gallery_ids'  => 'nullable|array',
            'deleted_gallery_ids.*' => 'integer',

            'timeline'                  => 'nullable|array',
            'timeline.*.id'             => 'required|string',
            'timeline.*.title'          => 'required|string|max:255',
            'timeline.*.description'    => 'nullable|string',
            'timeline.*.type'           => 'nullable|string|max:100',
            'timeline.*.location'       => 'nullable|string|max:255',
            'timeline.*.related_person' => 'nullable|string|max:255',
            'timeline.*.date'           => 'nullable|date',
            'timeline.*.date_from'      => 'nullable|date',
            'timeline.*.date_to'        => 'nullable|date|after_or_equal:timeline.*.date_from',
            'timeline.*.media'          => 'nullable|image|max:10240',
            'timeline.*.order'          => 'nullable|integer',

            'grave_parcel'  => 'nullable|string|max:255',
            'grave_line'    => 'nullable|string|max:255',
            'grave_number'  => 'nullable|string|max:255',
            'coordinates'   => 'nullable|string|max:255',
            'grave_photo'   => 'nullable|image|max:20480',

            'characteristics'   => 'nullable|array',
            'hobbies'           => 'nullable|array',
            'characteristics.*' => 'string|max:255',
            'hobbies.*'         => 'string|max:255',

            'custom_traits'      => 'nullable|string',
            'additional_hobbies' => 'nullable|string',
            'retirement'         => 'nullable|string',
            'habits'             => 'nullable|string',
            'stories'            => 'nullable|string',
            'wisdom'             => 'nullable|string',

            'family_tree_enabled'     => 'nullable|boolean',
            'gallery_enabled'         => 'nullable|boolean',
            'timeline_enabled'        => 'nullable|boolean',
            'features_enabled'        => 'nullable|boolean',
            'burial_location_enabled' => 'nullable|boolean',
        ]);

        $slug = $memorial->slug;

        $memorialData = [
            'name'               => $validated['name'],
            'birth_date'         => $validated['birth_date'] ?? null,
            'death_date'         => $validated['death_date'] ?? null,
            'birth_place'        => $validated['birth_place'] ?? null,
            'grave_location'     => $validated['grave_location'] ?? null,
            'motto'              => $validated['motto'] ?? null,
            'biography'          => $validated['biography'] ?? null,
            'characteristics'    => $validated['characteristics'] ?? [],
            'custom_traits'      => $validated['custom_traits'] ?? null,
            'hobbies'            => $validated['hobbies'] ?? [],
            'additional_hobbies' => $validated['additional_hobbies'] ?? null,
            'retirement'         => $validated['retirement'] ?? null,
            'habits'             => $validated['habits'] ?? null,
            'stories'            => $validated['stories'] ?? null,
            'wisdom'             => $validated['wisdom'] ?? null,
            'grave_parcel'       => $validated['grave_parcel'] ?? null,
            'grave_line'         => $validated['grave_line'] ?? null,
            'grave_number'       => $validated['grave_number'] ?? null,
            'grave_coordinates'  => $validated['coordinates'] ?? null,
            'family_tree_enabled'     => $validated['family_tree_enabled'] ?? true,
            'gallery_enabled'         => $validated['gallery_enabled'] ?? true,
            'timeline_enabled'        => $validated['timeline_enabled'] ?? true,
            'features_enabled'        => $validated['features_enabled'] ?? true,
            'burial_location_enabled' => $validated['burial_location_enabled'] ?? true,
        ];

        // Profile photo
        if ($request->hasFile('image')) {
            $this->imageService->deleteFile($memorial->photo);
            $memorialData['photo'] = $this->imageService->processAndStore(
                $request->file('image'), $slug, 'profile', 1200
            );
        }

        // Background
        if ($request->hasFile('background_image')) {
            $this->imageService->deleteFile(
                str_starts_with($memorial->background_image ?? '', 'http') ? null : $memorial->background_image
            );
            $memorialData['background_image'] = $this->imageService->processAndStore(
                $request->file('background_image'), $slug, 'background', 1920
            );
        } elseif (!empty($validated['background_url'])) {
            $bg = $validated['background_url'];
            // Принимаем только реальные URL или пути к предустановленным фонам (/images/...)
            // Не принимаем storage-пути (slug/background/xxx.webp) — они попадают сюда ошибочно
            if (str_starts_with($bg, 'http') || str_starts_with($bg, '/images/')) {
                $memorialData['background_image'] = $bg;
            }
        }

        // Grave photo
        if ($request->hasFile('grave_photo')) {
            $this->imageService->deleteFile($memorial->grave_photo);
            $memorialData['grave_photo'] = $this->imageService->processAndStore(
                $request->file('grave_photo'), $slug, 'grave', 1200
            );
        }

        $memorial->update($memorialData);

        // SYNC FAMILY
        $comingIds = [];

        if (!empty($validated['family_tree'])) {
            foreach ($validated['family_tree'] as $index => $member) {
                $familyMember = null;
                if (is_numeric($member['id'])) {
                    $familyMember = $memorial->family()->find($member['id']);
                } else {
                    $familyMember = $memorial->family()->where('node_id', $member['id'])->first();
                }

                if ($familyMember) {
                    $comingIds[] = $familyMember->id;
                    $updateData = [
                        'name'     => $member['name'],
                        'role'     => $member['role'],
                        'qr_code'  => $member['qr_code'] ?? null,
                        'position' => isset($member['position']) ? json_decode($member['position'], true) : null,
                    ];

                    if ($request->hasFile("family_tree.$index.avatar")) {
                        $this->imageService->deleteWithThumb(
                            $familyMember->avatar,
                            $familyMember->avatar_thumb
                        );
                        $result = $this->imageService->processAndStoreWithThumb(
                            $request->file("family_tree.$index.avatar"),
                            $slug, 'family', 400, 100
                        );
                        $updateData['avatar']       = $result['path'];
                        $updateData['avatar_thumb'] = $result['thumb'];
                    }

                    $familyMember->update($updateData);
                } else {
                    $avatar = null;
                    $avatarThumb = null;

                    if ($request->hasFile("family_tree.$index.avatar")) {
                        $result = $this->imageService->processAndStoreWithThumb(
                            $request->file("family_tree.$index.avatar"),
                            $slug, 'family', 400, 100
                        );
                        $avatar = $result['path'];
                        $avatarThumb = $result['thumb'];
                    }

                    $newMember = Family::create([
                        'memorial_id'  => $memorial->id,
                        'name'         => $member['name'],
                        'role'         => $member['role'],
                        'avatar'       => $avatar,
                        'avatar_thumb' => $avatarThumb,
                        'qr_code'      => $member['qr_code'] ?? null,
                        'position'     => isset($member['position']) ? json_decode($member['position'], true) : null,
                        'node_id'      => $member['id'],
                    ]);
                    $comingIds[] = $newMember->id;
                }
            }
        }

        if ($validated['family_tree_enabled'] ?? true) {
            // Delete files for removed family members before deleting DB records
            $memorial->family()->whereNotIn('id', $comingIds)->each(function ($member) {
                $this->imageService->deleteWithThumb($member->avatar, $member->avatar_thumb);
            });
            $memorial->family()->whereNotIn('id', $comingIds)->delete();
        }

        // SYNC TIMELINE
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
                        'title'          => $event['title'],
                        'description'    => $event['description'] ?? null,
                        'type'           => $event['type'] ?? null,
                        'location'       => $event['location'] ?? null,
                        'related_person' => $event['related_person'] ?? null,
                        'date'           => $event['date'] ?? null,
                        'date_from'      => $event['date_from'] ?? null,
                        'date_to'        => $event['date_to'] ?? null,
                        'order'          => $event['order'] ?? $index,
                    ];

                    if ($request->hasFile("timeline.$index.media")) {
                        $this->imageService->deleteWithThumb(
                            $timelineItem->media,
                            $timelineItem->media_thumb
                        );
                        $result = $this->imageService->processAndStoreWithThumb(
                            $request->file("timeline.$index.media"),
                            $slug, 'timeline', 1200, 400
                        );
                        $updateData['media']       = $result['path'];
                        $updateData['media_thumb'] = $result['thumb'];
                    }

                    $timelineItem->update($updateData);
                } else {
                    $media = null;
                    $mediaThumb = null;

                    if ($request->hasFile("timeline.$index.media")) {
                        $result = $this->imageService->processAndStoreWithThumb(
                            $request->file("timeline.$index.media"),
                            $slug, 'timeline', 1200, 400
                        );
                        $media = $result['path'];
                        $mediaThumb = $result['thumb'];
                    }

                    $newItem = Timeline::create([
                        'memorial_id'    => $memorial->id,
                        'title'          => $event['title'],
                        'description'    => $event['description'] ?? null,
                        'type'           => $event['type'] ?? null,
                        'location'       => $event['location'] ?? null,
                        'related_person' => $event['related_person'] ?? null,
                        'media'          => $media,
                        'media_thumb'    => $mediaThumb,
                        'order'          => $event['order'] ?? $index,
                        'date'           => $event['date'] ?? null,
                        'date_from'      => $event['date_from'] ?? null,
                        'date_to'        => $event['date_to'] ?? null,
                    ]);
                    $comingTimelineIds[] = $newItem->id;
                }
            }
        }

        if ($validated['timeline_enabled'] ?? true) {
            $memorial->timeline()->whereNotIn('id', $comingTimelineIds)->delete();
        }

        // SYNC GALLERY — delete removed
        if (!empty($validated['deleted_gallery_ids'])) {
            // Delete actual files before destroying DB records
            Image::whereIn('id', $validated['deleted_gallery_ids'])->each(function ($img) {
                $this->imageService->deleteWithThumb($img->image_path, $img->thumb_path);
            });
            Image::destroy($validated['deleted_gallery_ids']);
        }

        // Add new gallery images
        if ($request->hasFile('gallery')) {
            $maxOrder = $memorial->images()->max('order') ?? 0;
            foreach ($request->file('gallery') as $index => $photo) {
                $result = $this->imageService->processAndStoreWithThumb(
                    $photo, $slug, 'gallery', 1200, 400
                );
                Image::create([
                    'memorial_id' => $memorial->id,
                    'image_path'  => $result['path'],
                    'thumb_path'  => $result['thumb'],
                    'order'       => $maxOrder + 1 + $index,
                ]);
            }
        }

        // Auto-generate biography
        try {
            $memorial->load(['family', 'timeline']);
            $generated = app(BiographyGeneratorService::class)->generate($memorial);
            $updateData = [];
            if (!empty($generated['biography'])) $updateData['biography'] = $generated['biography'];
            if (!empty($generated['motto']))     $updateData['motto']     = $generated['motto'];
            if (!empty($updateData)) $memorial->update($updateData);
        } catch (\Throwable $e) {
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

        $memorial->delete();

        return redirect()->back()->with('success', 'Memorial deleted successfully');
    }
}
