<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('establishments', function (Blueprint $table): void {
            $table->string('category_id')->nullable();
            $table->string('delivery_average_time_min')->nullable();
            $table->string('delivery_average_time_max')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('establishments', function (Blueprint $table): void {
            $table->dropColumn('category_id');
            $table->dropColumn('delivery_average_time_min');
            $table->dropColumn('delivery_average_time_max');
        });
    }
};
