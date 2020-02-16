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
                        <label class="ml-2 mt-2">Products</label>
                        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-right mt-1">Add</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped dataTable" id="tblProduct">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Price (RM)</th>
                                    <th>Platform</th>
                                    <th>Genre</th>
                                    <th>Publisher</th>
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
                <div class="row pl-4 pt-3 pb-3">
                  <div class="col">
                    <img src="" id="image" style="width: 220px; height: 300px ;">
                  </div>
                  <div class="col pt-4">
                    <div class="form-group">
                      <label>Title :</label>
                      <span id="title"></span>
                    </div>
                    <div class="form-group">
                      <label>Price(RM) :</label>
                      <span id="price"></span>
                    </div>
                    <div class="form-group">
                      <label>Platform :</label>
                      <span id="platform"></span>
                    </div>
                    <div class="form-group">
                      <label>Genre :</label>
                      <span id="genre"></span>
                    </div>
                    <div class="form-group">
                      <label>Publisher :</label>
                      <span id="publisher"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>

</body>

<script>
  $(function () {
    var table = $('#tblProduct').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'price', name: 'price'},
            {data: 'platform', name: 'platform'},
            {data: 'genre', name: 'genre'},
            {data: 'publisher', name: 'publisher'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
            { width: 30, targets: 0 },
            { width: 320, targets: 1 },
            { width: 80, targets: 2 },
            { width: 80, targets: 3 },
            { width: 160, targets: 6 },
        ],
    });

    $('#modalDelete').on('shown.bs.modal', function(e){
        let button = $(e.relatedTarget);
        let id = button.data('id');
        $('#DeleteForm').attr('action', "{{ url('/products')}}" + "/" + id );

    });

    $('#modalView').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var url = button.data('id');
        //console.log(url);

        $.ajax({
          type:'GET',
          url: url,
          success: function(e){
            var data = JSON.parse(e);
            console.log(data);
            var path = "{{ asset('/storage/') }}";
            var imgPath = path+"/"+data.image;
            console.log(imgPath);
            $('#image').attr("src",imgPath);
            $("#modalViewLabel").html(data.title);
            $("#title").html(data.title);
            $("#price").html(data.price);
            $("#platform").html(data.platform);
            $("#genre").html(data.genre);
            $("#publisher").html(data.publisher);
          }
        });
    });

  });
</script>

@endsection
