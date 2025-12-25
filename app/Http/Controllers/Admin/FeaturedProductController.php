<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function index()
    {
        $featured = FeaturedProduct::with('product')->orderBy('order')->get();
        $products = Product::orderBy('name')->get();
        return view('admin.featured.index', compact('featured', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        FeaturedProduct::create([
            'product_id' => $request->product_id,
            'order' => FeaturedProduct::max('order') + 1,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke beranda.');
    }

    public function destroy($id)
    {
        FeaturedProduct::destroy($id);
        return back()->with('success', 'Produk dihapus dari beranda.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            FeaturedProduct::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

}
