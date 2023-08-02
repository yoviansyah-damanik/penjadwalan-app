<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.pages.login');
    }

    public function do_login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string'
            ],
            [],
            [
                'username' => __('Username') . '/Email',
                'password' => __('Password')
            ]
        );

        $username = $request->username;
        $password = $request->password;


        $fieldType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($fieldType, $username)
            ->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user, $request->has('remember_me'));

                $request->session()
                    ->regenerate();

                return redirect()
                    ->route('dashboard');
            }
            return back()
                ->with(['msg' => __('Wrong Authentication.')])
                ->withInput();
        }

        return back()
            ->with(['msg' => __('No user found.')])
            ->withInput();
    }

    // public function register()
    // {
    //     return view('auth.pages.register');
    // }

    // public function do_register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:200',
    //         'email' => 'required|email:dns|unique:users,email',
    //         'password' => 'required|min:8',
    //         'confirm_password' => 'required|same:password'
    //     ]);

    //     $new_user = new User();
    //     $new_user->name = $request->name;
    //     $new_user->email = $request->email;
    //     $new_user->password = bcrypt($request->password);
    //     $new_user->save();

    //     return to_route('login')
    //         ->with('msg', 'User was created successfully!');
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }
}
