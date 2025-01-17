<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_registration');
            $table->string('phone');
            $table->string('cep');
            $table->string('number');
            $table->string('address');
            $table->string('image');
            $table->string('cover');
            $table->integer('minimum_order_value');
            $table->float('rate');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
