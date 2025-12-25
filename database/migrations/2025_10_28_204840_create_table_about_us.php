<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();                  // Judul bagian "Tentang Kami"
            $table->text('content_1')->nullable();                // Paragraf pertama
            $table->text('content_2')->nullable();                // Paragraf kedua
            $table->string('hero_image')->nullable();             // Gambar hero
            $table->string('vision_title')->nullable();           // Judul visi
            $table->text('vision_content')->nullable();           // Teks visi
            $table->string('mission_title')->nullable();          // Judul misi
            $table->text('mission_content')->nullable();          // Daftar misi (bisa JSON atau teks panjang)
            $table->string('vision_image')->nullable();           // Gambar bagian visi & misi
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
