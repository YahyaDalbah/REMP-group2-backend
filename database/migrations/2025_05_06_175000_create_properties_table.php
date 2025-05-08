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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users');
            $table->string('title');
            $table->string('image');
            $table->string('location');
            $table->text('description');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->decimal('price', 15, 2);
            $table->boolean('isForRent')->default(false);
            $table->boolean('isForSale')->default(false);
            $table->enum('status', ['available', 'rented', 'sold'])->default('available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
