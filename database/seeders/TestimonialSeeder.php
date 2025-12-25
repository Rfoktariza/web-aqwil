<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Rina Pratama',
                'job_title' => 'Pecinta Kucing',
                'message' => 'Aplikasi Anabul sangat membantu saya melacak jadwal vaksin dan pemeriksaan kucing saya. Interface-nya juga mudah digunakan!',
                'photo' => 'testimonials/rina.jpg',
            ],
            [
                'name' => 'Andi Saputra',
                'job_title' => 'Dokter Hewan',
                'message' => 'Sistemnya bagus sekali, terutama fitur Smart ID Tag yang mempermudah identifikasi hewan secara cepat.',
                'photo' => 'testimonials/andi.jpg',
            ],
            [
                'name' => 'Clara Wijaya',
                'job_title' => 'Pemilik Petshop',
                'message' => 'Integrasi dengan pembayaran Midtrans sangat memudahkan transaksi pelanggan di toko kami.',
                'photo' => 'testimonials/clara.jpg',
            ],
            [
                'name' => 'Budi Santoso',
                'job_title' => 'Mahasiswa Kedokteran Hewan',
                'message' => 'Sebagai mahasiswa, saya bisa belajar banyak dari data yang ada di Anabul. Sistemnya informatif dan mudah dipahami.',
                'photo' => 'testimonials/budi.jpg',
            ],
            [
                'name' => 'Siti Rahmawati',
                'job_title' => 'Penggemar Anjing',
                'message' => 'Saya senang sekali! Sekarang lebih mudah memantau kesehatan anjing saya, semua data tersimpan dengan rapi di aplikasi.',
                'photo' => 'testimonials/siti.jpg',
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::create($item);
        }
    }
}
