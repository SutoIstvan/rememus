<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Memorial;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    /**
     * Approve a comment (admin only).
     */
    public function approve(Memorial $memorial, Comment $comment)
    {
        if (\Illuminate\Support\Facades\Auth::id() !== $memorial->admin_id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $comment->update(['status' => 'approved']);

        return response()->json(['message' => 'Comment approved.', 'comment' => $comment]);
    }

    /**
     * Delete a comment and its associated files (admin only).
     */
    public function adminDestroy(Memorial $memorial, Comment $comment)
    {
        if (\Illuminate\Support\Facades\Auth::id() !== $memorial->admin_id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        if ($comment->photo) {
            \Illuminate\Support\Facades\Storage::delete($comment->photo);
        }
        if ($comment->photo_thumb) {
            \Illuminate\Support\Facades\Storage::delete($comment->photo_thumb);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted.']);
    }

    /**
     * Store a new comment (pending moderation).
     */
    public function store(Request $request, Memorial $memorial)
    {
        if (!($memorial->comments_enabled ?? true)) {
            return response()->json(['message' => 'Comments are disabled for this memorial.'], 403);
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $photoPath = null;
        $photoThumb = null;

        if ($request->hasFile('photo')) {
            // Full (1000px) + thumb (300px), both scaleDown
            $result = $this->imageService->processAndStoreWithThumb(
                $request->file('photo'),
                $memorial->slug,
                'comments',
                1200,
                300
            );
            $photoPath  = $result['path'];
            $photoThumb = $result['thumb'];
        }

        Comment::create([
            'memorial_id' => $memorial->id,
            'name'        => $validated['name'],
            'content'     => $validated['content'],
            'photo'       => $photoPath,
            'photo_thumb' => $photoThumb,
            'status'      => 'pending',
        ]);

        return response()->json([
            'message' => 'Комментарий отправлен на модерацию. Он появится после проверки.',
        ], 201);
    }
}
