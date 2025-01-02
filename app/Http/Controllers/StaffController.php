<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StaffController extends Controller
{
        // Fungsi untuk menampilkan halaman manajemen akun staf
        public function showProfile()
        {
            // Ambil data staf yang sedang login
            return view('dashboard.staff.update-pw', [
                'staff' => Auth::user(),
                'title'=> 'Update Akun',
            ]);
        }
    
        // Fungsi untuk mengubah password staf
        public function changePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ]);
        
            $user = User::find(Auth::id());
        
            // Periksa apakah password lama cocok
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Password lama salah.');
            }
        
            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();
        
            return redirect()->route('staff.profile')->with('success', 'Password berhasil diubah.');
        }
}
