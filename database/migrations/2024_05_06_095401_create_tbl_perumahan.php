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
        Schema::create('perumahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->unsignedBigInteger('kabkota_id')->nullable();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->unsignedBigInteger('pengembang_id')->nullable();
            $table->string('nama_perumahan')->nullable();
            $table->string('luas')->nullable();
            $table->string('tahun_siteplan')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->point('latlong')->nullable();
            $table->integer('total_unit')->nullable();
            $table->integer('jumlah_mbr')->nullable();
            $table->integer('jumlah_nonmbr')->nullable();
            $table->string('no_bast')->nullable();
            $table->string('file_bast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perumahan');
    }
};
