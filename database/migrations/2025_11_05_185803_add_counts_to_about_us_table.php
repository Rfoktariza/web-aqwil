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
        Schema::table('about_us', function (Blueprint $table) {
            Schema::table('about_us', function (Blueprint $table) {
                $table->integer('clinic_count')->default(0)->after('vision_image');
                $table->integer('hospital_count')->default(0)->after('clinic_count');
                $table->integer('partner_count')->default(0)->after('hospital_count');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn(['clinic_count', 'hospital_count', 'partner_count']);
        });
    }
};
