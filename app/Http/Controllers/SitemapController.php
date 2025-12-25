<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\News;    
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
{
    $products = Product::all();

    return response()->view('sitemap', [
        'products' => $products,
    ])->header('Content-Type', 'text/xml');
}
}