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
        Schema::create('attribute_value_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->references('id')->on('variants')->onDelete('cascade'); //->constrained('products')->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade'); //->constrained('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attribute_value_variant', function (Blueprint $table) {
            $table->dropForeign(['variant_id']);
            $table->dropForeign(['attribute_value_id']);
        });

        Schema::dropIfExists('attribute_value_variant');
    }
};
