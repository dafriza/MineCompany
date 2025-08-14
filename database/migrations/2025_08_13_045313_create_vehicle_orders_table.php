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
        Schema::create('vehicle_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 10);
            $table->unsignedBigInteger('vehicle_owner_id');
            $table->foreign('vehicle_owner_id')->references('id')->on('vehicle_owners')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->tinyInteger('status')->comment('1 => propose, 2 => approve spv, 3 => approve manager, 4 => approve poolManagement, 5 => approve, 6 => borrowed, 7 => done, 8 => rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_orders');
    }
};
