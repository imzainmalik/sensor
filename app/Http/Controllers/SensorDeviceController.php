<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Mail;
use App\Models\Alert;
use App\Models\property;
use App\Models\Appartment;
use App\Models\SensorType;
use App\Models\SensorDevice;
use Illuminate\Http\Request;
use App\Models\TrackingsData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;    


class SensorDeviceController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    
      
        if ($request->ajax()) {
          if(auth()->user()->role == 0){
            $data = SensorDevice::get();
          }else{
           $porp  = Property::where('user_id', auth()->user()->id)->get()->pluck('id');
           $data = SensorDevice::whereIn('property_id',$porp)->get();
       
          }
          
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->addColumn('property_name', function($row){
                   
                          $property_name = $row->properties ? $row->properties->title : 'None';
                          return $property_name;
                  })
                  ->addColumn('appartment_name', function($row){

                          $appartment_name = $row ? $row->appartments->name : 'None';
                          return $appartment_name;
                  })
                  ->addColumn('action', function($row){
                                    if(auth()->user()->role == 0){
                                      $btn = '<a class="edit btn btn-primary btn-sm " href="'. route('device.edit',[$row->id]) .'" title="">Edit</a>';
                                    }elseif(auth()->user()->role == 1){
                                      $btn = '<a class="edit btn btn-primary btn-sm " href="'. route('propertyowner.device.edit',[$row->id]) .'" title="">Edit</a>';
                                    }else{
                                      $btn = '<a class="edit btn btn-primary btn-sm " href="'. route('flatowner.device.edit',[$row->id]) .'" title="">Edit</a>';
                                    }
                                  
                          return $btn;
                  })
                  ->rawColumns(['property_name','appartment_name','action'])
                  ->make(true);
      }
    //   if(auth()->user()->role == 0){
    //     return   redirect()->route('superadmin.dashboard')->with('message', $notification);
    // }elseif(auth()->user()->role == 1){
    //     return  redirect()->route('propertyowner.dashboard')->with('message', $notification);
    // }else{
    //     return redirect()->route('flatowner.dashboard')->with('message', $notification);
    // }
      return view('devices.index',get_defined_vars());
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
            $appartment = Appartment::find($validated['appartment_id']);
            if($request->id){
               $device = SensorDevice::find($request->id);
               $device->name = $validated['name'];
               $device->device_code = $validated['device_code'];
               $device->appartment_id = $validated['appartment_id'];
               $device->property_id = $appartment->property_id;
               $device->sensor_type_id = $validated['sensor_type_id'];
               $device->device_detail = $validated['device_detail'];
               $device->webhook_url = $validated['webhook_url'];
               $device->save();
               $notification = "Device Update Successfully";
            }else{
                $device = new SensorDevice();
                $device->name = $validated['name'];
                $device->device_code = $validated['device_code'];
                $device->appartment_id = $validated['appartment_id'];
                $device->property_id = $appartment->property_id;
                $device->sensor_type_id = $validated['sensor_type_id'];
                $device->device_detail = $validated['device_detail'];
                $device->webhook_url = $validated['webhook_url'];
                $device->save();
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
        // $res = '{
        //             "event_type": "uplink",
        //             "event_data": {
        //             "correlation_id": "b638aa9d-4121-40c4-a11a-53e3620f16f6",
        //             "device_id": "4968da60-7fe9-11ee-8def-c5f402e436d9",
        //             "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
        //             "payload": [
        //                 {
        //                 "name": "Temperature",
        //                 "sensor_id": "49973d60-7fe9-11ee-83a2-b1c2b63d0d7b",
        //                 "type": "temp",
        //                 "unit": "c",
        //                 "value": -9.2,
        //                 "channel": 3,
        //                 "timestamp": 1699901654589
        //                 },
        //                 {
        //                 "name": "Humidity",
        //                 "sensor_id": "4998c400-7fe9-11ee-9411-3f2bf165898e",
        //                 "type": "rel_hum",
        //                 "unit": "p",
        //                 "value": 37.3,
        //                 "channel": 4,
        //                 "timestamp": 1699901654589
        //                 },
        //                 {
        //                 "name": "Probe",
        //                 "sensor_id": "49978b80-7fe9-11ee-add4-6943212d3b27",
        //                 "type": "temp",
        //                 "unit": "c",
        //                 "value": -12,
        //                 "channel": 7,
        //                 "timestamp": 1699901654589
        //                 },
        //                 {
        //                 "name": "Battery",
        //                 "sensor_id": "",
        //                 "type": "batt",
        //                 "unit": "p",
        //                 "value": 10,
        //                 "channel": 5,
        //                 "timestamp": 1699901654589
        //                 },
        //                 {
        //                 "name": "Battery Voltage",
        //                 "sensor_id": "",
        //                 "type": "batt",
        //                 "unit": "p",
        //                 "value": 2500,
        //                 "channel": 500,
        //                 "timestamp": 1699901654589
        //                 },
        //                 {
        //                 "name": "Low Battery",
        //                 "sensor_id": "49984ed0-7fe9-11ee-a9f0-f316592cd17e",
        //                 "type": "low_battery",
        //                 "unit": "d",
        //                 "value": 1,
        //                 "channel": 112,
        //                 "timestamp": 1699901654589
        //                 },
        //                 {
        //                 "name": "Local Backup",
        //                 "sensor_id": "49954190-7fe9-11ee-bf93-ad773193810d",
        //                 "type": "digital_sensor",
        //                 "unit": "d",
        //                 "value": 0,
        //                 "channel": 400,
        //                 "timestamp": 1699901654589
        //                 }
        //             ],
        //             "gateways": [],
        //             "fcnt": 0,
        //             "fport": 1,
        //             "raw_payload": "",
        //             "raw_format": "json",
        //             "client_id": "ee6a49f0-482f-11ee-a27e-13c1b4e7e92b",
        //             "hardware_id": "sim-8a86-bd30-8b0f",
        //             "timestamp": 1699901654589,
        //             "application_id": "app$cmstest",
        //             "device_type_id": "3b521800-7be0-11ed-8599-35b016c2af75",
        //             "lora_datarate": 0,
        //             "freq": 0
        //             },
        //             "company": {
        //             "id": 35462,
        //             "address": "los dasd",
        //             "city": "LA",
        //             "country": "United States",
        //             "created_at": "2023-10-19T00:14:51Z",
        //             "industry": "[]",
        //             "latitude": 34.05491,
        //             "longitude": -118.242645,
        //             "name": "Appartment 2",
        //             "state": "LA",
        //             "status": 0,
        //             "timezone": "America/Los_Angeles",
        //             "updated_at": "2023-11-10T16:54:42Z",
        //             "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
        //             "zip": "77381",
        //             "external_id": "770"
        //             },
        //             "location": {
        //             "id": 48432,
        //             "address": "los dasd",
        //             "city": "LA",
        //             "country": "United States",
        //             "created_at": "2023-10-19T00:14:52Z",
        //             "industry": "[]",
        //             "latitude": 34.05491,
        //             "longitude": -118.242645,
        //             "name": "CMS TEAM",
        //             "state": "LA",
        //             "status": 0,
        //             "timezone": "America/Los_Angeles",
        //             "updated_at": "2023-10-19T00:14:52Z",
        //             "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
        //             "zip": "77381",
        //             "external_id": "770",
        //             "company_id": 35462
        //             },
        //             "device_type": {
        //             "id": "3b521800-7be0-11ed-8599-35b016c2af75",
        //             "application_id": "iotinabox",
        //             "category": "module",
        //             "codec": "lorawan.dragino.lht65.local.backup",
        //             "data_type": "",
        //             "description": "The Dragino LHT65 Temperature & Humidity sensor is a Long Range LoRaWAN Sensor. It includes a built-in SHT20 Temperature & Humidity sensor and has an external sensor connector to connect to external sensors such as Temperature Sensor, Soil Moisture Sensor, Tilting Sensor, etc. \n\nThe LHT65 allows users to send data and reach extremely long ranges. It provides ultra-long range spread spectrum communication and high interference immunity whilst minimizing current consumption. It targets professional wireless sensor network applications such as irrigation systems, smart metering, smart cities, building automation, and so on. \n\nLHT65 has a built-in 2400mAh non-chargeable battery which can be used for more than 10 years. \n\nLHT65 is full compatible with the LoRaWAN v1.0.2 protocol and works with any standard LoRaWAN gateway.",
        //             "manufacturer": "Dragino",
        //             "model": "LHT65",
        //             "name": "A Dragino LHT65 Temp & Humidity 2.0 (Sample)",
        //             "parent_constraint": "NOT_ALLOWED",
        //             "proxy_handler": "PrometheusClient",
        //             "subcategory": "lora",
        //             "transport_protocol": "lorawan",
        //             "version": "",
        //             "created_at": "2022-12-14T18:50:51Z",
        //             "updated_at": "2023-10-24T20:11:00Z"
        //             },
        //             "device": {
        //             "id": 2476535,
        //             "thing_name": "Refrigerator",
        //             "sensor_use": "Refrigerator",
        //             "created_at": "2023-11-10T16:50:43Z",
        //             "updated_at": "2023-11-10T16:50:45Z",
        //             "status": 0,
        //             "external_id": ""
        //             }
        //         }';

                $res = '{
                    "event_type": "alert",
                    "event_data": {
                      "correlation_id": "3ed8da60-7566-4681-bef2-210979ba505d",
                      "userId": "38375d20-899d-42cd-8d5a-733060e4235c",
                      "applicationId": "app$cmstest",
                      "clientId": "ee6a49f0-482f-11ee-a27e-13c1b4e7e92b",
                      "thingId": "8fd172d0-742e-11ee-b9f2-219eb6edfac3",
                      "sensorId": "8ffcc890-742e-11ee-a5da-579bcf7b39d1",
                      "channel": "3",
                      "ruleId": "ceaa2c6f-67a2-4b50-8da2-1a1412ddd968",
                      "eventType": "alert-state-changed",
                      "totalTriggered": 4,
                      "hardwareId": "sim-8258-b373-1797",
                      "triggered": true,
                      "value": "15.440000000000001",
                      "timestamp": "1700862262613",
                      "triggerData": {
                        "delay": {
                          "count": 1,
                          "time": 600000
                        },
                        "trigger_reading": 15.440000000000001,
                        "trigger_type": "trigger",
                        "trigger_unit": "f",
                        "triggers": [
                          {
                            "conditions": [
                              {
                                "operator": "lt",
                                "value": 32
                              }
                            ],
                            "trigger_reading": 15.440000000000001,
                            "trigger_unit": "f",
                            "triggers_combination": "OR"
                          }
                        ],
                        "triggers_combination": "OR"
                      },
                      "title": "Refrigerator Temperature Alert"
                    },
                    "company": {
                      "id": 33368,
                      "address": "7421 Laurel Canyon Blvd STE18",
                      "city": "North Hollywood",
                      "country": "United States",
                      "created_at": "2023-08-31T18:57:48Z",
                      "industry": "\"[]\"",
                      "latitude": 34.20549,
                      "longitude": -118.397,
                      "name": "Example Company",
                      "state": "CA",
                      "status": 0,
                      "timezone": "America/Los_Angeles",
                      "updated_at": "2023-08-31T18:57:48Z",
                      "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
                      "zip": "91605",
                      "external_id": ""
                    },
                    "location": {
                      "id": 45939,
                      "address": "7421 Laurel Canyon Blvd STE18",
                      "city": "North Hollywood",
                      "country": "United States",
                      "created_at": "2023-08-31T18:57:49Z",
                      "industry": "\"[]\"",
                      "latitude": 34.20549,
                      "longitude": -118.397,
                      "name": "Example Location",
                      "state": "CA",
                      "status": 0,
                      "timezone": "America/Los_Angeles",
                      "updated_at": "2023-08-31T18:57:49Z",
                      "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
                      "zip": "91605",
                      "external_id": "",
                      "company_id": 33368
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
                      "id": 2354888,
                      "thing_name": "Refrigerator",
                      "sensor_use": "Refrigerator",
                      "created_at": "2023-10-26T18:36:22Z",
                      "updated_at": "2023-10-26T18:36:25Z",
                      "status": 0,
                      "external_id": ""
                    }
                  }';
            $response = json_decode($res);
              
                if($response->event_type == 'uplink'){
                   
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
                    $device = SensorDevice::where('device_code', $response->event_data->hardwareId)->first();
                    // dd($device->properties->user->email, $device->appartments->user->email);
                      if($device)
                      {
                        $alert = Alert::Where('senor_device_id', $device->id)->first();
                        $data = [];
                        if($alert){
                            $alert->title = $response->event_data->title;
                            $alert->value = $response->event_data->triggerData->trigger_reading;
                            $alert->unit = $response->event_data->triggerData->trigger_unit;
                            $alert->save();
                        }else{
                          $alert = new Alert();
                          $alert->title = $response->event_data->title;
                          $alert->senor_device_id =  $device->id;
                          $alert->value = $response->event_data->triggerData->trigger_reading;
                          $alert->unit = $response->event_data->triggerData->trigger_unit;
                          $alert->save();
                        }
                        $data['device'] = $device->toArray();
                        $data['alert'] = $alert->toArray();
                        Mail::to('developerlegendesk@gmail.com')->send(new \App\Mail\AlertMail($data));
                      }
                }else{
                }


        //
    }
}
