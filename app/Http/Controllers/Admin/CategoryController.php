<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // 🔍 SEARCH (opsional)
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔽 SORTING
        $sortField = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');

        $allowedSort = ['name', 'created_at'];
        if (!in_array($sortField, $allowedSort)) {
            $sortField = 'name';
        }

        $query->orderBy($sortField, $sortOrder);

        // 📌 PAGINATION
        $categories = $query->paginate(10)->withQueryString();

        return view('admin.kategori.index', compact('categories', 'sortField', 'sortOrder'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        // 🔒 Validasi request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // 💾 Simpan kategori
        $category = Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        // 🔔 Redirect dengan pesan sukses
        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori "' . $category->name . '" berhasil ditambahkan!');
    }

    // Tambahkan edit
    public function edit(Category $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Tambahkan update
    public function update(Request $request, Category $kategori)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',

        ]);

        $kategori->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,

        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }


    public function destroy(Category $kategori)
    {
        try {
            $kategori->delete();

            return redirect()
                ->route('admin.kategori.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.kategori.index')
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

}
