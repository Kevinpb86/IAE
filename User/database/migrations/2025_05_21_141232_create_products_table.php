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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('category')->nullable();
            $table->string('image_url')->nullable();
            $table->string('sku')->unique()->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['status', 'created_at']);
            $table->index(['category']);
            $table->index(['stock']);
            $table->index(['name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};