
       @if(auth()->check())
<div class="rightbx">
    <div class="panel_head bluethemeCol btn-rght">
        <h3>Appartments</h3>
            @if(auth()->user()->role == 0)
            <span><a href="{{ route('appartment.create') }}" class="edit btn btn-success btn-sm "><i class="fa fa-plus" aria-hidden="true"></i></a></span>
            @elseif(auth()->user()->role == 1)
            <span><a href="{{ route('propertyowner.appartment.create') }}" class="edit btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
            @else
            @endif
        {{-- Canvas --}}
    </div>
    <ul class="listbtn">
        @forelse ($appartments as $appart) 
            @if (  auth()->user()->role == 0) 
                <li class="btn-rght">
                    <a href="{{ route('appartment.detail', $appart->id) }}" class="{{ isset($appartment->id) ? $appart->id == $appartment->id ? 'active' : '' : ''}} ">{{ $appart->name }}</a>
                   <a href="{{ route('appartment.edit', $appart->id) }} " class="edit btn btn-success btn-sm" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </li>
                
            @elseif( auth()->user()->role == 1)
                <li class="btn-rght">
                    <a href="{{ route('propertyowner.appartment.detail', $appart->id) }}" class="{{ isset($appartment->id) ? $appart->id == $appartment->id ? 'active' : '' : ''}}">{{ $appart->name }}</a>
                    <a href="{{ route('propertyowner.appartment.edit', $appart->id) }}" class="edit btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </li>
            @else 
                <li class="btn-rght">
                    <a href="{{ route('flatowner.appartment.detail', $appart->id) }}" class="{{ isset($appartment->id) ? $appart->id == $appartment->id ? 'active' : '' : ''}}">{{ $appart->name }}</a>
                </li>
            
            @endif
        @empty 
        <li>
            <p>No Appartment Found</p>
        </li>
        @endforelse
        {{-- <li>
            <p>Sunset Apartments</p>
        </li>
        <li>
            <p>Deluxe Villas</p>
        </li>
        <li>
            <p>Geo Condos</p>
        </li>
        <li>
            <p>JBL Properties</p>
        </li>
        <li>
            <p>Sunset Apartments</p>
        </li>
        <li>
            <p>Deluxe Villas</p>
        </li>
        <li>
            <p>Geo Condos</p>
        </li> --}}
    </ul>
</div>
@endif