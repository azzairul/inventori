<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Items;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        $data = [
            'title' => 'admin-categories',
        ];

        return view('dashboard.admin.kategori_barang',array_merge($data, compact('category')));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        Category::create($request->all());
        return redirect()->route('category.index')->with('success','Kategori Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:225',
        ]);

        $category->nama = $request->input('nama');

        $category->save();

        return redirect()->route('category.index')->with('success', 'Category and related items updated successfully');

    }

    public function destroy($id)
    {
        // Cek apakah kategori ada
        $category = Category::findOrFail($id); // Ini sudah otomatis mengarahkan ke 404 jika tidak ditemukan
    
        // Cek apakah kategori memiliki item yang terkait (misalnya, kategori yang memiliki relasi dengan item)
        if ($category->items()->count() > 0) {
            // Jika ada item yang terkait, beri pesan kesalahan
            return redirect()->route('category.index')
                ->with('error', 'Category cannot be deleted because it has related items.');
        }
    
        // Hapus kategori jika tidak ada item yang terkait
        $category->delete();
    
        // Redirect setelah berhasil menghapus
        return redirect()->route('category.index')
            ->with('success', 'Category Deleted Successfully');
    }
    
}
