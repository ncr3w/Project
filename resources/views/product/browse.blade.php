@extends('webpage.layout.webpage_main')
@section('content')

@include('webpage.layout.webpage_header')
@include('webpage.layout.webpage_header_2')

<div class="container">
	<div class="row">
		<h2>Produk Baru</h2>
		<hr />
	</div>
	<div class="row">
			<div class="col-md-3 col-sm-3 div_full">
				<p>	Filter	</p>
				<hr />
				<p>	Brand	</p>
				<p> Gender </p>aaa
				<p>	Size </p>
				<p>	Price	</p>
			</div>
			<div class="col-md-9 col-sm-9">
			@foreach($result as $row)
				<div class="col-md-3 col-sm-3 col-xs-6">
					<a href ="{{ route('product.new', ['name' =>  $row->product_name, 'article' => $row->article]) }}"><img src="{{asset('storage/images/products/'.$row->photo_1.'')}}" width="100" height="100" alt="{{ $row->product_name }}" title="{{ $row->product_name }}" class="image"></a>
					<h4 class="text-center">{{ $row->product_name }}</h4>
				</div>
			@endforeach
		</div>
	</div>
</div>
@stop
