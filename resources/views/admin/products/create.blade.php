@extends('layouts.app')

@section('content')

<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-dark">Add Product</div>
	            <div class="card-body">
	            	<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
	            		@csrf
	            		<div class="form-group">
							<label for="title">Title :</label>
							<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Game title" required>
					      	@error('title')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
						</div>
						<div class="row">
						    <div class="col">
								<label for="publisher">Publisher :</label>
						      	<input type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" placeholder="Game publisher" required>
						      	@error('publisher')
		                            <span class="invalid-feedback" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
						    </div>
						    <div class="col">
						    	<label for="genre">Genre :</label>
						    	<select class="form-control col" name="genre" required>
							  		<option value="" disabled selected>Please select genre</option>
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
						      	<input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="0.00" required>
						      	@error('price')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
						    </div>
						    <div class="col pb-3">
						    	<label for="platform">Platform :</label>
						    	<select class="form-control col" name="platform" required>
							  		<option value="" disabled selected>Please select platform</option>
							  		<option value="PS4" >PlayStation 4</option>
							  		<option value="XBox" >XBox</option>
							  		<option value="Wii">Nintendo Wii</option>
								</select>
						    </div>
						</div>
						<div class="form-group ml-2 mt-2">
							<label> Select Product Image :</label>
						    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" required>
					      	@error('image')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
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
