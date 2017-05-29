@extends('webpage.layout.webpage_main')
@section('content')

@include('webpage.layout.webpage_header')
@include('webpage.layout.webpage_header_2')

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="/">Home</a></li>
			  <li ><a href="/Browse/New/">New</a></li>
			  <li ><a href="/Browse/New/{{ $product->brand->brand_name }} ">{{ $product->brand->brand_name }}</a></li>
			  <li class="active">{{ $product->product_name }}</li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<img data-field-id="{{asset('storage/images/products/'.$product->photo->photo_1.'')}}" src="{{asset('storage/images/products/'.$product->photo->photo_1.'')}}" id="parent" alt="{{ $product->product_name }}" width="100%" class="image" style="margin-bottom:20px;">

			<div class="col-md-4 col-sm-4 col-xs-4 ">
				<img data-field-id="{{asset('storage/images/products/'.$product->photo->photo_1.'')}}" src="{{asset('storage/images/products/'.$product->photo->photo_1.'')}}" alt="{{ $product->product_name }}" class="image" id="child1" style="  border: 4px solid;">
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 ">
				<img data-field-id="{{asset('storage/images/products/'.$product->photo->photo_2.'')}}" src="{{asset('storage/images/products/'.$product->photo->photo_2.'')}}" alt="{{ $product->product_name }}" class="image" id="child2">
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 ">
				<img data-field-id="{{asset('storage/images/products/'.$product->photo->photo_3.'')}}" src="{{asset('storage/images/products/'.$product->photo->photo_3.'')}}" alt="{{ $product->product_name }}" class="image" id="child3">
			</div>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12 ">

			<h1 style="color: #000000;">{{ $product->division->division_name }} {{ $product->brand->brand_name }} {{ $product->product_name }}</h1>
			<h3 >Color : {{ $product->color }}</h3>
			<h3 >Style : {{ $product->article }}</h3>
			<h3>Harga retail : IDR {{ number_format($product->retail_price,2) }}</h3>

			@if(!$asks->count())
				<h4 style="color: red;">Out of stock</h4>
			@else
				<p>Ukuran Tersedia (US):</p>
							@for ($i = 14; $i <= 28; $i++)
								@if($asks->where('size','=',$i*0.5)->count())
										<span class="label label-info">{{ $i*0.5}}</span>
									@else
										<span class="label label-default">{{ $i*0.5}}</span>
								@endif
						@endfor
			@endif
			<h3>Color</h3>
			<div class="col-md-2 col-sm-3 col-xs-4">
				<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-4">
				<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
			</div><br /><br />
			<hr />

			<div class="col-md-12 col-sm-12 col-xs-12">
				<h2>Beli Sekarang</h2>
				<a href=#>petunjuk ukuran</a>
				<form method="post" action="{{ route('roles.store') }}" data-parsley-validate>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group">
							<select id="buy" name="buy" class="form-control col-md-7 col-xs-12">
									<option value="" selected disabled >--Pilih Ukuran--</option>
								@foreach($asks as $row)
										<option value="{{ $row->id }}">{{ $row->size }} US -- IDR {{ number_format($row->ask_amount,2) }}</option>
								@endforeach
							</select>
							<input type="hidden" name="_token" value="{{ Session::token() }}">
							<div style="text-align:center; margin-top:45px;">
								<button type="submit" class="btn btn-success" >Tambah ke Keranjang</button>
							</div>
						</div>
					</form>
			</div>.<hr />

			<div class="col-md-6 col-sm-6 col-xs-6">
				<h2>Tawar (<abbr title="Buat penawaran baru untuk produk ini">?</abbr>)</h2>
				<p>Buat penawaran baru untuk produk ini</p>
				<div style="text-align:center; margin-top:45px;">
					<button type="submit" class="btn btn-info" >Tawar</button>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h2>Jual (<abbr title="Jual produk ini">?</abbr>)</h2>
				<p>Buat penjualan baru untuk produk ini</p>
				<div style="text-align:center; margin-top:45px;">
					<button type="submit" class="btn btn-warning" >Jual</button>
				</div>
			</div>

		</div>
	</div>
		<div class="row">
			<h2>Mungkin Anda Juga Tertarik</h2>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
				<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
				<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
				<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
				<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
			</div>
		</div>
		<div class="row">
			<h2>Data Transaksi Produk</h2>

		</div>
</div>
@stop
