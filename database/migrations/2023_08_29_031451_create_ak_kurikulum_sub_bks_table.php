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
        Schema::create('ak_kurikulum_sub_bks', function (Blueprint $table) {
            $table->id('kdsubbk');
            $table->string('kode_subbk', 15);
            $table->string('sub_bk');
            $table->string('referensi');
            $table->unsignedInteger('kdbk');
            $table->unsignedSmallInteger('kdkurikulum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_kurikulum_sub_bks');
    }
};
