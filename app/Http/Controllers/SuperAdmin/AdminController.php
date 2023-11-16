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
