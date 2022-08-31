<?php

namespace App\Http\Controllers\Entities;

use App\Helpers\Converter;
use App\Helpers\Regular;
use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\NoteFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $user_id = Auth::user()->id;
        $folder = DB::table('note_folders')->where('user_id', $user_id)->where('code', $code)->first();
        if(!$folder and $code !== 'root') {
            return view('oops');
        } elseif (!$folder and $code == 'root') {
            return redirect()->route('note_folders.notes.index');
        } else {
            $notes = DB::table('notes')->where('user_id', $user_id)->where('folder_id', $folder->id)->get();
        }

        return view('entities.notes.notes', compact('folder', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($folder_code)
    {
        $user_id = Auth::user()->id;

        $folder = DB::table('note_folders')->where('user_id', $user_id)->where('code', $folder_code)->first();

        return view('entities.notes.create', compact('folder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $folder_code)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $user = Auth::user();
        $folder = DB::table('note_folders')->where('user_id', $user->id)->where('code', $folder_code)->first();

        DB::table('notes')->insert([
            'user_id' => $user->id,
            'folder_id' => $folder ? $folder->id : null,
            'title' => $request->title,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols($request->title))))
                .'_'.bin2hex(random_bytes(4)),
            'text' => $request->text,
        ]);

        session()->flash('info', 'Заметка добавлена');
        return redirect()->route('note_folders.notes.index');
    }

    public function ajaxStore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $user = Auth::user();
        $folder = DB::table('note_folders')->where('user_id', $user->id)->where('code', $request->folder_code)->first();

        $new_note_id = Note::query()->insertGetId([
            'user_id' => $user->id,
            'folder_id' => $folder ? $folder->id : null,
            'title' => $request->title,
            'code' => $code = str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols($request->title))))
                .'_'.bin2hex(random_bytes(4)),
            'workspace' => 1
        ]);

        $new_note = Note::query()->find($new_note_id);

        return $new_note;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($note_code)
    {
        //
    }

    public function ajaxShow(Request $request)
    {
        $user = Auth::user();
        $note = Note::query()->where('user_id', $user->id)->where('code', $request->note_code)->first();

        $note->update([
            'workspace' => 1
        ]);

        return $note;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($folder_code, $note_code)
    {
        $user = Auth::user();
        $folder = DB::table('note_folders')->where('user_id', $user->id)->where('code', $folder_code)->first();
        $note = DB::table('notes')->where('user_id', $user->id)->where('code', $note_code)->first();

        if(($folder or $folder_code === 'root') and $note) {
            return view('entities.notes.edit', compact('folder', 'note'));
        } else {
            return view('oops');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $folder_code, $note_code)
    {
        $request->validate([
            'title' => 'required|max:255',
            'text' => 'max:4000',
        ]);

        $user = Auth::user();
        $folder = DB::table('note_folders')->where('user_id', $user->id)->where('code', $folder_code)->first();

        $note = Note::query()->where('user_id', $user->id)->where('code', $note_code)->first();

        $note->update([
            'folder_id' => $folder ? $folder->id : null,
            'title' => $request->title,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols($request->title))))
                .'_'.bin2hex(random_bytes(4)),
            'text' => $request->text,
        ]);

        session()->flash('info', 'Заметка обновлена');
        return redirect()->route('note_folders.notes.index');
    }

    public function ajaxUpdate($note_code)
    {
        $request = new Request();
        $request->merge([
            'text' => $_POST['text'],
        ]);

        $request->validate([
            'text' => 'max:4000',
        ]);

        $user = Auth::user();
        $note = Note::query()->where('user_id', $user->id)->where('code', $note_code)->first();

        $note->update([
            'text' => $_POST['text'],
            'workspace' => $_POST['workspace']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($note_code)
    {
        $user = Auth::user();
        $note = Note::query()->where('user_id', $user->id)->where('code', $note_code)->first();

        $note->delete();
    }
}
