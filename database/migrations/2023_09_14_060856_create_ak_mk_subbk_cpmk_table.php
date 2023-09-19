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
        Schema::create('ak_mk_subbk_cpmk', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kdmksubbk');
            $table->string('cpmk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_mk_subbk_cpmk');
    }
};
