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
        Schema::create('attribute_values', function (Blueprint $table) { // Red, Green, SM, XL, etc
            $table->id();
            $table->string('value');
            $table->text('description');
            $table->foreignId('attribute_id')->references('id')->on('attributes')->onDelete('cascade'); //->constrained('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropForeign(['attribute_id']);
        });

        Schema::dropIfExists('attribute_values');
    }
};
