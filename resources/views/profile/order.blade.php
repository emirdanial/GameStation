@extends('layouts.app')

@section('content')


<body>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-auto">    
      <div class="card" style="width: 15rem;">
        <div class="card-header text-white bg-dark">
          Welcome <a type="text" href="{{ route('profile.index') }}" class="text-white">{{$user->name}}</a>!
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
              <a href="">Address</a>
          </li>
          <li class="list-group-item">
              <a href="{{ url('profile/order') }}">Order</a>
          </li>
          <li class="list-group-item">
              <a href="">Wishlist</a>
          </li>
          <li class="list-group-item">
              <a href="">Review</a>
          </li>
        </ul>
      </div>
    </div>  
    <div class="col-auto"> 
      <div class="card" style="width: 50rem;">
        <div class="card-body bg-light">
          <table class="table table-striped dataTable" id="tblOrder">
            <thead>
              <tr>
                <th>ID</th>
                <th>Order Date</th>
                <!-- <th>Shipped To</th> -->
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
</body>

<script>
  $('#tblOrder').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('profile/order') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'created_at', name:'created_at'},
            //{data: 'address', name:'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
  });

</script>


@endsection
