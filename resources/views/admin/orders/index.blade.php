@extends('layouts.app')

@section('extra-script')

    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
     
@endsection

@section('content')
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <label class="mt-2 ml-2">Order</label>
                        <a href="{{ route('orders.create') }}" class="btn btn-success btn-sm float-right mt-1">Add</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped dataTable" id="tblOrder">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
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
                <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
                </form>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <input type="hidden" name="id">
              <div class="modal-header">
                <h5 class="modal-title" id="modalViewLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>

</body>

<script>
  $('#tblOrder').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'user_name', name: 'user.name'},
            {data: 'user_email', name: 'user.email'},
            {data: 'created_at', name:'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
            { width: 30, targets: 0 },
            { width: 300, targets: 1 },
            { width: 160, targets: 4 },
        ]
    });

</script>

@endsection
