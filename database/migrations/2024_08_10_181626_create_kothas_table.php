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
        Schema::create('kothas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('status')->default(1);
            $table->string('title');
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->double('price', 10, 2);
            $table->boolean('negotiable')->default(true);
            $table->string('purpose')->default('rent')->comment('rent | sale | lease');
            $table->foreignId('district_id')->constrained('nepal_addresses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kothas');
    }
};
