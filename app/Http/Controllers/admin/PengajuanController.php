<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Peminjaman;
use App\Models\PeminjamanItem;

class PengajuanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'admin-pengajuan',
        ];

        $peminjaman = Peminjaman::all();

        return view('dashboard.admin.pengajuan_peminjaman',array_merge($data,compact('peminjaman')));
    }

    public function show($id)
    {   
        // Ambil data berdasarkan peminjaman_id
        $items = PeminjamanItem::with('item.category') // Relasi ke model Items dan Category
            ->where('peminjaman_id', $id)
            ->get()
            ->map(function ($peminjamanItem) {
                return [
                    'kode_barang' => $peminjamanItem->item->kode_barang,
                    'nama_barang' => $peminjamanItem->item->nama_barang,
                    'kategori' => $peminjamanItem->item->category->nama ?? '-',
                    'lokasi' => $peminjamanItem->item->lokasi,
                    'jumlah_unit' => $peminjamanItem->jumlah_unit,
                ];
            });

        if ($items->isNotEmpty()) {
            return response()->json([
                'items' => $items,
            ]);
        }

        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
    public function accTransaction($id)
    {
        // Temukan peminjaman berdasarkan ID
        $peminjaman = Peminjaman::with('items')->find($id);

        if (!$peminjaman) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        // Ubah status peminjaman menjadi "Diterima"
        $peminjaman->status = 'Diterima';
        $peminjaman->save();

        // Update stok pada items berdasarkan jumlah_unit dari peminjaman_items
        foreach ($peminjaman->items as $item) {
            // Ambil jumlah unit dari tabel pivot
            $jumlahUnit = $item->pivot->jumlah_unit;

            // Kurangi stok item
            $item->stok -= $jumlahUnit;
            $item->save();
        }

        return response()->json(['message' => 'Peminjaman berhasil diterima dan stok diperbarui.']);
    }

    public function tolak($id)
    {
        $peminjaman = Peminjaman::with('items')->find($id);

        if (!$peminjaman) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        // Ubah status peminjaman menjadi "Diterima"
        $peminjaman->status = 'Ditolak';
        $peminjaman->save();

        return response()->json(['message' => 'Peminjaman berhasil ditolak.']);

    }
} 