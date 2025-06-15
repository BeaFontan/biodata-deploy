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
        Schema::create('conservation_status', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 20)->unique();
            $table->string('label', 20);
            $table->string('color', 7);
            $table->unsignedInteger('threshold');
            $table->string('actions', 255);
            $table->boolean('should_notify')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conservation_status');
    }
};
