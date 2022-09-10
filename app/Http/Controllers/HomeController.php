<?php

namespace App\Http\Controllers;

use App\Models\Entities\Note;
use App\Models\Entities\NoteFolder;
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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return view('welcome');
        }

        $user = Auth::user();

        $notes = Note::query()->where('user_id', $user->id)->get();
        $folders = NoteFolder::query()->where('user_id', $user->id)->get();

        return view('home', compact('folders', 'notes'));
    }
}
