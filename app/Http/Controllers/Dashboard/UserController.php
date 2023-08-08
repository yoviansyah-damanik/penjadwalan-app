<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Officer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);

        return view('dashboard.pages.user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('dashboard.pages.user.show', compact('user'));
    }

    public function create()
    {
        $officers = Officer::doesntHave('user')
            ->get();
        return view('dashboard.pages.user.create', compact('officers'));
    }

    public function store(UserRequest $request)
    {
        $officer = Officer::whereSlug($request->officer)->firstOrFail();

        $new_user = new User();
        $new_user->name = $officer->name;
        $new_user->username = $request->username;
        $new_user->email = $request->email;
        $new_user->password = bcrypt($request->password);
        $new_user->officer_id = $officer->id;
        $new_user->save();

        $new_user->assignRole('Officer');

        return to_route('user')
            ->with('store_success', true)
            ->with('alert_feature', __('User'));
    }

    public function destroy(User $user)
    {
        if ($user->role_name == 'Administrator')
            return to_route('user')
                ->with('exception_alert', true)
                ->with('alert_msg', __('User with that role cannot be deleted.'));

        $user->delete();

        return to_route('user')
            ->with('delete_success', true)
            ->with('alert_feature', __('User'));
    }

    public function forgot_password(User $user)
    {
        $rand = Str::random(10);

        $user->password = bcrypt($rand);
        $user->save();

        return to_route('user.show', $user->id)
            ->with('update_success', true)
            ->with('alert_feature', __('User'))
            ->with('new_password', $rand);
    }
}
