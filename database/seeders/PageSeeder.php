<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;



class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'content' => '<p>Kami adalah penyedia alat dan furniture rumah sakit terpercaya di Indonesia.</p>',
            'meta_title' => 'Tentang Kami - PT Contoh Medika',
            'meta_description' => 'Informasi tentang perusahaan penyedia alat dan furniture rumah sakit terpercaya di Indonesia.',
        ]);
    }
}
