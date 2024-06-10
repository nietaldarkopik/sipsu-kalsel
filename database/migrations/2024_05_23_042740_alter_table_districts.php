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
        Schema::table('districts', function (Blueprint $table) {
            // Ensure the id column is of type bigint
            DB::statement('ALTER TABLE "districts" ALTER COLUMN "id" TYPE bigint');

            // Create a sequence
            DB::statement('CREATE SEQUENCE districts_id_seq');

            // Set the default value of the id column to use the sequence
            DB::statement('ALTER TABLE "districts" ALTER COLUMN "id" SET DEFAULT nextval(\'districts_id_seq\')');

            // Ensure the sequence is in sync with the current maximum value of the id column
            DB::statement('SELECT setval(\'districts_id_seq\', COALESCE((SELECT MAX(id) + 1 FROM "districts"), 1), false)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            // Reverse the operations
            DB::statement('ALTER TABLE "districts" ALTER COLUMN "id" DROP DEFAULT');
            DB::statement('DROP SEQUENCE IF EXISTS districts_id_seq');
        });
    }
};
