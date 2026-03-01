<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Memorial;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new comment (pending moderation).
     */
    public function store(Request $request, Memorial $memorial)
    {
        // Check if comments are enabled for this memorial
        if (!($memorial->comments_enabled ?? true)) {
            return response()->json(['message' => 'Comments are disabled for this memorial.'], 403);
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('memorials/comments', 'public');
        }

        Comment::create([
            'memorial_id' => $memorial->id,
            'name'        => $validated['name'],
            'content'     => $validated['content'],
            'photo'       => $photoPath,
            'status'      => 'pending',
        ]);

        return response()->json([
            'message' => 'Комментарий отправлен на модерацию. Он появится после проверки.',
        ], 201);
    }
}
