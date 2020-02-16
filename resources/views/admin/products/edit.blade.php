@extends('layouts.app')

@section('content')

<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-dark">Edit Product</div>
	            	<div class="card-body">
	            	<form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
	            		@method('PATCH')
	            		@csrf
	            		<div class="form-group">
							<label for="title">Title :</label>
							<input type="text" class="form-control" name="title" value="{{ $product->title }}" >
						</div>
						<div class="row">
						    <div class="col">
								<label for="publisher">Publisher :</label>
						      	<input type="text" class="form-control" name="publisher" value="{{$product->publisher}}">
						    </div>
						    <div class="col">
						    	<label for="genre">Genre :</label>
						    	<select class="form-control col" name="genre">
							  		<option value="{{$product->genre}}">Selected: {{$product->genre}}</option>
							  		<option value="Action">Action</option>
							  		<option value="Adventure">Adventure</option>
							  		<option value="Role-playing">Role-playing</option>
							  		<option value="Simulation">Simulation</option>
							  		<option value="Strategy">Strategy</option>
							  		<option value="Sports">Sports</option>
							  		<option value="Others">Others</option>
								</select>
						    </div>
						</div>
						<div class="row pt-3">
						    <div class="col">
								<label for="price">Price (RM) :</label>
						      	<input type="text" class="form-control" name="price" value="{{ $product->price }}">
						    </div>
						    <div class="col pb-3">
						    	<label for="platform">Platform :</label>
						    	<select class="form-control col" name="platform">
							  		<option value="{{$product->platform}}">Selected: {{$product->platform}}</option>
							  		<option value="PS4" >PlayStation 4</option>
							  		<option value="XBox" >XBox</option>
							  		<option value="Wii">Nintendo Wii</option>
								</select>
						    </div>
						</div>
						<div class="form-group mt-2 ml-2">
							<label> Select Product Image :</label>
						    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
						</div>
		        		<div class="float-right">
		        			<button class="btn btn-danger" type="reset">Clear</button>
		        			<button class="btn btn-success" type="submit">Save</button>
		        		</div>
	            	</form>
	            </div>
        	</div>
        </div>
    </div>
</div>
</body>

@endsection
