<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Items;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $data =[
            'title' => 'admin-item',
        ];

        $item = Items::all();
        $category = Category::all();

        return view('dashboard.admin.master_item',array_merge($data,compact('item','category')));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'kode_barang' => 'required|numeric',
                'nama' => 'required|string|max:225',
                'category' => 'required|exists:kategoris,id',
                'stok' => 'required|numeric',
                'lokasi' => 'required|string',
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Untuk melihat error validasi
        }

        $item = Items::create([
            'kode_barang' => $validatedData['kode_barang'],
            'category_id' => $validatedData['category'],
            'nama_barang' => $validatedData['nama'],
            'stok' => $validatedData['stok'],
            'lokasi' => $validatedData['lokasi'],
            'status' => 'tersedia',
        ]);

        return redirect()->route('item.index')->with('success','Item Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $items = Items::findOrFail($id);
        
        $validatedData = $request->validate([
            'kode_barang' => 'required|numeric',
            'nama' => 'required|string|max:225',
            'category' => 'required|exists:kategoris,id',
            'stok' => 'required|numeric',
            'lokasi' => 'required|string',
            'status' => 'required|string',
        ]);

        $items->update([
            'kode_barang' => $validatedData['kode_barang'],
            'category_id' => $validatedData['category'],
            'nama_barang' => $validatedData['nama'],
            'stok' => $validatedData['stok'],
            'lokasi' => $validatedData['lokasi'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('item.index')->with('success','Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        // Temukan item berdasarkan ID atau gagal jika tidak ditemukan
        $item = Items::findOrFail($id);
    
        // Hapus item
        $item->delete();
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('item.index')->with('success', 'Barang berhasil dihapus');
    }
    
}
