<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('user.hostel.list');
        }
        return view('user.auth.reg');
    }

    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('user.hostel.list');
        }

        return view('user.auth.login');
    }

    public function logging(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->except('_token'))) {
            return to_route('user.hostel.list');
        }

        return to_route('user.login')
            ->with('error', 'Username or Password not matched!');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:140', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:6', 'max:40'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'type' => 2,
            'status' => 1
        ]);

        Auth::loginUsingId($user->id);

        return to_route('user.hostel.list');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return to_route('user');
    }
}
