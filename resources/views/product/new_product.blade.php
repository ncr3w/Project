@extends('webpage.layout.webpage_main')
@section('content')

@include('webpage.layout.webpage_header')

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<ol class="breadcrumb">
		  <li><a href="#">Home</a></li>
		  <li><a href="#">Browse</a></li>
		  <li ><a href="#">New</a></li>
		  <li ><a href="#">{{ $product->brand->brand_name }}</a></li>
		  <li class="active">{{ $product->product_name }}</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<img src="{{asset('storage/images/products/'.$product->photo->photo_1.'')}}" alt="Browse baru" width="100%" class="image" style="margin-bottom:20px;"></a>
		
		<div class="col-md-4 col-sm-4 col-xs-4 square">
			<img src="{{asset('storage/images/products/'.$product->photo->photo_1.'')}}" alt="Browse baru" class="image"></a>	
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 square">
			<img src="{{asset('storage/images/products/'.$product->photo->photo_2.'')}}" alt="Browse baru" class="image"></a>	
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 square">
			<img src="{{asset('storage/images/products/'.$product->photo->photo_3.'')}}" alt="Browse baru" class="image"></a>	
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12 " style="background: white;"> 	

		<h1 class="text-center" style="color: #57d6c7;">{{ $product->product_name }}</h1>
		<h3 class="text-center">Color : {{ $product->color }}</h3>
		<h3 class="text-center">Style : {{ $product->article }}</h3>
		@if(!$asks->count())
			<h4 style="color: red;">Produk tidak tersedia</h4>
		@else
			<h4>In Stock : {{ $asks->count() }}</h4>
			 <button data-toggle="collapse" data-target="#stocktable">Cek Stock</button>
			<div id="stocktable" class="collapse">
				<table id="table" class="table table-striped table borderless">
					<thead>
						<tr>
							<th>Size</th>
							<th>Stock</th>
							<th>Harga Termurah</th>
						</tr>
                    </thead>
					<tbody>
						@for ($i = 14; $i <= 28; $i++)
							@if($asks->where('size','=',$i*0.5)->count()) 
								<tr>
									<td>{{ $i*0.5}}</td>
									<td>{{ $asks->where('size','=',$i*0.5)->count() }}</td>
									<td>{{ $asks->where('size','=',$i*0.5)->sortBy('ask_amount')->first()->ask_amount }}</td>
								<tr>
							@endif
						@endfor
					</tbody>
				</table>
			</div>
		@endif	
		<p>Harga retail : IDR {{ number_format($product->retail_price,2) }}</p>
		<p>Harga rata - rata : IDR {{ number_format($product->avg_price_new,2) }}</p>
	</div>
</div>	
@stop