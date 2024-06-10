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
        Schema::create('psu_perumahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perumahan')->nullable();
            $table->enum('kategori', ['sarana','prasarana','utilitas']);
            $table->unsignedBigInteger('id_jenis_psu')->nullable();
            $table->string('nama_psu')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('bast_status', ['belum','sudah','sebagian']);
            $table->text('bast_file');
            $table->date('bast_tanggal');
            $table->enum('kondisi', ['baik','cukup baik','rusak sedang','rusak parah']);
            $table->integer('luas');
            $table->polygon('area');
            $table->point('position');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psu');
    }
};
