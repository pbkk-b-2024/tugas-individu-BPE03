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
        Schema::create('keranjang_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keranjang_id')->constrained('keranjang')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('item')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_item');
    }
};
