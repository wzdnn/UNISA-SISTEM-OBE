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
        Schema::create('subbk_cpmk', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ak_kurikulum_sub_bk_id');
            $table->unsignedInteger('ak_kurikulum_cpmk_id');
            $table->string('ak_kurikulum_cpmk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subbk_cpmk');
    }
};
