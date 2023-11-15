<?php

namespace App\Http\Controllers\SuperAdmin;

use Carbon\Carbon;
use App\Models\Property;
use App\Models\Appartment;
use App\Models\SensorDevice;
use Illuminate\Http\Request;
use App\Models\TrackingsData;
use App\Models\TrackingsPivotTable;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(){    
    // $res = '{
    //             "event_type": "uplink",
    //             "event_data": {
    //                 "correlation_id": "46943bf6-1486-4b0f-899c-60267f9f2a60",
    //                 "device_id": "cf797970-6e14-11ee-92c7-89e830bbaf98",
    //                 "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
    //                 "payload": 
    //                 [
    //                     {
    //                         "name": "",
    //                         "sensor_id": "",
    //                         "type": "digital",
    //                         "unit": "ping",
    //                         "value": 1641576066888,
    //                         "channel": "ping",
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Dry Air",
    //                         "sensor_id": "cfa96310-6e14-11ee-ba36-3df1cdcb8a07",
    //                         "type": "air_analysis",
    //                         "unit": "null",
    //                         "value": 0,
    //                         "channel": 500,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "High Humidity",
    //                         "sensor_id": "cfa9d840-6e14-11ee-80fa-ef2c5fdf3196",
    //                         "type": "air_analysis",
    //                         "unit": "null",
    //                         "value": 6,
    //                         "channel": 501,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "High Temperature and Humidity",
    //                         "sensor_id": "cfa9ff50-6e14-11ee-92c7-89e830bbaf98",
    //                         "type": "air_analysis",
    //                         "unit": "null",
    //                         "value": 0,
    //                         "channel": 502,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Optimal Air Range",
    //                         "sensor_id": "cfa93c00-6e14-11ee-9c59-55514ecea568",
    //                         "type": "air_analysis",
    //                         "unit": "null",
    //                         "value": 8,
    //                         "channel": 503,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Temperature Min",
    //                         "sensor_id": "cfab37d0-6e14-11ee-af7c-3dc077ba0705",
    //                         "type": "temp",
    //                         "unit": "c",
    //                         "value": 21,
    //                         "channel": 504,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Temperature Max",
    //                         "sensor_id": "cfae6c20-6e14-11ee-a407-aff5d50e226f",
    //                         "type": "temp",
    //                         "unit": "c",
    //                         "value": 21.6,
    //                         "channel": 505,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Temperature Average",
    //                         "sensor_id": "cfad33a0-6e14-11ee-995e-dd053e91129b",
    //                         "type": "temp",
    //                         "unit": "c",
    //                         "value": 21.2,
    //                         "channel": 506,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Relative Humidity Min",
    //                         "sensor_id": "cfada8d0-6e14-11ee-ba36-3df1cdcb8a07",
    //                         "type": "rel_hum",
    //                         "unit": "p",
    //                         "value": 58,
    //                         "channel": 507,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Relative Humidity Max",
    //                         "sensor_id": "cfabd410-6e14-11ee-b2c5-fba17df03d69",
    //                         "type": "rel_hum",
    //                         "unit": "p",
    //                         "value": 72.5,
    //                         "channel": 508,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Relative Humidity Average",
    //                         "sensor_id": "cfaa9b90-6e14-11ee-9526-0b3c82cefe0e",
    //                         "type": "rel_hum",
    //                         "unit": "p",
    //                         "value": 66,
    //                         "channel": 509,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Good Level Hygrothermal Comfort Index",
    //                         "sensor_id": "cfb549f0-6e14-11ee-9ebe-a980f77f0c63",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 1,
    //                         "channel": 510,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Medium Level Hygrothermal Comfort Index",
    //                         "sensor_id": "cfb4d4c0-6e14-11ee-8c5b-ab21f0efe678",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 1,
    //                         "channel": 511,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Bad Level Hygrothermal Comfort Index",
    //                         "sensor_id": "cfb6d090-6e14-11ee-87e2-c71614633e34",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 1,
    //                         "channel": 512,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "IAQ Global",
    //                         "sensor_id": "cfada8d0-6e14-11ee-b721-510c764cde89",
    //                         "type": "air_qua",
    //                         "unit": "null",
    //                         "value": 3,
    //                         "channel": 513,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "IAQ Source",
    //                         "sensor_id": "cfae9330-6e14-11ee-92c7-89e830bbaf98",
    //                         "type": "analog_sensor",
    //                         "unit": "null",
    //                         "value": 2,
    //                         "channel": 514,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Smoke Alarm Status",
    //                         "sensor_id": "cfafa4a0-6e14-11ee-b721-510c764cde89",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 0,
    //                         "channel": 515,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Sensor Fault Mode",
    //                         "sensor_id": "cfb263c0-6e14-11ee-8c5b-ab21f0efe678",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 0,
    //                         "channel": 519,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Smoke ALarm Condition Analysis",
    //                         "sensor_id": "cfb28ad0-6e14-11ee-9ebe-a980f77f0c63",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 0,
    //                         "channel": 516,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Device End Of Life",
    //                         "sensor_id": "cfafa4a0-6e14-11ee-9c59-55514ecea568",
    //                         "type": "time",
    //                         "unit": "months",
    //                         "value": 120,
    //                         "channel": 518,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Battery Status",
    //                         "sensor_id": "cfb34e20-6e14-11ee-87e2-c71614633e34",
    //                         "type": "digital_sensor",
    //                         "unit": "d",
    //                         "value": 100,
    //                         "channel": 517,
    //                         "timestamp": 1699903192412
    //                     },
    //                     {
    //                         "name": "Battery",
    //                         "sensor_id": "cfaf7d90-6e14-11ee-80fa-ef2c5fdf3196",
    //                         "type": "batt",
    //                         "unit": "p",
    //                         "value": 100,
    //                         "channel": 5,
    //                         "timestamp": 1699903192412
    //                     }
    //                 ],
    //                 "gateways": [],
    //                 "fcnt": 0,
    //                 "fport": 1,
    //                 "raw_payload": "",
    //                 "raw_format": "json",
    //                 "client_id": "ee6a49f0-482f-11ee-a27e-13c1b4e7e92b",
    //                 "hardware_id": "sim-8a86-bd30-c4a3",
    //                 "timestamp": 1699903192412,
    //                 "application_id": "app$cmstest",
    //                 "device_type_id": "fac57830-7c2d-11eb-864a-93f10e39aa87",
    //                 "lora_datarate": 0,
    //                 "freq": 0
    //             },
    //             "company": {
    //                 "id": 35462,
    //                 "address": "los dasd",
    //                 "city": "LA",
    //                 "country": "United States",
    //                 "created_at": "2023-10-19T00:14:51Z",
    //                 "industry": "[]",
    //                 "latitude": 34.05491,
    //                 "longitude": -118.242645,
    //                 "name": "Appartment 2",
    //                 "state": "LA",
    //                 "status": 0,
    //                 "timezone": "America/Los_Angeles",
    //                 "updated_at": "2023-11-10T16:54:42Z",
    //                 "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
    //                 "zip": "77381",
    //                 "external_id": "770"
    //             },
    //             "location": {
    //                 "id": 48432,
    //                 "address": "los dasd",
    //                 "city": "LA",
    //                 "country": "United States",
    //                 "created_at": "2023-10-19T00:14:52Z",
    //                 "industry": "[]",
    //                 "latitude": 34.05491,
    //                 "longitude": -118.242645,
    //                 "name": "CMS TEAM",
    //                 "state": "LA",
    //                 "status": 0,
    //                 "timezone": "America/Los_Angeles",
    //                 "updated_at": "2023-10-19T00:14:52Z",
    //                 "user_id": "38375d20-899d-42cd-8d5a-733060e4235c",
    //                 "zip": "77381",
    //                 "external_id": "770",
    //                 "company_id": 35462
    //             },
    //             "device_type": {
    //                 "id": "fac57830-7c2d-11eb-864a-93f10e39aa87",
    //                 "application_id": "iotinabox",
    //                 "category": "module",
    //                 "codec": "lorawan.nexelex.insafe.origin",
    //                 "data_type": "",
    //                 "description": "is a new generation connected smoke detector that also comes with ambient temperature and relative humidity sensors. Origin is not a simple smoke detector. Thanks to its edge computing architecture and IZIAIR embedded algorithm, INSAFE+ Origin calculates an indoor air quality index to help you take the appropriate actions. Origin is an ideal product for connected homes and residential buildings.",
    //                 "manufacturer": "Nexelec",
    //                 "model": "Insafe+ Origin (Sigfox)",
    //                 "name": "Nexelec Origin Sigfox Smoke Detector (EN V1)",
    //                 "parent_constraint": "NOT_ALLOWED",
    //                 "proxy_handler": "PrometheusClient",
    //                 "subcategory": "lora",
    //                 "transport_protocol": "lorawan",
    //                 "version": "",
    //                 "created_at": "2021-03-03T14:37:28Z",
    //                 "updated_at": "2023-10-24T20:11:00Z"
    //             },
    //             "device": {
    //                 "id": 2240986,
    //                 "thing_name": "Others",
    //                 "sensor_use": "Smart Building",
    //                 "created_at": "2023-10-19T00:16:55Z",
    //                 "updated_at": "2023-10-19T00:19:44Z",
    //                 "status": 0,
    //                 "external_id": ""
    //             }
    //         }';
    //         $response = json_decode($res);
           
    //         if($response->event_type == 'uplink'){
    //             $flat_id = 1;

    //             $device = SensorDevice::where('device_code', $response->event_data->hardware_id)->first();
                
    //             if($device)
    //               {
    //                 $data = $response->event_data;
    //                 foreach($data->payload as $item ){
    //                    $trackingsdata = TrackingsData::create([
    //                         'name' => 	$item->name,
    //                         'value' =>	$item->value,
    //                         'type' =>	$item->type,
    //                         'unit'=>	$item->unit,
    //                         'sensor_device_id'=>	$device->id,
    //                         'created_at' => Carbon::now()->format('Y-m-d H:i:s e'),
    //                         'updated_at' => Carbon::now()->format('Y-m-d H:i:s e'),
    //                     ]);

    //                 }   
    //             }
    //         }
            $property_first = property::first();       
            $appartments = Appartment::get(); 
        return view('superadmin.index',compact('appartments', 'property_first'));
    }
    
    public function property_detail($id){   
         $app_property = property::find($id);   
         $appartments = Appartment::where('property_id' , $app_property->id)->get();
        return view('superadmin.index', compact('appartments', 'app_property' ));
    }

    public function appartment_detail($id){
        

         $appartment = Appartment::find($id);   
        //  dd($appartment->trackings_data()->where('type','temp')->get()->toArray());
         $app_property = Property::find($appartment->property_id); 
         $appartments = Appartment::where('property_id' , $app_property ->id)->get(); 



        return view('superadmin.index', compact('appartments', 'appartment', 'app_property' ));
    }



}
