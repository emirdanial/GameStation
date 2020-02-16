@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
	      				<th>No.</th>
	      				<th>Product</th>
	      				<th>Quantity</th>
	      				<th>Total</th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			@foreach ($items as $item)
	      			<tr>
	      				<td>{{$item->id}}</td>
	      				<td>
	      					{{$item->options->img}} {{$item->name}} ({{$item->options->platform}})</td>
	      				<td>
	      					<div class="form-inline">
		      					<input type="number" class="form-control" name="" style="width: 58px;" value="{{$item->qty}}">
		      					<button class="btn btn-danger btn-sm ml-2">X</button>
	      					</div>
	      				</td>
	      				<td>RM {{($item->price)}}</td>
	      			</tr>
	      			@endforeach
	      		</tbody>
	      	</table>
		</div>
	</div>

@endsection