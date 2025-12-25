<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsCategory;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = NewsCategory::orderBy('created_at', 'desc')->get();
        return view('admin.news_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.news_categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:150',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        // Jika slug kosong → generate dari name
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        NewsCategory::create($data);

        return redirect()->route('admin.kategori-berita.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }


    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $category = NewsCategory::findOrFail($id);
        return view('admin.news_categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $category = NewsCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:150|unique:news_categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.kategori-berita.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        NewsCategory::findOrFail($id)->delete();

        return redirect()->route('admin.kategori-berita.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
