<?php

namespace App\Http\Controllers\admin;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\PeminjamanItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->get('order', 'desc');
        $peminjaman = Peminjaman::where('status', 'pending') // Sesuaikan status untuk pengembalian
            ->orderBy('created_at', $order)
            ->get();

        return view('dashboard.admin.pengembalian.index', compact('peminjaman'));
    }

    public function show($id)
    {
        $items = Peminjaman::with('items')
            ->findOrFail($id)
            ->items;

        return response()->json(['items' => $items]);
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'approved']);

        return response()->json(['message' => 'Pengembalian berhasil disetujui.']);
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'rejected']);

        return response()->json(['message' => 'Pengembalian ditolak.']);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
