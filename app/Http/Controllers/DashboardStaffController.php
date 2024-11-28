<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardStaffController extends Controller
{
    public function index(){
        return view('dashboard.staff.index',[
            'title' => 'staff-dashboard'
        ]);
    }

    public function profile(){
        return view('dashboard.staff.profile',[
            'title' => 'profile'
        ]);
    }

    public function editProfile(){
        return view('dashboard.staff.profile',[
            'title' => 'profile'
        ]);
    }

        // Menampilkan form edit profil
        public function edit()
        {
            return view('dashboard.staff.edit-profile', [
                'title' => 'Edit Profil',
                'detailUser' => Auth::user()->detailUser,
            ]);
        }
    
        // Menyimpan perubahan profil
        public function update(Request $request)
        {
            // Validasi semua field wajib diisi
            $validated = $request->validate([
                'nik' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'riwayat_pendidikan' => 'required|string|max:500',
                'posisi_dilamar' => 'required|string|max:255',
            ]);
        
            // Mendapatkan detailUser user yang sedang login
            $detailUser = Auth::user()->detailUser;
        
            if ($detailUser) {
                // Update data di detail_users
                $detailUser->update($validated);
            } else {
                // Jika belum ada data di detail_users, buat baru
                $detailUser = Auth::user()->detailUser()->create($validated);
            }
        
            // Jika semua data detail_users sudah diisi, ubah status user menjadi 'verify'
            if ($this->isDetailUserComplete($detailUser)) {
                Auth::user()->update(['status' => 'verify']);
            }
            return redirect('staff-dashboard/profile')->with('success', 'Profil berhasil diperbarui.');
        }
        
        // Metode tambahan untuk memeriksa apakah semua data detail_users sudah lengkap
        private function isDetailUserComplete($detailUser)
        {
            // Pastikan semua kolom di detail_users tidak kosong
            return $detailUser->nik &&
                   $detailUser->alamat &&
                   $detailUser->no_telepon &&
                   $detailUser->tanggal_lahir &&
                   $detailUser->jenis_kelamin &&
                   $detailUser->riwayat_pendidikan &&
                   $detailUser->posisi_dilamar;
        }
}
