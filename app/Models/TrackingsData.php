<?php

namespace App\Models;

use App\Models\Appartment;
use App\Models\SensorDevice;
use App\Models\TrackingsPivotTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrackingsData extends Model
{
    use HasFactory;
 
    protected $fillable = ['name', 'value', 'type', 'unit_id', 'unit', 'created_at', 'updated_at'];

  
}


