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
        Schema::create('header_questions', function (Blueprint $table) {
            $table->string('hdq_id');
            $table->string('hdq_name', 120)->nullable();
            $table->integer('hdq_sequence');
            $table->string('is_active', 1)->default('T');
            $table->softDeletesDatetime('is_deleted');
            $table->string('create_operator');
            $table->string('last_operator')->nullable();
            $table->timestamps();
            
            
            $table->primary(['hdq_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_questions');
    }
};
