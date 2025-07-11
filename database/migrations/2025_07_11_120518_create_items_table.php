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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name', 50);
            $table->string('item_code')->unique();
            $table->enum('category', ['telecom', 'id_number', 'digital_code']);
            $table->enum('type', ['permanent', 'temporary']);
            $table->unsignedBigInteger('price_suggestion');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
