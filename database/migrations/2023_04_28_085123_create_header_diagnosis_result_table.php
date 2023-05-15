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
        Schema::create('header_diagnosis_result', function (Blueprint $table) {
            $table->string('hdr_id');
            $table->string('user_id');
            $table->string('user_name');
            $table->integer('result_score');
            $table->string('mapds_id');
            $table->datetime('result_date');
            $table->string('create_operator');
            $table->string('last_operator')->nullable();
            $table->timestamps();

            $table->primary(['hdr_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_diagnosis_result');
    }
};
