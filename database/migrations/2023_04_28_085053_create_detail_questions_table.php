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
        Schema::create('detail_questions', function (Blueprint $table) {
            $table->string('dtq_id');
            $table->string('dtq_name');
            $table->integer('dtq_sequence');
            $table->string('score')->nullable();
            $table->softDeletesDatetime('is_deleted');
            $table->string('create_operator');
            $table->string('last_operator')->nullable();
            $table->timestamps();

            $table->primary('dtq_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_questions');
    }
};
