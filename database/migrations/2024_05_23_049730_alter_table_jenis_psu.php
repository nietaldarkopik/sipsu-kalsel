<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jenis_psu', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
        Schema::table('jenis_psu', function (Blueprint $table) {
            $table->integer('kategori')->nullable();
            $table->string('title')->nullable()->change();
            $table->text('deskripsi')->nullable()->change();
            
            $table->foreign('kategori')->references('id')->on('kategori_psu')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_psu', function (Blueprint $table) {
            $table->enum('kategori',['prasarana','sarana','utilitas'])->change();
            $table->dropForeign('kategori');
        });
    }
};
