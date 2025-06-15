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
        Schema::create('species', function (Blueprint $table): void {
            $table->id();
            $table->enum('type', ['animal', 'plant']);
            $table->string('scientific_name', 200)->unique();
            $table->string('common_name', 100)->nullable();
            $table->string('kingdom', 80)->nullable();
            $table->string('phylum', 100)->nullable();
            $table->string('class', 100)->nullable();
            $table->string('order', 100)->nullable();
            $table->string('family', 100)->nullable();
            $table->string('genus',100)->nullable();
            $table->string('species_name', 150)->nullable();
            $table->string('subspecies', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
