<?php

namespace Fanintek\Fantasena\Http\Controllers\Auth;

use Fanintek\Fantasena\Models\User;
use Fanintek\Fantasena\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (config('fanrbac.allow_new_registration') == false)
            return redirect()->to('/');

        return view('auth.register');
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \FanintekFantasena\User
     */
    protected function create(array $data)
    {
        if (config('fanrbac.allow_new_registration') == false)
            return redirect()->to('/');
            
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'is_active' => false,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole(config('fanrbac.new_user_default_role'));
        
        return $user;
    }
}
