<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at
        $order = $request->input('order', 'desc'); // Default order desc

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
        })
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('dashboard.admin.users', [
            'title' => 'users',
            'users' => $users,
            'search' => $search,
            'sortBy' => $sortBy,
            'order' => $order,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
        ]);

        // Membuat data user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('staff123'),
            'role' => 'staff',
            'status' => 'unverify',
        ]);

        // Membuat data detail_users dengan data kosong
        $user->detailUser()->create();

        return response()->json(['success' => 'Akun Staff Berhasil Dibuat.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect ke halaman sebelumnya (users list)
        return redirect('admin-dashboard/users')->with('success', 'Data user berhasil dihapus!');
    }

    public function update(Request $request, User $user)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Update data user
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        $user->save(); // Simpan perubahan ke database

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success_update', 'Data user berhasil diperbarui!');
    }
}
