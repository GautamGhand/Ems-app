<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::with('attendances')->get(),
        ]);
    }
    public function create()
    {
        return view('users.create', [
            'role' => Role::employee()->first()
        ]);
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => 'required|string|min:3|max:255|alpha',
            'last_name' => 'required|string|min:3|max:255|alpha',
            'email' => 'required|email:rfc,dns|unique:users',
            'role_id' => ['required',
                        Rule::in(Role::employeeId())
                        ]
        ]);

        $attributes += [
            'status' => User::ACTIVE,
            'created_by' => Auth::id()
        ];

        $user = User::create($attributes);

        Notification::send($user, new SetPasswordNotification(Auth::user()));

        return redirect()->route('users.index')
            ->with('success', 'User Created Successfully');
    }
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'role'=> Role::employee()->first()
        ]);
    }
    public function update(Request $request, User $user)
    {
        $attributes= $request->validate([
            'first_name' => 'required|string|min:3|max:255|alpha',
            'last_name' => 'required|string|min:3|max:255|alpha',
            'role_id' => ['required',
                        Rule::in(Role::employeeId())
                        ]
        ]);

        $user->update($attributes);

        return redirect()->route('users.edit', $user)
            ->with('success', 'User Updated Successfully');
    }
    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User Deleted Successfully');
    }
}
