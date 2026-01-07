<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show customer login form
     */
    public function showLoginForm()
    {
        if (Auth::guard('customer')->check()) {
            return redirect('/customer/dashboard');
        }

        return view('customer.login');
    }

    /**
     * Handle customer login
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
                'email.email'       => 'Enter a valid email.',
                'password.required' => 'Password is required.',
            ]
        );

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/customer/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Show customer registration form
     */
    public function showRegisterForm()
    {
        if (Auth::guard('customer')->check()) {
            return redirect('/customer/dashboard');
        }

        return view('customer.register');
    }

    /**
     * Handle customer registration
     */
    public function register(Request $request)
    {
        $request->validate(
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:customers,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required'       => 'Name is required.',
                'email.required'      => 'Email is required.',
                'email.email'         => 'Enter a valid email.',
                'email.unique'        => 'This email is already registered.',
                'password.required'  => 'Password is required.',
                'password.min'       => 'Password must be at least 6 characters.',
                'password.confirmed' => 'Password confirmation does not match.',
            ]
        );

        Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/customer/login')
            ->with('success', 'Account created successfully. Please login.');
    }

    /**
     * Logout customer
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/customer/login');
    }
}
