<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebpageSetting;

class WebpageSettingSeeder extends Seeder
{
    public function run(): void
    {
        WebpageSetting::create([
            'hero_title' => 'Solusi Lengkap Alat & Furniture Rumah Sakit',
            'hero_subtitle' => 'Menyediakan peralatan medis dan furniture berkualitas tinggi untuk meningkatkan standar pelayanan kesehatan Anda.',
            'whatsapp_number' => '6281234567890',
            'footer_email' => 'info@yourcompany.com',
            'footer_phone' => '021-1234567',
            'company_address' => 'Jl. Sehat No.123, Jakarta, Indonesia',
            'link_facebook' => 'https://facebook.com/yourcompany',
            'link_twitter' => 'https://twitter.com/yourcompany',
            'link_linkedin' => 'https://linkedin.com/company/yourcompany',
            'footer_text' => 'Menyuplai rumah sakit dan klinik dengan peralatan bersertifikat dan furnitur yang tahan lama.',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.230150498761!2d106.89952322062372!3d-6.49251652084064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c12ce704d3e5%3A0x23742da6744c2008!2sAqwil%20Medica%20Alkes%20-%20Alat%20Kesehatan%20Bogor!5e0!3m2!1sid!2sid!4v1762000804566!5m2!1sid!2sid',

        ]);
    }
}
