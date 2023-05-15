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
        Schema::table('detail_diagnosis_result', function (Blueprint $table) {
            $table->foreign('hdq_id')->references('hdq_id')->on('header_questions');
            $table->foreign('dtq_id')->references('dtq_id')->on('detail_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_diagnosis_result', function (Blueprint $table) {
            $table->dropforeign('detail_diagnosis_result_dtq_id_foreign' );
            $table->dropForeign('detail_diagnosis_result_hdq_id_foreign');
        });
    }
};
