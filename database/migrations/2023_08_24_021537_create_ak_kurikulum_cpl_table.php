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
        Schema::create('ak_kurikulum_cpls', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cpl', 15);
            $table->string('cpl', 100);
            $table->text('deskripsi_cpl');
            $table->unsignedInteger('id');
            $table->unsignedInteger('kdkurikulum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_kurikulum_cpls');
    }
};
