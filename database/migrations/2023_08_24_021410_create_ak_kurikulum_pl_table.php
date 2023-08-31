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
        Schema::create('ak_kurikulum_pls', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pl', 9);
            $table->string('profile_lulusan', 100);
            $table->text('deskripsi_profile');
            $table->smallInteger('kdkurikulum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_kurikulum_pls');
    }
};
