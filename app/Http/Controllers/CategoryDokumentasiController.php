<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryDokumentasi;
use App\Models\Dokumentasi;

class CategoryDokumentasiController extends Controller
{
    public function index()
    {
        $category = CategoryDokumentasi::all();

        $data = [
            'title' => 'admin-categories_dokumentasi',
        ];

        return view('dashboard.admin.kategori_dokumentasi', array_merge($data, compact('category')));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        CategoryDokumentasi::create($request->all());

        return redirect()->route('category.index')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $category = CategoryDokumentasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $category->update(['nama' => $request->input('nama')]);

        return redirect()->route('category.index')->with('success', 'Kategori Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $category = CategoryDokumentasi::findOrFail($id);

        // Cek apakah kategori memiliki item yang terkait
        if ($category->items()->count() > 0) {
            return redirect()->route('category.index')
                ->with('error', 'Kategori tidak dapat dihapus karena memiliki item terkait.');
        }

        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Kategori Berhasil Dihapus');
    }
}
