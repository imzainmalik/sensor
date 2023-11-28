@extends('layouts.app')
@section('content')
<div class="col-md-7 col-xl-8">
    <div class="row">
        <div class="col-md-12">
            <div class="panelBox widgets minheightSet">
                <div class="panel_head greenthemeCol btn-rght">
                    @if( $user)
                    <h3>Update User</h3>
                    @else
                    <h3>Add User</h3>
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
                            <form action="{{route('user.store')}}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control"  name="id" value="{{ $user ? $user->id : '' }}" placeholder="id">
                                <div class="form-row">
                                <div class=" col-md-6">
                                    <label for="inputText">Name</label>
                                    <input type="text" class="form-control" id="inputText" name="name" value="{{ $user ? $user->name : '' }}" placeholder="Name">
                                </div>
                                <div class=" col-md-6">
                                    <label for="inputPassword4">Phone</label>
                                    <input type="number" class="form-control" id="inputPassword4" name="phone" value="{{ $user ? $user->phone : '' }}" placeholder="Phone">
                                </div>
                                </div>
                                <br>
                                {{-- <div class="">
                                    <label for="inputAddress">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" name="address"  value="{{ $user ? $user->address : '' }}" placeholder="1234 Main St">
                                </div>
                                <br> --}}
                                <div class="">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" {{ $user ? 'readonly' : '' }} value="{{ $user ? $user->email : '' }}" placeholder="@example.com">
                                </div>
                                <br>
                                <div class="">
                                    <label for="inputAddress">User Role</label>
                                    <select  class="form-control" name="role" id="cars">
                                    
                                            <option value="1" {{ $user ? $user->role == 1 ? 'selected' : '' : '' }}>Proptery Owner</option>
                                            <option value="2" {{ $user ? $user->role == 2 ? 'selected' : '' : '' }}>Appartment Owner</option>
                                    </select>
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
