<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // SORTING
        $sortField = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        // Pastikan field aman
        $allowedSort = ['name', 'created_at', 'status'];
        if (!in_array($sortField, $allowedSort)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortOrder);

        // PAGINATION
        $products = $query->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products', 'sortField', 'sortOrder'));
    }


    public function create()
    {

        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 🔒 Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            // 'price' => 'required|numeric|min:0',
            // 'stock' => 'nullable|integer|min:0',
            'status' => 'required|in:published,draft',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'specs' => 'nullable|array',
            'specs.*.key' => 'nullable|string',
            'specs.*.value' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // 💾 Simpan produk utama
            $product = Product::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'],
                // 'price' => $validated['price'],
                // 'stock' => $validated['stock'] ?? 0,
                'status' => $validated['status'],
                'primary_image_new' => 'required', // ini memastikan ada input radio yang dikirim

            ]);

            // 🔗 Simpan relasi kategori
            $product->categories()->sync($validated['categories']);

            // 🧩 Simpan spesifikasi (kolom `specs` dalam bentuk JSON)
            if (!empty($validated['specs'])) {
                $specArray = [];
                foreach ($validated['specs'] as $spec) {
                    if (!empty($spec['key'])) {
                        $specArray[$spec['key']] = $spec['value'] ?? '';
                    }
                }

                $product->specs = json_encode($specArray);
                $product->save();
            }

            // 📸 Upload multiple images (jika ada)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');

                    // cek apakah user menandai gambar ini sebagai primary
                    $isPrimary = isset($request->primary_image_new) && $request->primary_image_new == $index;

                    $product->images()->create([
                        'image_path' => $path,
                        'is_primary' => $isPrimary,
                    ]);
                }
            }


            DB::commit();

            return redirect()
                ->route('admin.produk.index')
                ->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function edit(Product $produk)
    {
        $categories = Category::all(); // ambil semua kategori dari tabel categories
        return view('admin.products.edit', compact('produk', 'categories'));
    }


    public function update(Request $request, Product $produk)
    {
        // Validasi request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string',
            // 'price' => 'required|numeric',
            // 'stock' => 'nullable|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'specs' => 'nullable|array',
            'specs.*.key' => 'nullable|string',
            'specs.*.value' => 'nullable|string',
            'status' => 'nullable|in:published,draft',
            'images.*' => 'nullable|image|max:2048',
            'primary_image' => 'required', // ini memastikan ada input radio yang dikirim

        ]);

        // Sync kategori
        if (isset($validated['categories'])) {
            $produk->categories()->sync($validated['categories']);
        }

        // 🧩 Simpan spesifikasi (kolom `specs` dalam bentuk JSON)
        if (!empty($validated['specs'])) {
            $specArray = [];
            foreach ($validated['specs'] as $spec) {
                if (!empty($spec['key'])) {
                    $specArray[$spec['key']] = $spec['value'] ?? '';
                }
            }

            $validated['specs'] = json_encode($specArray);

        }


        // Handle slug otomatis
        if (!isset($validated['slug']) && isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Update data produk
        $produk->update($validated);

        // Tentukan primary image
        $primary = $request->input('primary_image'); // nilai bisa "old-12" atau "new-0"

        // Reset semua gambar lama is_primary = false
        $produk->images()->update(['is_primary' => false]);

        if ($primary) {
            if (str_starts_with($primary, 'old-')) {
                // Primary dari gambar lama
                $id = (int) str_replace('old-', '', $primary);
                $produk->images()->where('id', $id)->update(['is_primary' => true]);
            }
        }


        // Handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');

                // Tentukan apakah gambar baru ini primary
                $isPrimary = $primary === "new-{$index}";

                $produk->images()->create([
                    'image_path' => $path,
                    'is_primary' => $isPrimary,
                ]);

                // Jika primary sudah ditetapkan, pastikan hanya satu
                if ($isPrimary) {
                    $produk->images()->where('is_primary', true)->where('id', '!=', $produk->images()->latest('id')->first()->id)
                        ->update(['is_primary' => false]);
                }
            }
        }


        return redirect()->route('admin.produk.edit', $produk->id)
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // AJAX delete gambar
    public function destroyImage(Product $produk, ProductImage $image)
    {
        // Pastikan gambar memang milik produk
        if ($image->product_id != $produk->id) {
            return response()->json(['success' => false, 'error' => 'Gambar tidak valid.'], 400);
        }

        try {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal menghapus gambar.'], 500);
        }
    }



    public function destroy(Product $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
