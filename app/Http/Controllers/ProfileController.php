<?php

namespace App\Http\Controllers;

use App\Facades\EntityManager;
use App\Facades\FileManager;
use App\Models\Company;
use App\Models\Dialog;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = Auth::user();
        $profile = User::query()->where('code', $code)->first();
        $company = Company::query()->find($user->company_id);

        return view('profile.profile', compact('user', 'profile', 'company'));
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
            'photo' => 'nullable|max:3000'
        ]);
        if ($request->phone !== null) {
            $request->validate([
                'phone' => 'min:11',
            ]);
        }

        if($request->delete_photo == 'yes') {
            FileManager::delete($user->photo);
            $user->update(["photo" => null]);
        } elseif (isset($request->photo)) {
            FileManager::delete($user->photo);
            $path = FileManager::save($request->photo, 'avatar', true);
            $user->update(["photo" => $path]);
        }

        $user->update([
            "name" => $request->name,
            "surname" => $request->surname,
            "patronymic" => $request->patronymic,
            "email" => $request->email,
            "phone" => $request->phone
        ]);

        session()->flash('info', 'Профайл обновлен');
        return redirect()->route('profile.show', $user->code);
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

    public function leaveCompany(Request $request)
    {
        $user = Auth::user();
        $employee = User::query()->where('code', $request->code)->first();
        $company = Company::query()->find($employee->company_id);

        if($user->id == $employee->id OR $user->id == $company->creator_id) {
            $employee->update([
                'company_id' => null,
                'company_added' => null
            ]);

            EntityManager::userLeavesCompany($employee, $company);
        }

        return 1;
    }
}
