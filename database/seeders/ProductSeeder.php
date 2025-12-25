<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::create([

            'name' => 'Tempat Tidur Pasien Elektrik 3 Crank',
            'slug' => Str::slug('Tempat Tidur Pasien Elektrik 3 Crank'),
            'short_description' => 'Tempat tidur pasien elektrik dengan pengaturan remote dan tiang infus stainless.',
            'description' => '<p>Tempat tidur pasien elektrik 3 crank dirancang untuk kenyamanan pasien...</p>',

            'specs' => [
                "Dimensi (P x L x T)" => "200 x 90 x 80 cm",
                "Konstruksi" => "Plat besi, Pipa besi",
                "Siderail" => "ABS",
                "Bagian Kepala & Kaki" => "ABS",
                "Head Raise" => "Adjust By Remote",
                "Hi-Lo" => "Adjust By Remote",
                "Foot Raise" => "Adjust By Remote",
                "Bed" => "Busa lapis vinyl",
                "Finishing" => "Cat duco",
                "Roda" => "5 inci",
                "Accessories" => "Tiang infus SS",
                "Pilihan warna bed" => ["Merah", "Biru", "Hitam", "Ungu", "Oranye", "Hijau"]
            ],
            'status' => 'published',
        ]);

        // Tambahkan gambar ke produk
        $images = [
            'products/bed-elektrik-1.jpg',
            'products/bed-elektrik-2.jpg',
            'products/bed-elektrik-3.jpg',
        ];

        foreach ($images as $index => $img) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $img,
                'is_primary' => $index === 0,
            ]);
        }
    }
}
