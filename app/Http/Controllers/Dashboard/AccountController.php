<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\AccountRequest;
use App\Http\Requests\Dashboard\AccountNewPasswordRequest;

class AccountController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.account.index');
    }

    public function update(AccountRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        return to_route('account')
            ->with('update_success', true)
            ->with('alert_feature', __('Account'));
    }

    public function new_password(AccountNewPasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return to_route('account')
            ->with('update_success', true)
            ->with('alert_feature', __('Password'));
    }
}
