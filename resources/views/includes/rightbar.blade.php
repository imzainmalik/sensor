
       @if(auth()->check())
<div class="rightbx">
    <div class="panel_head bluethemeCol">
        <h3>Appartments </h3>
        {{-- Canvas --}}
    </div>
    <ul class="listbtn">
        @forelse ($appartments as $appart) 
            <li>
                <a href="{{ route('appartment.detail', $appart->id) }}" class="{{ isset($appartment->id) ? $appart->id == $appartment->id ? 'active' : '' : ''}}">{{ $appart->name }}</a>
            </li>
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