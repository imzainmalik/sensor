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
        Schema::create('sensor_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appartment_id')->nullable();
            $table->foreign('appartment_id')->references('id')->on('appartments')->onDelete('cascade');
            $table->unsignedBigInteger('sensor_id')->nullable();
            $table->foreign('sensor_id')->references('id')->on('sensor_devices')->onDelete('cascade');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_levels');
    }
};
