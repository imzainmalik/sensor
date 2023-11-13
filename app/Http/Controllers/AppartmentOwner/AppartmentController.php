<?php

namespace App\Http\Controllers\AppartmentOwner;

use App\Models\Property;
use App\Models\Appartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(){
            $properties = property::where('user_id', auth()->user()->id )->get();        
            $properties_ids = $properties->pluck('id')->toArray();  
            $property_first = property::where('user_id', auth()->user()->id )->first();         
            $appartments = Appartment::where('property_id', $properties_ids)->get(); 
    
        return view('appartment.index',compact('appartments', 'property_first', 'properties'));
    }
    
    public function property_detail($id){   
         $properties = property::where('user_id', auth()->user()->id )->get();     
         $app_property = property::find($id);   
         $appartments = Appartment::where('property_id' , $app_property->id)->get();
        return view('appartment.index', compact('appartments', 'app_property', 'properties' ));
    }

    public function appartment_detail($id){
        
        $properties = property::where('user_id', auth()->user()->id )->get();  
         $appartment = Appartment::find($id);   
         $app_property = Property::find($appartment->property_id); 
         $appartments = Appartment::where('property_id' , $app_property ->id)->get(); 
        return view('property.index', compact('appartments', 'appartment', 'app_property' ,'properties'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
