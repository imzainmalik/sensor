@extends('layouts.app')
@section('content')
    <div class="col-sm-4">
        <div class="row crud">
            <div class=" col-md-12">
                <h2>Create Password</h2>
            </div>
        </div>
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
        <br>
        <div class="row">
            <div class=" col-md-12">
            <form action="{{route('user.cofigure_password.post')}}" method="POST">
                @csrf
                <input type="hidden" class="form-control"  name="id" value="{{ $user ? $user->id : '' }}" placeholder="id">
                <div class="">
                  <label for="password">Password</label>
                  <input type="password" class="form-control pp" id="password" name="password">
                </div>
                <br>
                <div class="">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" class="form-control pp" id="password_confirmation" name="password_confirmation">
                  <input type="checkbox" id="check"> <label for="check">Show Password</label>
                </div>
                <br>
                
                 <br>
                <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
              
              </form>
          
            </div>
        </div>
    </div>
@push('custum_js')
<script>
      
        $(document).ready(function(){
            $('#check').click(function(){
                $(this).is(':checked') ? $('.pp').attr('type', 'text') : $('.pp').attr('type', 'password');
            });
        });
  
    </script>
@endpush
@endsection