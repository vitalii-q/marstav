<?php

namespace App\Http\Controllers;

use App\Helpers\Converter;
use App\Helpers\Regular;
use App\Models\Company;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $company = Company::query()->find($user->company_id);
        if (!$company) {
            return view('company.company', compact('company'));
        }

        $employees = User::query()->where('company_id', $company->id)->get();

        return view('company.company', compact('company', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entities.company.create');
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
        ]);

        $user = Auth::user();

        $company_id = Company::query()->insertGetId([
            'creator_id' => $user->id,
            'title' => $request->title,
            'code' => str_replace(' ', '_', strtolower(Converter::transliteration(Regular::removeSymbols($request->title))))
                .'_'.bin2hex(random_bytes(14)),
            'description' => $request->description,
        ]);

        $user->update([
            'company_id' => $company_id
        ]);

        return redirect()->route('company.index');
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
    public function edit($code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function addEmployeeAjax(Request $request)
    {
        $employee = User::query()->where('code', $request->employee_id)->first();

        if (!$employee) {
            session()->flash('error', 'Неверный ID');
            return false;
        }

        /**
         * event
         */
        $user = Auth::user();
        $company = Company::query()->where('id', $user->company_id)->first();
        if(!Notification::query()->where('user_id', $employee->id)->where('type', 'info')
            ->where('anchor', $company->code)->first()
            and !User::query()->where('code', $request->employee_id)->where('company_id', $company->id)->first()) {
            Notification::query()->insert([
                'user_id' => $employee->id,
                'type' => 'info',
                'text' => 'Вас приглашают в компанию '.$company->name,
                'anchor' => $company->code,
                'code' => bin2hex(random_bytes(16))
            ]);
        }

        session()->flash('info', 'Пользователю направлено уведомление с подтверждением.');
        return 1;
    }
}
