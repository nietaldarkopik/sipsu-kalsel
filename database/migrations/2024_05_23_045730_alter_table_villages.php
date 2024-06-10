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
        Schema::table('villages', function (Blueprint $table) {
            // Ensure the id column is of type bigint
            DB::statement('ALTER TABLE "villages" ALTER COLUMN "id" TYPE bigint');

            // Create a sequence
            DB::statement('CREATE SEQUENCE villages_id_seq');

            // Set the default value of the id column to use the sequence
            DB::statement('ALTER TABLE "villages" ALTER COLUMN "id" SET DEFAULT nextval(\'villages_id_seq\')');

            // Ensure the sequence is in sync with the current maximum value of the id column
            DB::statement('SELECT setval(\'villages_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM "villages"), 1), false)');

                
            // Step 1: Change the latitude column to be nullable
            DB::statement('DROP SEQUENCE IF EXISTS villages_alt_name_seq');
            DB::statement('DROP SEQUENCE IF EXISTS villages_latitude_seq');
            DB::statement('DROP SEQUENCE IF EXISTS villages_longitude_seq');

            DB::statement('ALTER TABLE "villages" ALTER COLUMN "alt_name" DROP NOT NULL');
            DB::statement('ALTER TABLE "villages" ALTER COLUMN "latitude" DROP NOT NULL');
            DB::statement('ALTER TABLE "villages" ALTER COLUMN "longitude" DROP NOT NULL');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('villages', function (Blueprint $table) {
            // Reverse the operations
            DB::statement('ALTER TABLE "villages" ALTER COLUMN "id" DROP DEFAULT');
            DB::statement('DROP SEQUENCE IF EXISTS villages_id_seq');
        });
    }
};
