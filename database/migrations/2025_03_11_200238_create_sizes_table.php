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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('slug',100)->nullable();
            $table->string('creator',100)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::create('product_size', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('size_id');
            $table->integer('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('product_size');
    }
};
