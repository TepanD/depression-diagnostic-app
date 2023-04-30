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
        Schema::table('header_questions', function (Blueprint $table) {
            $table->foreign('dtq_id')->references('dtq_id')->on('detail_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('header_questions', function (Blueprint $table) {
            $table->dropForeign(['dtq_id']);
        });
    }
};
