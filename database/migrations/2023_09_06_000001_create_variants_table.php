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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('description')->nullable();
            $table->decimal('price', 6,2);
            $table->integer('stock');

            $table->string('colour');
            $table->string('size');

            $table->foreignID('product_id')->references('id')->on('products')->onDelete('cascade'); //->constrained('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('variants');
    }
};
