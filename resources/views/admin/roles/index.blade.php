@extends('layouts.app')

@section('content')

<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-dark">
                  <div>
                      <label class="mt-2 ml-2">Role & Permission Management</label>
                      <a data-toggle="modal" href="#modalPermission" class="btn btn-success btn-sm float-right mt-2">New Permission</a>
                  </div>
                  <hr>
                  <form action="{{ route('roles.store') }}" method="post" >
                    @csrf
                    <div class="form-group pt-2">
                      <label for="role">Role Name: </label>
                      <input type="text"class="form-control" name="role" placeholder="Enter role name">
                    </div>
                    <div class="form-group mt-4 ml-2">
                      <label>Permission :</label>
                      @foreach($permissions as $permission)
                        <div class="form-check">
                          <label for="permission" class="form-check-label">
                          <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="check_list[]">
                            {{ $permission->name }}</label>
                        </div>
                      @endforeach
                    </div>
                    <div class="float-right">
                      <button type="reset" class="btn btn-danger" name="clear">Clear</button>
                      <button type="submit" class="btn btn-success" name="save">Save</button>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Role ID</th>
                                <th>Role Name</th>
                                <th>Permission</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($roles as $role)
                            <tr>
                              <td>{{ $role->id }}</td>
                              <td>{{ $role->name }}</td>
                                <td>
                                  @foreach($role->getAllPermissions() as $permission)
                                    <span class="badge badge-pill badge-info">{{ $permission->name}}</span>
                                  @endforeach
                                </td>
                              <td>{{ $role->created_at }}</td>
                              <td>
                                  <button type="button" data-id="{{$role->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete">Delete</button>
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
          <form action="" method="post" id="roleDeleteForm">
            @method('DELETE')
            @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPermission" tabindex="-1" role="dialog" aria-labelledby="modalPermissionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPermissionLabel">New Permission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('permissions.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Name :</label>
            <input type="text" name="name" class="form-control" placeholder="Enter new permission name">
          </div>
          <div class="modal-footer">
            <a href="{{ route('permissions.index') }}" class="btn btn-success justify-content-start">Permission List</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#modalDelete').on('shown.bs.modal', function(e){
      let button = $(e.relatedTarget);
      let id = button.data('id');

      $('#roleDeleteForm').attr('action', "{{ url('/roles')}}" + "/" + id ) ;
    });
  });
</script>

</body>



@endsection
