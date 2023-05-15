<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('header_diagnosis_result', function (Blueprint $table) {
            $table->foreign('mapds_id')->references('mapds_id')->on('mapping_diagnosis_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('header_diagnosis_result', function (Blueprint $table) {
            $table->dropForeign('header_diagnosis_result_mapds_id_foreign');
        });
    }
};
