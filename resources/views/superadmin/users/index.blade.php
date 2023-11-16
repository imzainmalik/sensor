@extends('layouts.app')
@section('content')
<div class="col-md-7 col-xl-8">
    <div class="row">
        <div class="col-md-12 crud">
            <h2>Users List</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
           <a href="{{ route('user.create') }}" class="edit btn btn-primary btn-sm">Create User</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered data-table" style="color:white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('custum_js')
<script type="text/javascript">
    $(function () {
        
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('user.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'role', name: 'role'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
        
    });
  </script>   
@endpush
@endsection
