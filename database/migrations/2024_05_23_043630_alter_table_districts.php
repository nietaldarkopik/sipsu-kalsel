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
        // Step 1: Change the latitude column to be nullable
        DB::statement('DROP SEQUENCE IF EXISTS districts_alt_name_seq');
        DB::statement('DROP SEQUENCE IF EXISTS districts_latitude_seq');
        DB::statement('DROP SEQUENCE IF EXISTS districts_longitude_seq');

        DB::statement('ALTER TABLE "districts" ALTER COLUMN "alt_name" DROP NOT NULL');
        DB::statement('ALTER TABLE "districts" ALTER COLUMN "latitude" DROP NOT NULL');
        DB::statement('ALTER TABLE "districts" ALTER COLUMN "longitude" DROP NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
