<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Database connection error. Please check MySQL service.']);
        }
        
        if ($user) {
            $passwordMatch = false;
            
            // Check if password starts with bcrypt hash format
            if (str_starts_with($user->password, '$2y$')) {
                // Use bcrypt verification
                if (Hash::check($request->password, $user->password)) {
                    $passwordMatch = true;
                }
            } else {
                // Use plain text comparison
                if ($request->password === $user->password) {
                    $passwordMatch = true;
                }
            }
            
            if ($passwordMatch) {
                session([
                    'user_id' => $user->id,
                    'user_role' => $user->role,
                    'user_email' => $user->email,
                    'user_name' => $user->name,
                    'user_kelas' => $user->kelas,
                    'user_jabatan' => $user->jabatan
                ]);
                
                // Remember Me functionality
                if ($request->remember) {
                    Cookie::queue('remember_email', $user->email, 43200); // 30 days
                    Cookie::queue('remember_name', $user->name, 43200);
                }
                
                return $this->redirectByRole($user->role);
            }
        }
        
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function register(Request $request)
    {
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password' => 'Konfirmasi password tidak cocok']);
        }
        
        try {
            if (User::where('email', $request->email)->exists()) {
                return back()->withErrors(['email' => 'Email sudah terdaftar']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Database connection error. Please check MySQL service.']);
        }
        
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'gender' => $request->gender,
                'kelas' => $request->role === 'siswa' ? $request->kelas : null,
                'jabatan' => $request->role !== 'siswa' ? $request->jabatan : null,
                'no_hp' => $request->no_hp,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Database connection error. Please check MySQL service.']);
        }
        
        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_email' => $user->email,
            'user_name' => $user->name,
            'user_kelas' => $user->kelas,
            'user_jabatan' => $user->jabatan
        ]);
        
        return $this->redirectByRole($user->role);
    }

    public function googleLogin()
    {
        try {
            $users = User::orderBy('role')->orderBy('name')->get();
            return view('auth.google-select', compact('users'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Database connection error. Please check MySQL service.']);
        }
    }

    public function googleCallback(Request $request)
    {
        if ($request->email === '[REGISTER_NEW]') {
            return redirect()->route('register');
        }
        
        try {
            $user = User::where('email', $request->email)->first();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Database connection error. Please check MySQL service.']);
        }
        
        if ($user) {
            session([
                'user_id' => $user->id,
                'user_role' => $user->role,
                'user_email' => $user->email,
                'user_name' => $user->name,
                'user_kelas' => $user->kelas,
                'user_jabatan' => $user->jabatan
            ]);
            
            return view('auth.google-success', ['redirectUrl' => $this->getRedirectUrl($user->role)]);
        }
        
        return redirect()->route('login')->withErrors(['email' => 'User tidak ditemukan']);
    }

    public function logout()
    {
        session()->flush();
        Cookie::queue(Cookie::forget('remember_email'));
        Cookie::queue(Cookie::forget('remember_name'));
        return redirect()->route('home')->with('success', 'Berhasil logout');
    }

    private function redirectByRole($role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard')->with('login_success', true);
        } else {
            return redirect()->route('dashboard')->with('login_success', true);
        }
    }

    private function getRedirectUrl($role)
    {
        return $role === 'admin' ? '/admin/dashboard' : '/dashboard';
    }
}