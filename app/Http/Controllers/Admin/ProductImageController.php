<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;

class ProductImageController extends Controller
{
    public function destroy($produkId, $imageId)
    {
        $image = \App\Models\ProductImage::find($imageId);

        if (!$image) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'error' => 'Gambar tidak ditemukan.'], 404);
            }
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        // Pastikan image milik produk
        if ($image->product_id != $produkId) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'error' => 'Gambar tidak ditemukan untuk produk ini.'], 404);
            }
            return redirect()->back()->with('error', 'Gambar tidak ditemukan untuk produk ini.');
        }

        // Hapus file
        if ($image->image_path && \Storage::exists('public/' . $image->image_path)) {
            \Storage::delete('public/' . $image->image_path);
        }

        // Hapus record
        $image->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.produk.edit', $produkId)
            ->with('success', 'Gambar berhasil dihapus.');
    }


}
