<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            AboutUsSeeder::class,
            CategorySeeder::class,
            FaqSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
            PageSeeder::class,
            ProductSeeder::class,
            UsersTableSeeder::class,
            TestimonialSeeder::class,
            WebpageSettingSeeder::class,

        ]);
    }
}
