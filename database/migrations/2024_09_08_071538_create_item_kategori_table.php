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
        Schema::create('item_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('item')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_kategori');
    }
};
