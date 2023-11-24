@if(auth()->check())
<div class="panelBox widgets custom_right_box">
    <div class="panel_head bluethemeCol">
       
          
        
        <h3>Properties 
           
            @if(auth()->user()->role == 0)
            <span><a href="{{ route('property.create') }}"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></a></span>
            @endif
        </h3>
        </div>
    <div class="panel_body">
        <ul class="scrollData">
            
           @forelse ($properties as $prop) 
           @if(auth()->user()->role == 0)
           <li><a href="{{ route('property.detail', $prop->id) }}" class="{{isset($app_property->id)  ?  $prop->id ==  $app_property->id ? 'active' : '' : '' }}">
            {{ $prop->title }}
        </a>
    <h6><a href="{{ route('property.edit', $prop->id) }}">Edit</a></h6></li>
        @elseif(auth()->user()->role == 1)
           <li><a href="{{ route('propertyowner.property.detail', $prop->id) }}" class="{{isset($app_property->id)  ?  $prop->id ==  $app_property->id ? 'active' : '' : '' }}">
            {{ $prop->title }}
        </a></li>
        @else
        <li><a href="{{ route('flatowner.property.detail', $prop->id) }}" class="{{isset($app_property->id)  ?  $prop->id ==  $app_property->id ? 'active' : '' : '' }}">
            {{ $prop->title }}
        </a></li>
        {{-- <li><a href="{{ route('property.detail', $prop->id) }}" class="{{isset($app_property->id)  ?  $prop->id ==  $app_property->id ? 'active' : '' : '' }}">
            {{ $prop->title }}
        </a></li> --}}
        @endif
           @empty 
             <li>No Property Found</li>
           @endforelse
         
            {{-- <li>Sunset Apartments</li>
            <li>Deluxe Villas</li>
            <li>Geo Condos</li>
            <li>JBL Properties</li>
            <li>Sunset Apartments</li>
            <li>Deluxe Villas</li>
            <li>Geo Condos</li>
            <li>JBL Properties</li>

            <li>JBL Properties</li>
            <li>Sunset Apartments</li>
            <li>Deluxe Villas</li>
            <li>Geo Condos</li>
            <li>JBL Properties</li>
            <li>Sunset Apartments</li>
            <li>Deluxe Villas</li>
            <li>Geo Condos</li>
            <li>JBL Properties</li>
            
            <li>JBL Properties</li>
            <li>Sunset Apartments</li>
            <li>Deluxe Villas</li>
            <li>Geo Condos</li>
            <li>JBL Properties</li>
            <li>Sunset Apartments</li>
            <li>Deluxe Villas</li>
            <li>Geo Condos</li>
            <li>JBL Properties</li> --}}
        </ul>
    </div>
</div>

<div class="panelBox widgets">
    <div class="panel_head bluethemeCol">
        <h3>Resources</h3>
    </div>
    <div class="panel_body">
        <form action="">
            <li><a href="{{ Request::url().'?filter=Energy'}}" class="{{isset($request['filter'])  ?  $request['filter'] ==  'Energy' ?  'active' : '' : '' }}">
                Energy
            </a></li>
            <li><a href="{{ Request::url().'?filter=Gas'}}" class="{{isset($request['filter'])  ?  $request['filter'] ==  'Gas' ?  'active' : '' : '' }}">
                Gas
            </a></li>
            <li><a href="{{ Request::url().'?filter=Water'}}" class="{{isset($request['filter'])  ?  $request['filter'] ==  'Water' ?  'active' : '' : 'active' }}">
                Water
            </a></li>
            {{-- <div class="form-group">
                <input type="checkbox" id="Water" name="ch" {{isset($request['filter'])  ?  $request['filter'] ==  'Water' ?  'checked' : '' : 'checked' }}>
                <label for="Water" ><a href="{{ Request::url().'?filter=Water'}}">Water</a></label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Energy" name="ch" {{isset($request['filter'])  ?  $request['filter'] ==  'Energy' ?  'checked' : '' : '' }}>
                <label for="Energy"><a href="{{ Request::url().'?filter=Energy'}}">Energy</a></label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Gas" name="ch"  {{isset($request['filter'])  ?  $request['filter'] ==  'Gas' ?  'checked' : '' : '' }}>
                <label for="Gas"><a href="{{ Request::url().'?filter=Water'}}">Gas</a></label>
            </div> --}}
        </form>
    </div>
</div>

{{-- <div class="panelBox widgets">
    <div class="panel_head bluethemeCol">
        <h3>Property Watch</h3>
    </div>
    <div class="panel_body">
        <form action="">
            <div class="form-group">
                <input type="checkbox" id="Water1">
                <label for="Water1">Water</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Energy1">
                <label for="Energy1">Energy</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Gas1">
                <label for="Gas1">Gas</label>
            </div>
        </form>
    </div>
</div> --}}

{{-- <div class="panelBox widgets">
    <div class="panel_head bluethemeCol">
        <h3>Alerts</h3>
    </div>
    <div class="panel_body">
        <form action="">
            <div class="form-group">
                <input type="checkbox" id="Fire">
                <label for="Fire">Fire</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Water2">
                <label for="Water2">Water</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Security">
                <label for="Security">Security</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="Critical">
                <label for="Critical">Critical</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="categories">
                <label for="categories">categories</label>
            </div>
        </form>
    </div>
</div> --}}
{{-- 
<div class="panelBox widgets">
    <div class="panel_head bluethemeCol">
        <h3>Financial Reports</h3>
    </div>
    <div class="panel_body">
        <ul class="">
            <li>Finance reports</li>
            <li>Energy Reports</li>
            <li>Gas Reports</li>
        </ul>
    </div>
</div> --}}
@endif