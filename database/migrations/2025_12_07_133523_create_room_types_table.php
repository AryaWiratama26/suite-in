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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Deluxe, Suite, Executive, etc.
            $table->text('description')->nullable();
            $table->integer('max_occupancy')->default(2);
            $table->integer('bed_count')->default(1);
            $table->string('bed_type')->default('King'); // King, Queen, Twin, etc.
            $table->decimal('size_sqm', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
