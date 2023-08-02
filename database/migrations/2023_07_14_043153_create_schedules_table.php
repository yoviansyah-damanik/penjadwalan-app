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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('officer_id')
                ->references('id')
                ->on('officers')
                ->onDelete('cascade');
            $table->foreignId('timetable_id')
                ->references('id')
                ->on('timetables')
                ->onDelete('cascade');
            $table->foreignId('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade');
            $table->date('date');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
