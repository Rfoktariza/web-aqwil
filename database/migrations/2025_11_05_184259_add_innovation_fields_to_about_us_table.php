<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->string('innovation_title')->nullable()->after('mission_content');
            $table->text('innovation_content')->nullable()->after('innovation_title');
        });
    }

    /**
     * Hapus kolom jika rollback.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn(['innovation_title', 'innovation_content']);
        });
    }
};
