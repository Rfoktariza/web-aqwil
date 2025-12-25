<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel FAQs.
     */
    public function run(): void
    {
        Faq::insert([
            [
                'question' => 'Bagaimana cara memesan produk?',
                'answer' => 'Anda dapat memesan produk langsung melalui tombol “Pesan Sekarang” yang terhubung ke WhatsApp admin kami.',
                'is_active' => true,
            ],
            [
                'question' => 'Apakah produk memiliki garansi?',
                'answer' => 'Ya, sebagian besar produk kami bergaransi resmi. Pastikan membaca detail produk sebelum membeli.',
                'is_active' => true,
            ],
        ]);
    }
}
