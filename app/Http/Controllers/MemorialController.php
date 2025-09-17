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
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date|after:birth_date',
            'qr_code'    => 'nullable|string', // Правило валидации для qr_code
        ]);

        $qrCode = Str::uuid()->toString();

        // Добавить admin_id и qr_code
        $validated['qr_code'] = $qrCode;
        $validated['admin_id'] = Auth::id();
        // Создать запись в таблице memorials
        Memorial::create($validated);

        return redirect()->route('memorial.edit')->with('success', 'Memorial page created!');
    }
}
