<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserPresence;
use App\Events\UserPresenceUpdated;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required'    => 'Email is required.',
                'email.email'       => 'Enter a valid email address.',
                'password.required' => 'Password is required.',
            ]
        );

        if (Auth::guard('admin')->attempt($credentials)) {

            UserPresence::updateOrCreate(
                [
                    'user_id'   => auth('admin')->id(),
                    'user_type' => 'admin',
                ],
                [
                    'is_online' => true,
                    'last_seen' => now(),
                ]
            );

            broadcast(new UserPresenceUpdated())->toOthers();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Show admin registration form
     */
    public function showRegisterForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }

        return view('admin.register');
    }

    /**
     * Handle admin registration
     */
    public function register(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:admins,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required'      => 'Name is required.',
                'email.required'     => 'Email is required.',
                'email.email'        => 'Enter a valid email.',
                'email.unique'       => 'This email is already registered.',
                'password.required' => 'Password is required.',
                'password.min'      => 'Password must be at least 6 characters.',
                'password.confirmed'=> 'Password confirmation does not match.',
            ]
        );

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/admin/login')
            ->with('success', 'Admin account created successfully. Please login.');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        UserPresence::where('user_id', auth('admin')->id())
            ->where('user_type', 'admin')
            ->update([
                'is_online' => false,
                'last_seen' => now(),
            ]);

        broadcast(new UserPresenceUpdated())->toOthers();

        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
