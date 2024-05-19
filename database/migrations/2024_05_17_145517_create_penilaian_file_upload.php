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
        Schema::create('penilaian_file_upload', function (Blueprint $table) {
            $table->id();
            $table->string('folder');
            $table->text('file');
            $table->foreignId('jenisNilai_id');
            $table->foreignId('tahunAkademik_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_file_upload');
    }
};
