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
        Schema::create('detail_diagnosis_result', function (Blueprint $table) {
            $table->string('ddr_id');
            $table->string('hdr_id');
            $table->string('user_id');
            $table->string('hdq_id');
            $table->string('dtq_id');
            $table->integer('score');
            $table->string('create_operator');
            $table->string('last_operator')->nullable();
            $table->timestamps();

            $table->primary('ddr_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_diagnosis_result');
    }
};
