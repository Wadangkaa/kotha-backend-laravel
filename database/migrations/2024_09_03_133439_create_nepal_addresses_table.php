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
        Schema::create('nepal_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('name');
            $table->string('type')->comment('1 PROVINCE, 2 DISTRICT');
            $table->foreignId('parent_id')->nullable()->constrained('nepal_addresses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nepal_addresses');
    }
};
