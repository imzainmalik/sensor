<?php

namespace App\Models;

use App\Models\User;
use App\Models\SensorDevice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{

    protected $fillable = ['title','address','phone','user_id','created_at','updated_at'];
    use HasFactory;
    /**
     * Get all of the comments for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sensor_devices()
    {
        return $this->hasOne(SensorDevice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

