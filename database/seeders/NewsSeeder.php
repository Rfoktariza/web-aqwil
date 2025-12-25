<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::insert([
            [
                'title' => 'Tips Memilih Peralatan Medis Rumah Sakit',
                'slug' => 'tips-memilih-peralatan-medis-rumah-sakit',
                'excerpt' => 'Pelajari cara memilih produk berkualitas untuk fasilitas medis Anda.',
                'content' => 'Dalam memilih peralatan medis, pastikan Anda memperhatikan standar keamanan, keawetan, dan dukungan purna jual dari penyedia. Produk dengan sertifikasi resmi biasanya lebih terpercaya.',
                'image' => 'news/article1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Peran Teknologi dalam Kesehatan Modern',
                'slug' => 'peran-teknologi-dalam-kesehatan-modern',
                'excerpt' => 'Bagaimana inovasi teknologi membantu tenaga medis memberikan pelayanan terbaik.',
                'content' => 'Teknologi seperti sistem monitoring digital, AI diagnosis, dan alat steril otomatis telah merevolusi pelayanan medis modern.',
                'image' => 'news/article2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Standar Keamanan Produk Medis',
                'slug' => 'standar-keamanan-produk-medis',
                'excerpt' => 'Pentingnya memastikan setiap produk medis memenuhi standar keamanan global.',
                'content' => 'Setiap produk medis harus melewati uji sertifikasi sesuai regulasi internasional seperti ISO 13485 untuk memastikan keamanan dan efisiensi penggunaan.',
                'image' => 'news/article3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
