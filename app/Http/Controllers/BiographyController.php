<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Services\BiographyGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class BiographyController extends Controller
{
    public function generate(Memorial $memorial, BiographyGeneratorService $service): JsonResponse
    {
        if (Auth::id() !== $memorial->admin_id) {
            abort(403);
        }

        // Load relationships needed for generation
        $memorial->load(['family', 'timeline']);

        try {
            $result = $service->generate($memorial);

            // Persist generated values
            $memorial->update([
                'biography' => $result['biography'] ?: $memorial->biography,
                'motto'     => $result['motto']     ?: $memorial->motto,
            ]);

            return response()->json([
                'biography' => $result['biography'],
                'motto'     => $result['motto'],
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'error' => 'Failed to generate biography: ' . $e->getMessage(),
            ], 500);
        }
    }
}
