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
        Schema::create('ak_kurikulum_bks', function (Blueprint $table) {
            $table->id('kdbk');
            $table->string('kode_bk', 15);
            $table->string('bahan_kajian', 50);
            $table->unsignedSmallInteger('kdbasil');
            $table->unsignedSmallInteger('kdbidil');
            $table->unsignedSmallInteger('kdkurikulum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_kurikulum_bks');
    }
};
