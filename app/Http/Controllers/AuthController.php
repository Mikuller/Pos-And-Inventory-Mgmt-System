<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function forgetPassword(){
        return view('auth.passwords.reset');
    }
    public function resetPassword()
    {
        if (Hash::check(request('oldPassword'), Auth::user()->password)) {
            $validated = request()->validate([
                'password' => 'required|min:8',
            ]);
            $validated['accountStatus'] = 'active';
            $user = Auth::user();
            $user->update($validated);
            return redirect()
                ->route('dashboard')
                ->with('success', 'You have successfully Reset Your Password');
        } else {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Make sure old password is correct!');
        }
    }

    public function store()
    {
        $validate = request()->validate([
            'name' => 'required|max:40|min:2',
            'email' => 'required|email|unique:users,email|',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'You have successfully Registerd');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $validate = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt($validate, true)) {
            request()
                ->session()
                ->regenerate();

            return redirect()
                ->route('dashboard')
                ->with('success', "You're Logged in successfully!");
        } else {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'No matching user found!',
                ]);
        }
    }

    public function logout()
    {
        //event(new Logout([],auth()->user()));
        auth()->logout();
        request()
            ->session()
            ->invalidate();
        request()
            ->session()
            ->regenerateToken();
        session()->flush();
        return redirect()
            ->route('dashboard')
            ->with('success', 'logged out successfully');
    }
}
