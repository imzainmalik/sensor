<?php

namespace App\Models;

use App\Models\SensorDevice;
use App\Models\TrackingsData;
use App\Models\TrackingsPivotTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appartment extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function sensor_devices()
    {
        return $this->hasOne(SensorDevice::class ,'sensor_device_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
