<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Memorial;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryPhotoController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    /**
     * Upload a single gallery photo and return URLs immediately.
     * Generates thumbnail synchronously so thumb_url is ready in the response.
     *
     * POST /memorial/{memorial}/photos
     * Returns: { id, url, thumb_url }
     */
    public function store(Request $request, Memorial $memorial)
    {
        if (Auth::id() !== $memorial->admin_id) {
            abort(403);
        }

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $result = $this->imageService->processAndStoreWithThumb(
            $request->file('photo'),
            $memorial->slug,
            'gallery',
            1200,
            600
        );

        $maxOrder = $memorial->images()->max('order') ?? 0;

        $image = Image::create([
            'memorial_id' => $memorial->id,
            'image_path'  => $result['path'],
            'thumb_path'  => $result['thumb'],
            'order'       => $maxOrder + 1,
        ]);

        return response()->json([
            'id'       => $image->id,
            'url'      => asset('storage/' . $result['path']),
            'thumb_url' => asset('storage/' . $result['thumb']),
        ], 201);
    }

    /**
     * Delete a gallery photo immediately.
     *
     * DELETE /memorial/{memorial}/photos/{image}
     */
    public function destroy(Memorial $memorial, Image $image)
    {
        if (Auth::id() !== $memorial->admin_id) {
            abort(403);
        }

        // Ensure the image belongs to this memorial
        if ($image->memorial_id !== $memorial->id) {
            abort(404);
        }

        $this->imageService->deleteWithThumb($image->image_path, $image->thumb_path);
        $image->delete();

        return response()->json(['deleted' => true]);
    }
}
