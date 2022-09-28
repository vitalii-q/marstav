<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Converter;
use App\Helpers\Regular;
use App\Http\Controllers\Controller;
use App\Models\DealStage;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        list($user, $uniqid) = $this->makeUniqueUserCode();

        while ($user) {
            list($user, $uniqid) = $this->makeUniqueUserCode();
        }

        $user_id = User::query()->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'code' => $uniqid
        ]);

        $user = User::query()->find($user_id);

        DealStage::addStarterStages($user);

        return $user;
    }

    protected function makeUniqueUserCode()
    {
        $uniqid = bin2hex(random_bytes(16));
        return [User::query()->where('code', $uniqid)->first(), $uniqid];
    }
}
