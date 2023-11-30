<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Appartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $property = null;
        $property_first = property::first();       
        $appartments = Appartment::get(); 
        $users = User::where('role' , 1)->get();
        return view('properties.create', get_defined_vars());
    }   

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'user_id' => 'required',
        ]);
            if($request->id){
               $property = Property::find($request->id);
               $property->title = $validated['title'];
               $property->phone = $validated['phone'];
               $property->address = $validated['address'];
               $property->user_id = $validated['user_id'];
               $property->save();
               $notification = "Property Update Successfully";
            }else{
                Property::create($validated);
                $notification = "Property Create Successfully";
            }
        return redirect()->route('superadmin.dashboard')->with('message', $notification);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    {
        $property_first = property::first();       
        $appartments = Appartment::get(); 
        $property = property::find($id); 
        $users = User::where('role' , 1)->get();
        return view('properties.create', get_defined_vars());
    }   

}
