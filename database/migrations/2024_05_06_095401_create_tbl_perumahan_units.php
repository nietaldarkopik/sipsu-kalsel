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
        Schema::create('perumahan_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perumahan_id')->nullable();
            $table->string('type')->nullable();
            $table->string('total')->nullable();
            $table->string('realisasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perumahan_units');
    }
};
