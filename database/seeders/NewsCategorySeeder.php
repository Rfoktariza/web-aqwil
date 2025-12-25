<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsCategory;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kesehatan',
                'slug' => 'kesehatan',
                'description' => 'Berita dan artikel terkait dunia kesehatan dan rumah sakit.',
            ],
            [
                'name' => 'Teknologi Medis',
                'slug' => 'teknologi-medis',
                'description' => 'Inovasi terbaru dalam alat dan peralatan medis.',
            ],
            [
                'name' => 'Perawatan Pasien',
                'slug' => 'perawatan-pasien',
                'description' => 'Tips dan informasi mengenai perawatan pasien di rumah sakit maupun di rumah.',
            ],
            [
                'name' => 'Produk Baru',
                'slug' => 'produk-baru',
                'description' => 'Informasi tentang produk dan furnitur rumah sakit terbaru dari kami.',
            ],
            [
                'name' => 'Acara & Pameran',
                'slug' => 'acara-pameran',
                'description' => 'Berita tentang kegiatan, event, dan pameran yang kami ikuti.',
            ],
        ];

        foreach ($categories as $category) {
            NewsCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
