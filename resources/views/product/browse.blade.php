@extends('webpage.layout.webpage_main')
@section('content')

@include('webpage.layout.webpage_header')

	@foreach($asks as $row)				
			@if($row->type == 'Used')
				<div class="col-md-3 col-sm-3 col-xs-6">
					<a href ="{{ route('product.used', ['name' =>  $row->product->product_name, 'article' => $row->product->article, 'id' => $row->id ]) }}"><img src="{{asset('storage/images/products/'.$row->product->photo->photo_1.'')}}" width="100" height="100" alt="{{ $row->product->product_name }}" title="{{ $row->product->product_name }}" class="image"></a>
					@if($row->type == 'Used')<span class="label label-success">Bekas</span>@endif
					<h4 class="text-center">{{ $row->product->product_name }}</h4>		
					<p class="text-center">IDR {{ number_format($row->amount,2) }}</p>
				</div>		
			@else
				<div class="col-md-3 col-sm-3 col-xs-6">		
					<a href ="{{ route('product.new', ['name' =>  $row->product->product_name, 'article' => $row->product->article]) }}"><img src="{{asset('storage/images/products/'.$row->product->photo->photo_1.'')}}" width="100" height="100" alt="{{ $row->product_name }}" title="{{ $row->product_name }}" class="image"></a>
					<h4 class="text-center">{{ $row->product->product_name }}</h4>
				</div>
		@endif
	@endforeach	
@stop