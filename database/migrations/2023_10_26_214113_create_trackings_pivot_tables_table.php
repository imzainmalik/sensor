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
        Schema::create('trackings_pivot_tables', function (Blueprint $table) {
       
            $table->id();
            $table->unsignedBigInteger('sensor_device_id');
            $table->unsignedBigInteger('appartment_id');
            $table->unsignedBigInteger('tracking_data_id');
            $table->foreign('sensor_device_id')->references('id')->on('sensor_devices')->onDelete('cascade');
            $table->foreign('appartment_id')->references('id')->on('appartments')->onDelete('cascade');
            $table->foreign('tracking_data_id')->references('id')->on('trackings_data')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings_pivot_tables');
    }
};
