<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Client;
use App\Models\FeaturedProduct;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\WebpageSetting;
use App\Models\Faq;
use App\Models\Testimonial;
use Jenssegers\Agent\Agent;




class FrontendController extends Controller
{
    public function index()
    {
        // Ambil hanya 3 produk terbaru
        $products = FeaturedProduct::with('product')
            ->orderBy('order')
            ->get()
            ->pluck('product');

        $faqs = Faq::where('is_active', true)->get();
        $news = News::with('categories')->latest()->take(3)->get();
        $testimonis = Testimonial::latest()->take(5)->get();




        return view('frontend.home', compact('products', 'faqs', 'news', 'testimonis'));
    }



    public function produk(Request $request)
    {
        $agent = new Agent();

        // Ambil produk dengan relasi gambar utama
        $query = Product::with(['primaryImage'])
            ->where('status', 'published');

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        // Filter berdasarkan nama produk
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔹 Tentukan jumlah produk per halaman
        // Deteksi otomatis: jika user mobile → tampilkan 12, jika desktop → 16
        $perPage = $agent->isMobile() ? 12 : 16;

        $products = $query->paginate($perPage)->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('frontend.produk', compact('products', 'categories'));
    }





    public function detailProduk($slug)
    {
        // Ambil produk berdasarkan slug
        $product = Product::with(['images', 'primaryImage', 'categories'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Ambil ID kategori dari produk tersebut
        $categoryIds = $product->categories->pluck('id');

        // Ambil produk lain yang memiliki kategori yang sama
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('status', 'published')
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->with(['images', 'primaryImage', 'categories'])
            ->inRandomOrder()
            ->take(20)
            ->get();

        return view('frontend.detail-produk', compact('product', 'relatedProducts'));
    }




    public function tentangKami()
    {
        $about = AboutUs::first();
        $clients = Client::all();

        return view('frontend.tentang', compact('about', 'clients'));

    }

    public function kontakKami()
    {
        $about = AboutUs::first();
        $clients = Client::all();
        $faqs = Faq::where('is_active', true)->get();

        return view('frontend.kontak', compact('about', 'faqs'));

    }

    public function kebijakanPrivasi()
    {
        $about = AboutUs::first();
        $clients = Client::all();
        $faqs = Faq::where('is_active', true)->get();

        return view('frontend.kontak', compact('about', 'faqs'));

    }

    public function berita()
    {
        // 🔹 Ambil 1 berita paling baru
        $latestArticle = News::latest()->first();

        // 🔹 Ambil daftar berita lain, tidak termasuk $latestArticle
        $berita = News::where('id', '!=', optional($latestArticle)->id)
            ->latest()
            ->paginate(6);

        // 🔹 Ambil top 5 berita lain, juga tidak termasuk $latestArticle
        $topNews = News::where('id', '!=', optional($latestArticle)->id)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.berita.index', compact('berita', 'topNews', 'latestArticle'));
    }



    public function detailBerita($slug)
    {
        $news = News::where('slug', $slug)
            ->with('categories')
            ->firstOrFail();
        $topNews = News::latest()->take(5)->get();

        // Berita terkait (opsional)
        $related = News::where('id', '!=', $news->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.berita.detail', compact('news', 'related', 'topNews'));
    }

}
