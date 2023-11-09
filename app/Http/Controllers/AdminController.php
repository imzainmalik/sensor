<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Appartment;
use Illuminate\Http\Request;

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
         $app_property = Property::find($appartment->property_id); 
         $appartments = Appartment::where('property_id' , $app_property ->id)->get(); 



        return view('superadmin.index', compact('appartments', 'appartment', 'app_property' ));
    }
}
