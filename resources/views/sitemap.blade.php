{!! '<' . '?' . 'xml version="1.0" encoding="UTF-8" ' . '?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/produk') }}</loc>
        <priority>0.8</priority>
    </url>

    @foreach ($products as $product)
    <url>
        <loc>{{ url('/produk/' . $product->slug) }}</loc>
        <lastmod>{{ $product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>