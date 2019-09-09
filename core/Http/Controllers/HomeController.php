<?php

namespace Fanintek\Fantasena\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

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
        return view('home');
    }

    /**
     * Show the user profile info.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request, FormBuilder $formBuilder)
    {
        $formChangePassword = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserChangePassword::class, [
            'method' => "POST",
            'url' => route('profile')
        ])->addBefore('password', 'old_password', 'password', [
            'attr' => ['placeholder' => '******'],
            'rules' => 'required|string|min:6|max:50'
        ]);
        return view('profile', compact('formChangePassword'));
    }
}
