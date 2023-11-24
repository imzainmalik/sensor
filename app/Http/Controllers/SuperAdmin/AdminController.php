<?php

namespace App\Http\Controllers\SuperAdmin;

use Carbon\Carbon;
use App\Models\Property;
use Carbon\CarbonPeriod;
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
 
    public function index(Request $request){    
            $property_first = property::first();       
            $appartments = Appartment::get(); 
        return view('superadmin.index',get_defined_vars());
    }
    
    public function property_detail($id, Request $request){   
         $app_property = property::find($id);   
         $appartments = Appartment::where('property_id' , $app_property->id)->get();
        return view('superadmin.index', get_defined_vars());
    }

    public function appartment_detail($id, Request $request){
        

         $appartment = Appartment::find($id);   
        //  dd($appartment->trackings_data()->where('type','temp')->get()->toArray());
         $app_property = Property::find($appartment->property_id); 
         $appartments = Appartment::where('property_id' , $app_property ->id)->get(); 



        return view('superadmin.index', get_defined_vars());
    }

    public function water_ajax(Request $request)
    {
        
        if($request->filter == 'Energy'){
            $devices = SensorDevice::where('sensor_type_id' ,'1');
        }elseif($request->filter == 'Gas'){
            $devices = SensorDevice::where('sensor_type_id' ,'2');
        }else{
            $devices = SensorDevice::where('sensor_type_id' ,'3');
        }
        if($request->property_id != null){
        $devices = $devices->where('property_id', $request->property_id);
        }
        if($request->appartment_id != null){
        $devices = $devices->where('appartment_id', $request->appartment_id);
        }
         $devices = $devices->get()->pluck('id')->toArray();
        $t_records = TrackingsData::where('type','temp')
        ->where('name','Temperature')
        ->where('unit','c')
        ->whereIn('sensor_device_id',$devices);
        if($request->start_date != null){
            $t_records =  $t_records->where('created_at','<=' ,$request->end_date .' 23:59:59')
            ->where('created_at','>=' ,$request->start_date .' 00:00:00');
        }
        $t_records = $t_records->OrderBy('created_at', 'Asc')
        ->get()->toArray();

        $groupedData = [];     
        $averages = [];
        $days = [];
        
          foreach ($t_records as $entry) {
                if($request->days == 'daily'){
                    $day = Carbon::parse($entry['created_at'])->format('M-j-Y');
                }elseif($request->days == 'weekly'){
                    $day = Carbon::parse($entry['created_at'])->startOfWeek()->format('M-j-Y');
                }elseif($request->days == 'monthly'){
                    $day = Carbon::parse($entry['created_at'])->startOfMonth()->format('M-d');
                }
                elseif($request->days == 'yearly'){
                    $day = Carbon::parse($entry['created_at'])->startOfYear()->format('Y');
                }
                $groupedData[$day][] = (float)$entry['value'];
            }


       
        foreach ($groupedData as $day => $values) {
            $average = count($values) > 0 ? array_sum($values) / count($values) : 0;
            $averages[] = number_format($average,2);
            $days[] = $day;
        }





        

        return response()->json(['status' => 1 , 'days' => $days , 'averages'=>$averages ]);
        
    }


}
