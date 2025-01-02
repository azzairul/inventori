<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardStaffController extends Controller
{
    public function index()
    {
        return view('dashboard.staff.index', [
            'title' => 'staff-dashboard',
        ]);
    }

    public function profile()
    {
        return view('dashboard.staff.profile', [
            'title' => 'profile',
        ]);
    }

    public function edit()
    {
        return view('dashboard.staff.edit-profile', [
            'title' => 'Edit Profil',
            'detailUser' => Auth::user()->detailUser,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string|max:20',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'status' => 'required|string',
            'alamat' => 'required|string',
            'divisi' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'no_telepon' => 'required|string',
            'instagram' => 'nullable|string',
            'twiter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'nama_institusi' => 'nullable|string',
            'jurusan' => 'nullable|string',
            'tahun_lulus' => 'nullable',
        ]);

    
        // Update user data
        $user = auth()->user();
    
        // Cek apakah semua field data diri telah diisi lengkap
        $allFieldsFilled = $request->has('nik') && 
                           $request->has('jenis_kelamin') && 
                           $request->has('tempat_lahir') && 
                           $request->has('tanggal_lahir') && 
                           $request->has('alamat') && 
                           $request->has('no_telepon');
    
        // Update status menjadi 'verified' jika semua field terisi
        $user->update([
            'status' => $allFieldsFilled ? 'verify' : 'unverify', // Jika lengkap, set status jadi 'verified'
            // Other user fields if necessary
        ]);


    
        // Update detail user data
        DetailUser::where('user_id', $user->id)->update($validated);

    
        return redirect('/staff-dashboard/profile')->with('success', 'Profil berhasil diperbarui.');
    }
    
    
}
