@extends('layouts.app')
@section('content')
    <div class="col-md-7 col-xl-8">
        <div class="row">
            <div class=" col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row crud">
            <div class=" col-md-12">
                @if( $device)
                <h2>Update Device</h2>
                @else
                <h2>Create Device</h2>
                @endif
            </div>
        </div>
        <br>
        <div class="row">
            <div class=" col-md-12">
                @if(auth()->user()->role == 0)
                    <form action="{{route('device.store')}}" method="POST">
                @elseif(auth()->user()->role == 1)
                    <form action="{{route('propertyowner.device.store')}}" method="POST">
                @else
                    <form action="{{route('flatowner.device.store')}}" method="POST">
                @endif
            
                @csrf
                <input type="hidden" class="form-control"  name="id" value="{{ $device ? $device->id : '' }}" placeholder="id">
                  <div class="">
                    <label for="inputText">Name</label>
                    <input type="text" class="form-control" id="inputText" name="name" value="{{ $device ? $device->name : '' }}" placeholder="Name">
                  </div>
                  <br>
                  <div class="">
                    <label for="inputdevice">Device Code</label>
                    <input type="text" class="form-control" id="inputdevice" name="device_code" value="{{ $device ? $device->device_code : '' }}" placeholder="device_code">
                  </div>
                <br>
                <div class="">
                  <label for="inputAddress">Appartment</label>
                  <select  class="form-control" name="appartment_id" id="cars">
                    @foreach ($appartments as $appartment) 
                        <option value="{{ $appartment->id }}" {{ $device ? $device->appartment_id == $appartment->id ? 'selected' : '' : '' }}>{{ $appartment->name }}</option>
                    @endforeach
                  </select>
                </div>
                <br>
                <div class="">
                  <label for="inputAddress">Sensor Type</label>
                  <select  class="form-control" name="sensor_type_id" id="cars">
                    @foreach ($device_types as $device_type) 
                        <option value="{{ $device_type->id }}" {{ $device ? $device->sensor_type_id == $device_type->id ? 'selected' : '' : '' }}>{{ $device_type->name }}</option>
                    @endforeach
                  </select>
                </div>
                <br>
                <div class="">
                  <label for="inputAddress">Device Detail</label>
                  <input type="text" class="form-control" id="inputAddress" name="device_detail"  value="{{ $device ? $device->device_detail : '' }}" placeholder="1234 Main St">
                </div>
                <br>
                <div class="">
                  <label for="webhook">Webhook Url</label>
                  <input type="text" class="form-control" id="webhook" name="webhook_url"  value="{{ $device ? $device->device_detail : '' }}"  placeholder="" readonly >
                </div>
                <br>
                <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    @push ('custum_js') 
        <script>

            $(document).ready(function(){
                var app_url = `{{ config('app.url') }}`
                console.warn(app_url);
            $("#inputdevice").on('input', function(){
                var deviceCode = $(this).val();
            $("#webhook").val(app_url + '/webhook/' + deviceCode);
        });
    });
            
        </script>
    @endpush
@endsection
