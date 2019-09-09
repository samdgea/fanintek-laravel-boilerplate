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
     * @param \Kris\LaravelFormBuilder\FormBuilder
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request, FormBuilder $formBuilder)
    {
        $formChangePassword = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserChangePassword::class, [
            'method' => "POST",
            'url' => route('change-password')
        ])->addBefore('password', 'old_password', 'password', [
            'attr' => ['placeholder' => '******'],
            'rules' => 'required|string|min:6|max:50'
        ]);

        return view('profile', compact('formChangePassword'));
    }

    /**
     * Process change Password
     * 
     * @param \Illuminate\Http\Request
     * @param \Kris\LaravelFormBuilder\FormBuilder
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(Request $request, FormBuilder $formBuilder)
    {
        $formChangePassword = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserChangePassword::class)
        ->addBefore('password', 'old_password', 'password', [
            'attr' => ['placeholder' => '******'],
            'rules' => 'required|string|min:6|max:50'
        ]);
        
        if (!$formChangePassword->isValid())
            return redirect()->back()->withErrors($formChangePassword->getErrors())->withInput();

        $fields = $formChangePassword->getFieldValues();
        $user = \Auth::user();

        if (\Hash::check($fields['old_password'], $user->password) === false)
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Incorrect old password, please try again');

        $user->password = \Hash::make($fields['password']);

        if ($user->save())
            return redirect()->route('manage.menu.index')->with('splash-type', 'success')->with('splash-message', 'Password was changed successfully');
        
        return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
        
    }

    /**
     * Process change Profile
     * 
     * @param \Illuminate\Http\Request
     * @param \Kris\LaravelFormBuilder\FormBuilder
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeProfile(Request $request, FormBuilder $formBuilder)
    {

    }
}
