@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="list-group">
          <a href="#" class="list-group-item">Playstation</a>
          <a href="#" class="list-group-item">XBox</a>
          <a href="#" class="list-group-item">Wii</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
        <div class="row">

		  @foreach ($products as $product)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h6 class="card-title form-inline">
                  <a href="#" id="title">{{ $product->title }}</a>
                  <label class="pl-2"><span class="badge badge-success">In Stock</span></label>
                </h6>
                <h6>RM{{ $product->price }}</h6>
                <p class="card-text">{{ $product->publisher }}</p>
                <p class="card-text text-muted">This is description.</p>
              </div>
              <div class="card-footer">
                <div class="float-right">
					         <a href="" class="btn btn-sm btn-info">Wishlist</a>
                	 <button type="button" data-id="{{$product->id}}" class="btn btn-sm btn-success" id="addItem">Add to Cart</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
			
        </div>
        <!-- /.row -->
        {{$products->render()}}

      </div>
      <!-- /.col-lg-9 -->


    </div>
    <!-- /.row -->


  </div>

<script>

  $(document).on('click','#addItem',function() {
      var p_id = $(this).attr('data-id');
      //
      //console.log(p_id);

      $.ajax({
          type:'POST',
          url: "{{ route('cart.store') }}",
          data: {"_token": "{{ csrf_token() }}", "p_id":p_id,},
          success: function(e){
            console.log(e);
            $('#cartCount').text(e);
          }
        });
  });

</script>

@endsection