@extends('webpage.layout.webpage_main')
@section('content')

@include('webpage.layout.webpage_header')
@include('webpage.layout.webpage_header_2')

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<ol class="breadcrumb">
		  <li><a href="#">Home</a></li>
		  <li><a href="#">Browse</a></li>
		  <li ><a href="#">Used</a></li>
		  <li ><a href="#">{{ $ask->product->brand->brand_name }}</a></li>
		  <li class="#">{{ $ask->product->product_name }}</li>
		  <li class="active">{{ $ask->id }}</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<img src="{{asset('storage/images/products/'.$ask->product->photo->photo_1.'')}}" alt="Browse baru" width="100%" class="image" style="margin-bottom:20px;"></a>

		<div class="col-md-4 col-sm-4 col-xs-4 square">
			<img src="{{asset('storage/images/products/'.$ask->product->photo->photo_1.'')}}" alt="Browse baru" class="image"></a>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 square">
			<img src="{{asset('storage/images/products/'.$ask->product->photo->photo_2.'')}}" alt="Browse baru" class="image"></a>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 square">
			<img src="{{asset('storage/images/products/'.$ask->product->photo->photo_3.'')}}" alt="Browse baru" class="image"></a>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12 " style="background: white;">

		<h1 class="text-center" style="color: #57d6c7;">{{ $ask->product->product_name }}</h1>
		<h3 class="text-center">Color : {{ $ask->product->color }}</h3>
		<h3 class="text-center">Style : {{ $ask->product->article }}</h3>
		<h4>Harga : IDR {{ number_format($ask->ask_amount,2) }}</h4>
		<p>Harga retail : IDR {{ number_format($ask->product->retail_price,2) }}</p>
		<p>Harga rata - rata (Bekas) : IDR {{ number_format($ask->product->avg_price_used,2) }}</p>
	</div>
</div>
@stop
