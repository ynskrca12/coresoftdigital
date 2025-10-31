<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'E-posta adresi gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'password.required' => 'Şifre gereklidir.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.',
        ]);

        $remember = $request->has('remember');

        // Attempt to login
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Check if user is admin
            if (!$user->is_admin) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors(['email' => 'Bu hesap admin paneline erişim yetkisine sahip değil.'])
                    ->withInput($request->only('email'));
            }

            // Check if user is active
            if (!$user->status) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors(['email' => 'Bu hesap devre dışı bırakılmış. Lütfen yönetici ile iletişime geçin.'])
                    ->withInput($request->only('email'));
            }

            // Update last login info
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            $request->session()->regenerate();

            // Log activity (if activity log is enabled)
            if (function_exists('activity')) {
                activity()
                    ->causedBy($user)
                    ->withProperties([
                        'ip' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                    ])
                    ->log('Admin paneline giriş yapıldı');
            }

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Hoş geldiniz, ' . $user->name . '!');
        }

        // Login failed
        return back()
            ->withErrors(['email' => 'E-posta veya şifre hatalı.'])
            ->withInput($request->only('email'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        // Log activity before logout

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Başarıyla çıkış yaptınız.');
    }

    /**
     * Demo login helper (for development)
     * Remove this in production!
     */
    public function demoLogin()
    {
        // Demo credentials
        $demoUser = [
            'email' => 'admin@coresoftdigital.com',
            'password' => 'password123',
        ];

        if (Auth::attempt($demoUser)) {
            request()->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('login')->with('error', 'Demo giriş başarısız.');
    }
}
