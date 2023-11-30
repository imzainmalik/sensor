@extends('layouts.app')
@section('content')
    <div class="col-md-7 col-xl-8">

        <div class="row">
            <div class="col-md-12">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol btn-rght">
                        @if( $appartment)
                        <h3>Update Appartment</h3>
                        @else
                        <h3>Create Appartment</h3>
                        @endif
                    </div>
                    <div class="panel_body">
                        <div class="row">
                            <div class=" col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>* {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <br>
                        <div class="row">
                            <div class=" col-md-12">
                            @if(auth()->user()->role == 0)
                            <form action="{{route('appartment.store')}}" method="POST">
                            @elseif(auth()->user()->role == 1)
                            <form action="{{route('propertyowner.appartment.store')}}" method="POST">
                            @else
                
                            @endif
                            
                                @csrf
                                <input type="hidden" class="form-control"  name="id" value="{{ $appartment ? $appartment->id : '' }}" placeholder="id">
                              
                                  <div class="">
                                    <label for="inputText">Name</label>
                                    <input type="text" class="form-control" id="inputText" name="name" value="{{ $appartment ? $appartment->name : '' }}" placeholder="Name">
                                  </div>
                                <br>
                                <div class="">
                                  <label for="inputAddress">Appartment Onwer</label>
                                  <select  class="form-control" name="user_id" id="cars">
                                    @foreach ($users as $user) 
                                        <option value="{{ $user->id }}" {{ $appartment ? $appartment->user_id == $user->id ? 'selected' : '' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                  </select>
                                  {{-- <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St"> --}}
                                </div>
                                <br>
                                <div class="">
                                  <label for="inputAddress">Property</label>
                                  <select  class="form-control" name="property_id" id="cars">
                
                                    @foreach ($properties as $property) 
                                        <option value="{{ $property->id }}" {{ $appartment ? $appartment->property_id == $property->id ? 'selected' : '' : '' }}>{{ $property->title }}</option>
                                    @endforeach
                                  </select>
                                  {{-- <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St"> --}}
                                </div>
                                <br>
                                <div class="">
                                  <label for="inputAddress">Address</label>
                                  <input type="text" class="form-control" id="inputAddress" name="address"  value="{{ $appartment ? $appartment->address : '' }}" placeholder="1234 Main St">
                                </div>
                                <br>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                
                                </div>
                              
                              </form>
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
@endsection
