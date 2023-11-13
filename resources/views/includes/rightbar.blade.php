
       @if(auth()->check())
<div class="rightbx">
    <div class="panel_head bluethemeCol">
        <h3>Appartments </h3>
        {{-- Canvas --}}
    </div>
    <ul class="listbtn">
        @forelse ($appartments as $appart) 
            @if (  auth()->user()->role == 0) 
                <li>
                    <a href="{{ route('appartment.detail', $appart->id) }}" class="{{ isset($appartment->id) ? $appart->id == $appartment->id ? 'active' : '' : ''}}">{{ $appart->name }}</a>
                </li>
            @elseif( auth()->user()->role == 1)
                <li>
                    <a href="{{ route('propertyowner.appartment.detail', $appart->id) }}" class="{{ isset($appartment->id) ? $appart->id == $appartment->id ? 'active' : '' : ''}}">{{ $appart->name }}</a>
                </li>
            @else 
                <li>
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