<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('property_id')->constrained('properties');
        $table->foreignId('buyer_id')->constrained('users');
        $table->enum('transaction_type', ['sale', 'rent']);
        $table->decimal('amount', 15, 2);
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
