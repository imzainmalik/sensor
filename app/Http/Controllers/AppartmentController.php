<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Appartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppartmentController extends Controller
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
        $appartment = null;
        if(auth()->user()->role == 0){
            $property_first = property::first();       
            $appartments = Appartment::get();
        }
        else{
            $properties = property::where('user_id', auth()->user()->id )->get();        
            $properties_ids = $properties->pluck('id')->toArray();  
            $property_first = property::where('user_id', auth()->user()->id )->first();         
            $appartments = Appartment::where('property_id', $properties_ids)->get(); 
        }

        return view('appartments.create', get_defined_vars());
    }   

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'property_id' => 'required',
        ]);
            if($request->id){
               $appartment = Appartment::find($request->id);
               $appartment->name = $validated['name'];
               $appartment->address = $validated['address'];
               $appartment->property_id = $validated['property_id'];
               $appartment->save();
               $notification = "Appartment Update Successfully";
            }else{
                Appartment::create($validated);
                $notification = "Appartment Create Successfully";
            }
        # code...
        if(auth()->user()->role == 0){
            return redirect()->route('superadmin.dashboard')->with('message',$notification);
        }else{
            return redirect()->route('propertyowner.dashboard')->with('message',$notification);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    { 
        if(auth()->user()->role == 0){      
            $appartments = Appartment::get();
        }
        else{
            $properties = property::where('user_id', auth()->user()->id )->get();        
            $properties_ids = $properties->pluck('id')->toArray();  
            $property_first = property::where('user_id', auth()->user()->id )->first();         
            $appartments = Appartment::where('property_id', $properties_ids)->get(); 
        }

       
        $appartment = Appartment::find($id); 
        return view('appartments.create', get_defined_vars());
    }   


    /**
     * Display the specified resource.
     */
    public function show(Appartment $appartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appartment $appartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appartment $appartment)
    {
        //
    }
}
