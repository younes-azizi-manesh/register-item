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
        Schema::create('sim_ads', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_number')->unique();
            $table->string('owner_name', 50);
            $table->enum('type', ['for_sale', 'installment', 'loan']);
            $table->unsignedBigInteger('price');
            $table->string('city');
            $table->date('expire_at')->nullable();
            $table->boolean('is_special')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sim_ads');
    }
};
