<?php

use App\Enums\DeliveryTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('establishment_id');
            $table->enum('payment_type', PaymentTypeEnum::values());
            $table->enum('delivery_type', DeliveryTypeEnum::values());
            $table->enum('status', OrderStatusEnum::values());
            $table->text('instructions')->nullable();
            $table->string('number');
            $table->string('address');
            $table->string('cancelation_reason')->nullable();
            $table->unique(['establishment_id', 'number']);
            $table->integer('total')->nullable();
            $table->integer('delivery_tax')->nullable();
            $table->integer('total_items')->nullable();
            $table->float('rate')->nullable();
            $table->json('items');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('establishment_id')->references('id')->on('establishments');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
