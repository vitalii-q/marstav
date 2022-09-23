<?php

namespace App\Http\Controllers\Entities;

use App\Helpers\Converter;
use App\Http\Controllers\Controller;
use App\Models\Entities\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $contacts = Contact::query()->where('user_id', $user->id)->orderBy('surname')->orderBy('name')->get();

        return view('entities.contacts.contacts', compact('contacts'));
    }

    public function showContact($code)
    {
        $user = Auth::user();
        $contacts = Contact::query()->where('user_id', $user->id)->orderBy('surname')->orderBy('name')->get();

        $contact = Contact::query()->where('user_id', $user->id)->where('code', $code)->first();

        return view('entities.contacts.contacts', compact('contacts', 'contact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entities.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required_without:surname|max:255',
            'surname' => 'max:255',
            'patronymic' => 'max:255',
            'position' => 'max:255',
            'company' => 'max:255',
            'email' => 'max:255|email|nullable',
            'private_email' => 'max:255|email|nullable',
            'phone' => 'max:255',
            'private_phone' => 'max:255',
            'address' => 'max:255',
            'born' => 'date_format:d/m/Y|nullable',
            'note' => 'max:2000'
        ]);

        Contact::query()->insert([
            'user_id' => $user->id,
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'position' => $request->position,
            'company' => $request->company,
            'email' => $request->email,
            'private_email' => $request->private_email,
            'phone' => $request->phone,
            'private_phone' => $request->private_phone,
            'address' => $request->address,
            'born' => $request->born,
            'note' => $request->note,
            'code' => ($user->surname?strtolower(Converter::transliteration($user->surname)):strtolower(Converter::transliteration($user->name)))
                .'_'.bin2hex(random_bytes(16))
        ]);

        session()->flash('info', 'Контакт добавлен');
        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $user = Auth::user();
        $contact = Contact::query()->where('user_id', $user->id)->where('code', $code)->first();

        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $user = Auth::user();
        $contact = Contact::query()->where('user_id', $user->id)->where('code', $code)->first();

        return view('entities.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        $user = Auth::user();
        $contact = Contact::query()->where('user_id', $user->id)->where('code', $code)->first();

        $request->validate([
            'name' => 'required_without:surname|max:255',
            'surname' => 'max:255',
            'patronymic' => 'max:255',
            'position' => 'max:255',
            'company' => 'max:255',
            'email' => 'max:255|email|nullable',
            'private_email' => 'max:255|email|nullable',
            'phone' => 'max:255',
            'private_phone' => 'max:255',
            'address' => 'max:255',
            'born' => 'date_format:d/m/Y|nullable',
            'note' => 'max:2000'
        ]);

        $contact->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'position' => $request->position,
            'company' => $request->company,
            'email' => $request->email,
            'private_email' => $request->private_email,
            'phone' => $request->phone,
            'private_phone' => $request->private_phone,
            'address' => $request->address,
            'born' => $request->born,
            'note' => $request->note
        ]);

        session()->flash('info', 'Контакт обновлен');
        return redirect()->route('contacts.show_contact', [$code]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
