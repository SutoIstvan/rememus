<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) { // Проверяем, авторизован ли пользователь
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin');
            } else {
                return view('dashboard.index');
            }
        }
    
        return view('dashboard.index'); 
    }
}
