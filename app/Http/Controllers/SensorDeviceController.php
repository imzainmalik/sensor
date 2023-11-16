<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\property;
use App\Models\Appartment;
use App\Models\SensorType;
use App\Models\SensorDevice;
use Illuminate\Http\Request;
use App\Models\TrackingsData;
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
    public function webhook($code , Request $request)
    {
        // $device = SensorDevice::where('device_code', $code)->first();
        // $trackingsdata = TrackingsData::where('sensor_device_id', $device->id)->get()->toArray();
        // dd($trackingsdata);
        $res = '{
                    "event_type": "uplink",
                    "event_data": {
                    "correlation_id": "b638aa9d-4121-40c4-a11a-53e3620f16f6",
                    "device_id": "4968da60-7fe9-11ee-8def-c5f402e436d9",
                    "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
                    "payload": [
                        {
                        "name": "Temperature",
                        "sensor_id": "49973d60-7fe9-11ee-83a2-b1c2b63d0d7b",
                        "type": "temp",
                        "unit": "c",
                        "value": -9.2,
                        "channel": 3,
                        "timestamp": 1699901654589
                        },
                        {
                        "name": "Humidity",
                        "sensor_id": "4998c400-7fe9-11ee-9411-3f2bf165898e",
                        "type": "rel_hum",
                        "unit": "p",
                        "value": 37.3,
                        "channel": 4,
                        "timestamp": 1699901654589
                        },
                        {
                        "name": "Probe",
                        "sensor_id": "49978b80-7fe9-11ee-add4-6943212d3b27",
                        "type": "temp",
                        "unit": "c",
                        "value": -12,
                        "channel": 7,
                        "timestamp": 1699901654589
                        },
                        {
                        "name": "Battery",
                        "sensor_id": "",
                        "type": "batt",
                        "unit": "p",
                        "value": 10,
                        "channel": 5,
                        "timestamp": 1699901654589
                        },
                        {
                        "name": "Battery Voltage",
                        "sensor_id": "",
                        "type": "batt",
                        "unit": "p",
                        "value": 2500,
                        "channel": 500,
                        "timestamp": 1699901654589
                        },
                        {
                        "name": "Low Battery",
                        "sensor_id": "49984ed0-7fe9-11ee-a9f0-f316592cd17e",
                        "type": "low_battery",
                        "unit": "d",
                        "value": 1,
                        "channel": 112,
                        "timestamp": 1699901654589
                        },
                        {
                        "name": "Local Backup",
                        "sensor_id": "49954190-7fe9-11ee-bf93-ad773193810d",
                        "type": "digital_sensor",
                        "unit": "d",
                        "value": 0,
                        "channel": 400,
                        "timestamp": 1699901654589
                        }
                    ],
                    "gateways": [],
                    "fcnt": 0,
                    "fport": 1,
                    "raw_payload": "",
                    "raw_format": "json",
                    "client_id": "ee6a49f0-482f-11ee-a27e-13c1b4e7e92b",
                    "hardware_id": "sim-8a86-bd30-8b0f",
                    "timestamp": 1699901654589,
                    "application_id": "app$cmstest",
                    "device_type_id": "3b521800-7be0-11ed-8599-35b016c2af75",
                    "lora_datarate": 0,
                    "freq": 0
                    },
                    "company": {
                    "id": 35462,
                    "address": "los dasd",
                    "city": "LA",
                    "country": "United States",
                    "created_at": "2023-10-19T00:14:51Z",
                    "industry": "[]",
                    "latitude": 34.05491,
                    "longitude": -118.242645,
                    "name": "Appartment 2",
                    "state": "LA",
                    "status": 0,
                    "timezone": "America/Los_Angeles",
                    "updated_at": "2023-11-10T16:54:42Z",
                    "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
                    "zip": "77381",
                    "external_id": "770"
                    },
                    "location": {
                    "id": 48432,
                    "address": "los dasd",
                    "city": "LA",
                    "country": "United States",
                    "created_at": "2023-10-19T00:14:52Z",
                    "industry": "[]",
                    "latitude": 34.05491,
                    "longitude": -118.242645,
                    "name": "CMS TEAM",
                    "state": "LA",
                    "status": 0,
                    "timezone": "America/Los_Angeles",
                    "updated_at": "2023-10-19T00:14:52Z",
                    "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
                    "zip": "77381",
                    "external_id": "770",
                    "company_id": 35462
                    },
                    "device_type": {
                    "id": "3b521800-7be0-11ed-8599-35b016c2af75",
                    "application_id": "iotinabox",
                    "category": "module",
                    "codec": "lorawan.dragino.lht65.local.backup",
                    "data_type": "",
                    "description": "The Dragino LHT65 Temperature & Humidity sensor is a Long Range LoRaWAN Sensor. It includes a built-in SHT20 Temperature & Humidity sensor and has an external sensor connector to connect to external sensors such as Temperature Sensor, Soil Moisture Sensor, Tilting Sensor, etc. \n\nThe LHT65 allows users to send data and reach extremely long ranges. It provides ultra-long range spread spectrum communication and high interference immunity whilst minimizing current consumption. It targets professional wireless sensor network applications such as irrigation systems, smart metering, smart cities, building automation, and so on. \n\nLHT65 has a built-in 2400mAh non-chargeable battery which can be used for more than 10 years. \n\nLHT65 is full compatible with the LoRaWAN v1.0.2 protocol and works with any standard LoRaWAN gateway.",
                    "manufacturer": "Dragino",
                    "model": "LHT65",
                    "name": "A Dragino LHT65 Temp & Humidity 2.0 (Sample)",
                    "parent_constraint": "NOT_ALLOWED",
                    "proxy_handler": "PrometheusClient",
                    "subcategory": "lora",
                    "transport_protocol": "lorawan",
                    "version": "",
                    "created_at": "2022-12-14T18:50:51Z",
                    "updated_at": "2023-10-24T20:11:00Z"
                    },
                    "device": {
                    "id": 2476535,
                    "thing_name": "Refrigerator",
                    "sensor_use": "Refrigerator",
                    "created_at": "2023-11-10T16:50:43Z",
                    "updated_at": "2023-11-10T16:50:45Z",
                    "status": 0,
                    "external_id": ""
                    }
                }';
            $response = json_decode($res);
           
            if($response->event_type == 'uplink'){
                $flat_id = 3;
                // dd($response->event_data->hardware_id, 'sim-8a86-bd30-c4a3');
                $device = SensorDevice::where('device_code', $response->event_data->hardware_id)->first();
                // dd($device);
                if($device)
                  {
                    $data = $response->event_data;
                    foreach($data->payload as $item ){
                       $trackingsdata = TrackingsData::create([
                            'name' => 	$item->name,
                            'value' =>	$item->value,
                            'type' =>	$item->type,
                            'unit'=>	$item->unit,
                            'sensor_device_id'=>	$device->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s e'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s e'),
                        ]);

                    }   
                }
            }elseif($response->event_type == 'alert'){

            }else{
            }


        //
    }
}
