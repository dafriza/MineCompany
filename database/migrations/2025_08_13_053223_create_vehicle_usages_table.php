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
        Schema::create('vehicle_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_owner_id');
            $table->foreign('vehicle_owner_id')->references('id')->on('vehicle_owners')->cascadeOnUpdate()->cascadeOnDelete();
            $table->morphs('maintainable'); //antara vehicle order model untuk isi bensin, atau service dengan user model
            $table->integer('value'); //kalau bbm isi liternya, kalau servis isi nilai 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_usages');
    }
};
