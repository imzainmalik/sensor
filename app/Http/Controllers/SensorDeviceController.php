<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\SensorType;
use App\Models\SensorDevice;
use App\Models\property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SensorDeviceController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $device = null;  
        if(auth()->user()->role == 0){      
            $appartments = Appartment::get();
        }
        else{
            $properties = property::where('user_id', auth()->user()->id )->get();        
            $properties_ids = $properties->pluck('id')->toArray();  
            $property_first = property::where('user_id', auth()->user()->id )->first();         
            $appartments = Appartment::where('property_id', $properties_ids)->get(); 
        }
        $device_types = SensorType::get(); 
        return view('devices.create', get_defined_vars());
    }   

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'device_code' => 'required',
            'appartment_id' => 'required',
            'sensor_type_id' => 'required',
            'device_detail' => 'sometimes',
            'webhook_url' => 'required',

        ]);
            if($request->id){
               $device = SensorDevice::find($request->id);
               $device->name = $validated['name'];
               $device->device_code = $validated['device_code'];
               $device->appartment_id = $validated['appartment_id'];
               $device->sensor_type_id = $validated['sensor_type_id'];
               $device->device_detail = $validated['device_detail'];
               $device->webhook = $validated['webhook'];
               $device->save();
               $notification = "Device Update Successfully";
            }else{
                SensorDevice::create($validated);
                $notification = "Device Create Successfully";
            }

        if(auth()->user()->role == 0){
            return   redirect()->route('superadmin.dashboard')->with('message', $notification);
        }elseif(auth()->user()->role == 1){
            return  redirect()->route('propertyowner.dashboard')->with('message', $notification);
        }else{
            return redirect()->route('flatowner.dashboard')->with('message', $notification);
        }
       
    }
    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    { 
        $appartments = Appartment::get(); 
        $device = SensorDevice::find($id); 
        $device_types = SensorType::get(); 
        return view('devices.create', get_defined_vars());
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SensorDevice $sensorDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorDevice $sensorDevice)
    {
        //
    }
    public function webhook(Request $request, $code)
    {
        
        //
    }
}
