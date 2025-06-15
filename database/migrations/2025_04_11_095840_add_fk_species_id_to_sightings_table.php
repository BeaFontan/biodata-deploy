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
        Schema::table('sightings', function (Blueprint $table) {
            $table->foreignId('species_id')->after('id')->constrained('species')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sightings', function (Blueprint $table) {
            $table->dropForeign(['species_id']);
            $table->dropColumn('species_id');
        });
    }
};
