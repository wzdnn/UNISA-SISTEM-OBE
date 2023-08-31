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
        Schema::create('ak_kurikulum_cpl_ak_kurikulum_cplr', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ak_kurikulum_cpl_id');
            $table->unsignedInteger('ak_kurikulum_cplr_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_kurikulum_cpl_ak_kurikulum_cplr');
    }
};
