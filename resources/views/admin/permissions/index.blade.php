@extends('layouts.app')

@section('content')
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <label class="pr-3">Permission List</label>
                        <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Permission ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <button type="button" data-id="{{$permission->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure to erase this record? This action cannot be undone.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="" method="post" id="DeleteForm">
            @method('DELETE')
            @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#modalDelete').on('shown.bs.modal', function(e){
      let button = $(e.relatedTarget);
      let id = button.data('id');

      $('#DeleteForm').attr('action', "{{ url('/permissions')}}" + "/" + id ) ;
    });
  });

</script>

@endsection
