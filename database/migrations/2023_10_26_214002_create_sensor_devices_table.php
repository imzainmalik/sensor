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
        Schema::create('sensor_devices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('sensor_type_id');
            $table->unsignedBigInteger('appartment_id');
            $table->unsignedBigInteger('property_id');
            $table->string('device_code')->nullable();
            $table->string('device_detail')->nullable();
            $table->string('webhook_url')->nullable();
            $table->timestamps();
            $table->foreign('sensor_type_id')->references('id')->on('sensor_types')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('appartment_id')->references('id')->on('appartments')->onDelete('cascade');
        });
    }

  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_devices');
    }
};
