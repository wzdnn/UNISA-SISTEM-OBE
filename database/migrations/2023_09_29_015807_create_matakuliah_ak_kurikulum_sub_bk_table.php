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
        Schema::create('matakuliah_ak_kurikulum_sub_bk', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('matakuliah_id');
            $table->unsignedInteger('ak_kurikulum_sub_bk_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah_ak_kurikulum_sub_bk');
    }
};
