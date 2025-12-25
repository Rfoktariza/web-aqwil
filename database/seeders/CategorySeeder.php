<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Alat Medis',
            'Furniture Rumah Sakit',
            'Peralatan Laboratorium',
            'Peralatan Bedah',
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'description' => 'Kategori ' . $cat,
            ]);
        }
    }
}
