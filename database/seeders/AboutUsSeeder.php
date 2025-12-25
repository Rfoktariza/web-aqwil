<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us')->insert([
            'title' => 'Tentang Kami',
            'content_1' => 'Sejak tahun 1989, Aqwil Medica telah menjadi pionir dalam penyediaan alat-alat kesehatan dan furniture rumah sakit di Indonesia. Dengan pengalaman lebih dari tiga dekade, kami terus berinovasi untuk menghadirkan solusi terbaik bagi fasilitas kesehatan di seluruh Indonesia.',
            'content_2' => '',
            'hero_image' => 'hero/hero-bg.jpg', // contoh path ke storage
            'vision_title' => 'Visi Kami',
            'vision_content' => 'Menjadi penyedia alat kesehatan dan furniture rumah sakit terpercaya serta terlengkap di Indonesia.',
            'mission_title' => 'Misi Kami',
            'mission_content' => '<p>Menjadi perusahaan terbaik di bidangnya.</p>',
            'vision_image' => 'hero/visi-misi.jpg',
            'innovation_title' => 'Inovasi Kami',
            'innovation_content' => 'Terus berinovasi dalam setiap aspek layanan.',
            'clinic_count' => 102,
            'hospital_count' => 50,
            'partner_count' => 35,

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
