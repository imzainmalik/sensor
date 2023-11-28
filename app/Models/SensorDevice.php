<?php

namespace App\Models;

use App\Models\Property;
use App\Models\Appartment;
use App\Models\TrackingsData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorDevice extends Model

{
    
    
    protected $fillable = ['name','sensor_type_id','appartment_id','property_id','device_code','device_detail', 'webhook_url','created_at','updated_at'];
    use HasFactory;
    /**
     * Get the user that owns the SensorDevice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function properties()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    
    public function appartments()
    {
        return $this->belongsTo(Appartment::class,'appartment_id');
    }
    
  
   
}
