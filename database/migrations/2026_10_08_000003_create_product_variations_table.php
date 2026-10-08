<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('billing_cycle', ['monthly', 'yearly']);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unique(['product_id', 'billing_cycle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
