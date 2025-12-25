<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'latest'); // default sorting

        $news = News::with('categories')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($sort === 'oldest', function ($query) {
                $query->oldest();
            }, function ($query) {
                $query->latest();
            })
            ->paginate(10)
            ->withQueryString(); // supaya search & sort tidak hilang saat pindah page

        return view('admin.news.index', compact('news', 'search', 'sort'));
    }


    public function create()
    {
        $categories = NewsCategory::all();

        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:news_categories,id',
        ]);

        $data = $request->only(['title', 'excerpt', 'content']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // 🔹 Simpan data berita
        $news = News::create($data);

        // 🔹 Sinkronkan kategori (many-to-many)
        $news->categories()->sync($request->categories);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        $selectedCategories = $news->categories->pluck('id')->toArray();

        return view('admin.news.edit', compact('news', 'categories', 'selectedCategories'));
    }


    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:news_categories,id',
        ]);

        // Ambil data utama
        $data = $request->only(['title', 'excerpt', 'content']);
        $data['slug'] = Str::slug($request->title);

        // 🔹 Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan file-nya masih eksis
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        // 🔹 Update data berita
        $news->update($data);

        // 🔹 Sinkronkan kategori (Many-to-Many)
        $news->categories()->sync($request->categories);

        // 🔹 Redirect dengan pesan sukses
        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }


    public function destroy(News $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $path = $request->file('image')->store('news/content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

}
