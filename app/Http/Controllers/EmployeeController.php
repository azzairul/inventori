<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengambil data user login
use App\Models\DetailUser;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    public function index()
    {
        $data = [
            'staff' => Auth::user(), // User yang sedang login
            'title' => 'Master Karyawan',
        ];
        // Ambil semua data karyawan
        $employees = DetailUser::whereHas('user', function ($query) {
            $query->where('role', 'staff');
        })->get();
        return view('dashboard.admin.master_karyawan', array_merge($data, compact('employees')));
    }

    public function show($id)
    {

        $data = [
            'staff' => Auth::user(), // User yang sedang login
            'title' => 'Update Akun',
        ];
        // Ambil data karyawan berdasarkan ID
        $employee = DetailUser::findOrFail($id);
        return view('dashboard.admin.karyawan.detail', array_merge($data, compact('employee')));
    }

    public function edit($id)
    {
        $data = [
            'staff' => Auth::user(),
            'title' => 'Edit User',
        ];

        $employee = DetailUser::findOrFail($id);
        return view('dashboard.admin.karyawan.edit', array_merge($data, compact('employee')));
    }

    public function update(Request $request, $id)
    {
        // Find the user by ID
        $employee = DetailUser::findOrFail($id);
    
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
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
            'tahun_lulus' => 'nullable|date', // If it's a date or null
        ]);

        // dd('Updated Data:',$validated);
    
        // Update the employee record with validated data
        $employee->update($validated);
    
        // Redirect back with success message
        return redirect()->route('employees.show', $employee->id)
            ->with('success', 'Profil berhasil diperbarui.');
    }    

    public function destroy($id)
    {
        // Hapus data karyawan
        DB::transaction(function () use ($id) {
            // Cari data DetailUser
            $employee = DetailUser::findOrFail($id);
    
            // Ubah status user menjadi 'unverify'
            $employee->user->update(['status' => 'unverify']);
    
            // Hapus data karyawan
            $employee->delete();
        });

        return redirect()->route('employees.list')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
