<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('webpage_settings', function (Blueprint $table) {
            $table->string('catalog_pdf')->nullable()->after('footer_text');
        });
    }

    public function down()
    {
        Schema::table('webpage_settings', function (Blueprint $table) {
            $table->dropColumn('catalog_pdf');
        });
    }

};
