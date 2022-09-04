<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $user = User::query()->where('code', $code)->first();

        return view('profile.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        if (Auth::user()->code !== $code) {
            return view('oops');
        }

        $profile = User::query()->where('code', Auth::user()->code)->first();

        return view('profile.edit', compact('profile'));
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
        if ($user->code !== $code) {
            return view('oops');
        }

        $request->validate([
            'name' => 'required|max:40',
            'surname' => 'max:40',
            'patronymic' => 'max:40',
            // проверка на уникальность всех email пользователей кроме своего
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);
        if ($request->phone !== null) {
            $request->validate([
                'phone' => 'min:11|numeric'
            ]);
        }

        if($request->delete_photo == 'yes') {
            if (file_exists($user->photo)) {
                unlink($user->photo);
            }

            $user->update(["photo" => null]);
        } elseif (isset($request->photo)) {
            $unique_code = bin2hex(random_bytes(4));
            $photo_name = explode('.', $request->photo->getClientOriginalName())[0];
            $photo_extension = $request->photo->extension();

            if (file_exists($user->photo)) {
                unlink($user->photo);
            }

            $company = Company::query()->find($user->company_id);
            if ($company) {
                $path = 'companies/'.$company->code.'/avatars/'.$photo_name.'_'.$unique_code.'.'.$photo_extension;
                Storage::disk('public')->put($path, file_get_contents($request->photo));
            } else {
                $path = 'users/'.$user->code.'/'.$photo_name.'_'.$unique_code.'.'.$photo_extension;
                Storage::disk('public')->put($path, file_get_contents($request->photo));
            }

            $user->update(["photo" => 'storage/'.$path]);
        }

        $user->update([
            "name" => $request->name,
            "surname" => $request->surname,
            "patronymic" => $request->patronymic,
            "email" => $request->email,
            "phone" => $request->phone,
        ]);

        session()->flash('info', 'Профайл обновлен');
        return view('profile.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $rules = array(
            'password' => ['required', 'string', 'min:8', 'confirmed']
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            session()->flash('error', 'Не удалось обновить пароль');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if(Hash::check($request->old_password, $user->password)) {
            User::whereId($user->id)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        session()->flash('info', 'Пароль обновлен');
        return redirect()->route('profile.show', [$user->code]);
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
