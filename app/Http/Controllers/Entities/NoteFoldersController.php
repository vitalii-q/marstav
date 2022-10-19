<?php

namespace App\Http\Controllers\Entities;

use App\Helpers\Converter;
use App\Helpers\Regular;
use App\Http\Controllers\Controller;
use App\Models\Entities\Note;
use App\Models\Entities\NoteFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteFoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $folders = NoteFolder::query()->where('user_id', $user->id)->get();
        $notes = Note::query()->where('user_id', $user->id)->where('folder_id', null)->get();

        return view('entities.note_folders.note_folders', compact('folders', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entities.note_folders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255'
        ]);

        NoteFolder::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols($request->title))))
                .'_'.bin2hex(random_bytes(4)),
        ]);

        session()->flash('info', 'Папка добавлена');
        return redirect()->route('note_folders.notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($folder_code)
    {
        $user = Auth::user();
        $note_folder = NoteFolder::query()->where('user_id', $user->id)->where('code', $folder_code)->first();

        if (!$note_folder) {
            return view('errors.oops');
        }

        return view('entities.note_folders.edit', compact('note_folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $folder_code)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255'
        ]);

        $user = Auth::user();
        $note_folder = NoteFolder::query()->where('user_id', $user->id)->where('code', $folder_code)->first();
        $note_folder->update([
            'title' => $request->title,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols($request->title))))
                .'_'.bin2hex(random_bytes(4)),
        ]);

        session()->flash('info', 'Папка обновлена');
        return redirect()->route('note_folders.notes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($folder_code)
    {
        $user = Auth::user();
        $folder = NoteFolder::query()->where('user_id', $user->id)->where('code', $folder_code)->first();

        $notes = Note::query()->where('user_id', $user->id)->where('folder_id', $folder->id)->get();
        foreach ($notes as $note) {
            $note->delete();
        }

        $folder->delete();
    }
}
