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
        Schema::create('ak_matakuliah_ak_kurikulum_sub_bk', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kdmatakuliah');
            $table->unsignedInteger('ak_kurikulum_sub_bk_id');
            $table->string('pokok_bahasan')->nullable();
            $table->unsignedTinyInteger('kuliah')->nullable();
            $table->unsignedTinyInteger('tutorial')->nullable();
            $table->unsignedTinyInteger('seminar')->nullable();
            $table->unsignedTinyInteger('praktikum')->nullable();
            $table->unsignedTinyInteger('skill_lab')->nullable();
            $table->unsignedTinyInteger('field_lab')->nullable();
            $table->unsignedTinyInteger('praktik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_matakuliah_ak_kurikulum_sub_bk');
    }
};
