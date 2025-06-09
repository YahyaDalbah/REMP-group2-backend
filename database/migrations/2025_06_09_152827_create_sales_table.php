<?php






use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->decimal('price', 12, 2);
    $table->timestamp('sold_at');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
