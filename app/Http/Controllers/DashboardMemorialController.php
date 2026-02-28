<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Memorial;

class DashboardMemorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memorials = Memorial::where('admin_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Dashboard', [
            'memorials' => $memorials
        ]);
    }
}
