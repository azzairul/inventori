<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Ambil user login
            $user = Auth::user();

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect('/admin-dashboard')->with('success', 'Login berhasil sebagai Admin');
            } elseif ($user->role === 'staff') {
                return redirect('/staff-dashboard')->with('success', 'Login berhasil sebagai Staff');
            }
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }
}
