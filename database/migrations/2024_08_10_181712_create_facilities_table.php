<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kotha_id')->constrained('kothas')->onDelete('cascade');
            $table->integer('bed_room')->nullable();
            $table->boolean('kitchen')->default(true);
            $table->integer('bathroom')->default(1);
            $table->boolean('parking')->default(false);
            $table->boolean('balcony');
            $table->foreignId('rental_floor')->constrained('rental_floors');
            $table->boolean('water_facility');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
