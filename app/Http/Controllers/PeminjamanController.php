<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\PeminjamanItem;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{

    private function generateNoTransaksi()
    {
        $latest = Peminjaman::latest()->first();
        $number = $latest ? intval(substr($latest->no_transaksi, -2)) + 1 : 1;
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $data = [
            'title' => 'Peminjaman-Staff',
        ];
        
        $peminjaman = Peminjaman::where('user_id', auth()->user()->id)->get();

        return view('dashboard.staff.peminjaman.index',array_merge($data,compact('peminjaman')));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'jam_peminjaman' => 'required',
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        $peminjaman = Peminjaman::create([
            'no_transaksi' => $this->generateNoTransaksi(),
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'jam_peminjaman' => $request->jam_peminjaman,
            'nama_peminjam' => $user->name,
            'user_id' => $user->id,
        ]);

        $peminjaman->riwayat()->create([
            'status' => 'pending',
        ]);

        return redirect()->route('peminjaman.index')->with('success','No Peminjaman berhasil dibuat');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'detail-pinjaman',
        ];

        $peminjaman = Peminjaman::with('items')->findOrFail($id);
        $items = Items::with('category')->get();

        return view('dashboard.staff.peminjaman.peminjaman',array_merge($data,compact('items','peminjaman')));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'alasan_peminjaman' => 'required|string',
            'items' => 'required|array',
            'items.*.kode_barang' => 'required|string',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        // Cari peminjaman berdasarkan user login
        $peminjaman = Peminjaman::where('user_id', auth()->user()->id)->latest()->first();

        if (!$peminjaman) {
            return response()->json(['error' => 'Tidak ada transaksi peminjaman ditemukan'], 404);
        }

        // Update alasan peminjaman
        $peminjaman->alasan_peminjaman = $request->alasan_peminjaman;
        $peminjaman->save();

        // Masukkan barang ke tabel peminjaman_items
        foreach ($request->items as $item) {
            $itemModel = Items::where('kode_barang', $item['kode_barang'])->first();
            if ($itemModel) {
                $peminjaman->items()->attach($itemModel->id, [
                    'jumlah_unit' => $item['jumlah'],
                ]);
            }
        }

        $peminjaman->riwayat()->create([
            'status' => 'submitted',
        ]);

        return response()->json(['message' => 'Peminjaman berhasil diajukan']);
    }

    public function showRiwayat(Request $request)
    {
        $data = [
            'title' => 'riwayat-peminjaman',
        ];
        $order = $request->get('order', 'desc');
        $returns = Peminjaman::with('items')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', $order)
            ->get();
    
        return view('dashboard.staff.riwayat_peminjaman',array_merge($data,compact('returns', 'order')));
    }

    public function getPeminjamanItems($id)
    {
        try {
            // Ambil data peminjaman dan item terkait
            $items = PeminjamanItem::with('item.category') // Pastikan relasi sudah benar
                ->where('peminjaman_id', $id)
                ->get();
    
            if ($items->isEmpty()) {
                return response()->json(['message' => 'Data tidak ditemukan.'], 404);
            }
    
            $data = $items->map(function ($peminjamanItem) {
                return [
                    'kode_barang' => $peminjamanItem->item->kode_barang,
                    'nama_barang' => $peminjamanItem->item->nama_barang,
                    'kategori' => $peminjamanItem->item->category->nama ?? '-',
                    'lokasi' => $peminjamanItem->item->lokasi,
                    'jumlah_unit' => $peminjamanItem->jumlah_unit,
                ];
            });
    
            return response()->json(['items' => $data], 200);
    
        } catch (\Exception $e) {
            // Tangani error
            return response()->json(['message' => 'Gagal memuat data.'], 500);
        }
    }
}
