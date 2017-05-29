@extends('webpage.layout.webpage_main')
@section('content')

@include('webpage.layout.webpage_header')
@include('webpage.layout.webpage_carousel')

<!-- Navigation -->
<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="thumbnail" style="padding-left: 0px;  padding-right: 0px;">
				<a href ="/Browse/New"><img src="{{asset('storage/images/webpage/new.jpg')}}" alt="Browse baru" width="100%" class="image"></a>
				<div class="middle">
					<div class="text">Browse Now</div>
				</div>
				<div class="caption">
					<h2 class="text-center">Baru</h2>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="thumbnail" style="padding-left: 0px;  padding-right: 0px;">
				<a href ="#"><img src="{{asset('storage/images/webpage/old.jpg')}}" alt="Browse bekas" width="100%" class="image"></a>
				<div class="middle">
					<div class="text">Browse Now</div>
				</div>
				<div class="caption">
					<h2 class="text-center">Bekas</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="thumbnail" style="padding-left: 0px;  padding-right: 0px;">
				<a href ="#"><img src="{{asset('storage/images/webpage/men.jpg')}}" alt="Browse men" width="100%" class="image"></a>
				<div class="middle">
					<div class="text">Browse Now</div>
				</div>
				<div class="caption">
					<h2 class="text-center">Men</h2>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="thumbnail" style="padding-left: 0px;  padding-right: 0px;">
				<a href ="#"><img src="{{asset('storage/images/webpage/women.jpg')}}" alt="Browse women" width="100%" class="image"></a>
				<div class="middle">
					<div class="text">Browse Now</div>
				</div>
				<div class="caption">
					<h2 class="text-center">Women</h2>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="thumbnail" style="padding-left: 0px;  padding-right: 0px;">
				<a href ="#"><img src="{{asset('storage/images/webpage/other.jpg')}}" alt="Browse other" width="100%" class="image"></a>
				<div class="middle">
					<div class="text">Browse Now</div>
				</div>
				<div class="caption">
					<h2 class="text-center">Other</h2>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->
	<!-- Popular -->
	<div class="row" style="background: white;">
		<div style="padding:0 19px">
			<h2>Populer (<abbr title="Produk populer dalam 1 bulan terakhir">?</abbr>)</h2>
		</div>
		@foreach($popular as $row)
		<div class="col-md-3 col-sm-3 col-xs-6">
			<a href ="{{ route('product.new', ['name' =>  $row->product_name, 'article' => $row->article]) }}"><img src="{{asset('storage/images/products/'.$row->photo->photo_1.'')}}" width="100" height="100" alt="{{ $row->product_name }}" title="{{ $row->product_name }}" class="image"></a>
			<h4 class="text-center">{{ $row->product_name }}</h4>
		</div>
		@endforeach
	</div>

	<div style="margin-top:20px;"><div>

	<!-- Cheapest -->
	<div class="row" style="background: white;">
		<div style="padding:0 19px">
			<h2>Termurah (<abbr title="Produk termurah dalam 1 minggu terakhir">?</abbr>)</h2>
		</div>
		@foreach($recent_lowest_asks as $row)
		<div class="col-md-3 col-sm-3 col-xs-6">
			<a href ="{{ route('product.used', ['name' =>  $row->product_name, 'article' => $row->product->article, 'id' => $row_>id ]) }}"><img src="{{asset('storage/images/products/'.$row->photo->photo_1.'')}}" width="100" height="100" alt="{{ $row->product->product_name }}" title="{{ $row->product->product_name }}" class="image"></a>
			@if($row->ype == "Used")<span class="label label-success">Bekas</span>@endif
			<h4 class="text-center">{{ $row->product->product_name }}</h4>
			<p class="text-center">IDR {{ number_format($row->amount,2) }}</p>
		</div>
		@endforeach
	</div>

	<!-- Release Calendar -->
	<div class="row" style="background: black; margin-top:20px; margin-bottom:20px;">
		<div style="padding:0 19px">
			<h2>Release Calendar</h2>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<table id="table" class="table-bordered">
				<thead>
					<tr>
						<th><h3 class="text-center">Month 1</h3></th>
						<th><h3 class="text-center">Month 2</h3></th>
						<th><h3 class="text-center">Month 3</h3></th>
						<th><h3 class="text-center">Month 4</h3></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><a href ="#"><h4 class="text-center">view More</h4></a></th>
						<th><a href ="#"><h4 class="text-center">view More</h4></a></th>
						<th><a href ="#"><h4 class="text-center">view More</h4></a></th>
						<th><a href ="#"><h4 class="text-center">view More</h4></a></th>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<h3 class="text-left">Sat 13</h3>
							<a href ="#"><img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image"></a>
							<h4 class="text-left">Adidas Ultra Boost 3.0 'Triple Black'</h3>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Blog -->
		<div style="padding:0 19px">
			<h2>Blog</h2>
		</div>
	<div class="row" style="background: white;">
		<div class="col-md-3 col-sm-3 col-xs-3">
			<img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image">
		</div>
		<div class="col-md-9 col-sm-9 col-xs-9">
			<h2>New Release Adidas Ultra Boost 3.0 'Triple Black'</h2>
			<p>Sat 12-12-2012</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...<a href ="#">Read more</a></p>
		</div>
	</div>
	<div class="row" style="background: white;">

		<div class="col-md-3 col-sm-3 col-xs-3">
			<img src="{{asset('storage/images/webpage/test.jpg')}}" alt="Adidas Ultra Boost 3.0 'Triple Black'" title="Adidas Ultra Boost 3.0 'Triple Black'" width="100%" class="image">
		</div>
		<div class="col-md-9 col-sm-9 col-xs-9">
			<h2>New Release Adidas Ultra Boost 3.0 'Triple Black'</h2>
			<p>Sat 12-12-2012</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum<a href ="#">Read more</a></p>
		</div>
	</div>
</div>
@stop
