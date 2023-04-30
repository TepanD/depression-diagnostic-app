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
        Schema::create('mapping_diagnosis_score', function (Blueprint $table) {
            $table->string('mapds_id');
            $table->integer('min_score');
            $table->integer('max_score');
            $table->string('result_desc', 255);
            $table->string('result_additional_desc')->nullable();
            $table->boolean('is_active')->default(false);
            $table->softDeletes('is_deleted');
            $table->timestamps();

            $table->primary('mapds_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_diagnosis_score');
    }
};
