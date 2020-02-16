@extends('layouts.app')

@section('content')

<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <p>Order ID: {{ $order->id }} </p>
                    <p>Order Date: {{ $order->created_at }} </p>
                  <hr>
                  <div class="">
                    <p>{{ $order->user->name }}</p>
                    <p>{{ $order->user->email }}</p>
                    <P>Street 1, Street2, KL, 430000</P>
                  </div>
                  <hr>
                  <form id="addProd" method="post" >
                    <div class="form-group row pt-2 pl-3">
                        <label for="product" class="col-form-label">Product :</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="product" id="product" required>
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{ $product->title }}</option>
                            @endforeach
                          </select>
                        </div>
                        <label for="product" class="col-form-label pl-3">Quantity :</label>
                        <div class="col-sm-2">
                          <select class="form-control" name="quantity" id="quantity" required>
                          @for ($i = 1; $i <6 ; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="float-right pl-3">
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="tableOrder">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($order->products as $product)
                            <tr>
                              <td>{{$product->pivot->product_id}}</td>
                              <td>{{$product->title}}</td>
                              <td id="{{$product->id}}">{{$product->pivot->quantity }}</td>
                              <td><button class="btn btn-danger btn-sm">X</button></td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <tfoot>
                      <div class="float-right">
                        <a href="" class="btn btn-outline-info text-dark" >Generate Invoice</a>
                      </div>
                    </tfoot>
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

<script>
  $(document).ready(function() {
    $('#modalDelete').on('shown.bs.modal', function(e){
      let button = $(e.relatedTarget);
      let id = button.data('id');

      $('#roleDeleteForm').attr('action', "{{ url('/roles')}}" + "/" + id ) ;
    });
  });

  $(function(){
    $('#addProd').on('submit', function(e){
      e.preventDefault();

      var p_id = $('#product').val();
      var p_name = $('#product option:selected').text();
      var quantity = $('#quantity').val();
      var order_id = "{{ $order->id }}"

      //console.log(p_name);
 
      $.ajax({
        url:"{{ route('orders.store') }}",
        method:'POST',
        data: {"_token": "{{ csrf_token() }}", "p_id":p_id, "p_name":p_name, "quantity":quantity, "order_id": order_id},
        success: function(e){
          console.log(e);
          if (e.success == "added") 
          {
            var html = '<tr>';
            html += '<td>'+e.p_id+'</td>';
            html += '<td>'+e.p_name+'</td>';
            html += '<td>'+e.quantity+'</td>';
            html += '<td>'+'<button class="btn btn-danger btn-sm">X</button>'+'</td></tr>';
            $('#tableOrder').prepend(html);
          }
          else if (e.success == "updated"){
            var id = e.p_id;
            $('#'+id).text(e.quantity);
          }
          //console.log(e);
        }

      })
    });
  });
</script>

</body>



@endsection
