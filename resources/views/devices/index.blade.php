@extends('layouts.app')
@section('content')
    <div class="col-md-7 col-xl-8">
        <div class="row">
            <div class="col-md-12">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol btn-rght">
                        <h3>Device List</h3>
                                    @if(auth()->user()->role == 0)
                                    <a class="edit btn btn-primary btn-sm " href="{{ route('device.create') }}" title="">Add Device</a>
                                    @elseif(auth()->user()->role == 1)
                                    <a class="edit btn btn-primary btn-sm " href="{{ route('propertyowner.device.create') }}" title="">Add Device</a>
                                    @else
                                    <a class="edit btn btn-primary btn-sm " href="{{ route('flatowner.device.create') }}" title="">Add Device</a>
                                    @endif
                    </div>
                    <div class="panel_body">
                            <table class="table table-bordered data-table"  style="color:white;  height:400px; " >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Device Code</th>
                                        <th>Property</th>
                                        <th>Appartment</th>
                                        <th width="50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    @push ('custum_js') 
    <script type="text/javascript">
        $(function () {
       
        if({{ auth()->user()->role }} == 1){
            var route = "{{ route('propertyowner.device.index') }}"
        }else{
            var route = "{{ route('device.index') }}"
        }
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
       
            ajax: route,
            columns: [
                {data: 'name', name: 'name'},
                {data: 'device_code', name: 'device_code'},
                {data: 'property_name', name: 'property_name'},
                {data: 'appartment_name', name: 'appartment_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
            
        });
    </script>
    @endpush
@endsection
