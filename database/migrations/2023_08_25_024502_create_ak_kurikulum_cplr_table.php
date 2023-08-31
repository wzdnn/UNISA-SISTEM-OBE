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
        Schema::create('ak_kurikulum_cplrs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cplr', 15);
            $table->string('cplr', 50);
            $table->text('deskripsi_cplr');
            $table->unsignedSmallInteger('kdaspek');
            $table->unsignedSmallInteger('kdsumber');
            $table->unsignedSmallInteger('kdkurikulum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ak_kurikulum_cplrs');
    }
};
