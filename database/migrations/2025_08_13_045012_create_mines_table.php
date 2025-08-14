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
        Schema::create('mines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('telephone', 14);
            $table->string('address');
            $table->char('province_id', 2)->collation('utf8_unicode_ci');
            $table->char('regency_id', 4)->collation('utf8_unicode_ci');
            $table->char('district_id', 7)->collation('utf8_unicode_ci');
            $table->char('village_id', 10)->collation('utf8_unicode_ci');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('branch_office_id');
            $table->foreign('province_id')->references('id')->on('provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('regency_id')->references('id')->on('regencies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('district_id')->references('id')->on('districts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('village_id')->references('id')->on('villages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('branch_office_id')->references('id')->on('branch_offices')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mines');
    }
};
