<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('establishment_establishment_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->unsignedBigInteger('establishment_category_id');
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
            $table->foreign('establishment_category_id')->references('id')->on('establishment_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('establishment_establishment_category');
    }
};
