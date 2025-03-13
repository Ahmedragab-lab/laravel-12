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
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('product_name');
            $table->string('slug')->unique()->nullable();
            $table->string('expiration_date',100)->nullable();
            $table->double('discount')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('stock')->nullable();

            $table->string('creator',100)->nullable();
            $table->string('sku',100)->nullable();
            $table->string('image',100)->nullable();
            $table->longText('description')->nullable();
            $table->string('code',100)->nullable();

            $table->boolean('is_featured')->default(1);
            $table->boolean('in_stock')->default(1);
            $table->boolean('on_sale')->default(1);
            $table->string('status')->default(1);
            $table->timestamps();
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
