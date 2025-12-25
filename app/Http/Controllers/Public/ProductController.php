<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function produk(Request $request)
    {
        $query = Product::query();

        // Filter berdasarkan kategori
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(9);
        $categories = Category::orderBy('name')->get();

        return view('frontend.produk', compact('products', 'categories'));
    }
}
