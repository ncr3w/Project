@extends('website.template')
@section('header')
<style>
		#contentForm{
			border:1px solid #ccc;
			margin-top:50px;
			text-align:center;
			min-height:900px;
		}
		table{
			margin:auto;
			border:1px solid;
			border-collapse: collapse;
		}
		tr{
			border:1px solid;
		}
		td{
			width:300px;
		}
		th{
			background-color:black;
			color:white;
			font-weight:normal;
			border:1px solid grey !important;
		}
		h2{
			width:100%;
			background-color:black;
			color:white;
			margin-top:-1px;
			text-align:center;
			font-weight:normal;
			
		}
		#contentForm tr, #contentForm th, #contentForm td{
			border:1px solid;
			text-align:center;
			padding:5px;
		}
		#contentForm input, #contentForm select{
			width:100%;			
			background-repeat: no-repeat;
    			background-position: center;

		 	font-family: Oswald,Arial,sans-serif!important;
		}
		#konfirmasi{
			width:200px !important;
			height:50px;
			font-size:20px;
			color:white;
			background-color:red;
		}
</style>
@stop
@section('content')
<div id="contentForm">
	@if(isset($_COOKIE['nomorTransaksi']))

		<h2>Konfirmasi Pembayaran</h2>
		<table >
			<thead>
				<th>Image</th>
				<th>Article</th>
				<th>Name</th>
				<th>Price</th>
				<th>Size</th>
				<th>Quantity</th>
				<th>Sub Total</th>
			</thead>
			<tbody>
				@foreach($itemlists as $itemlist)
				<tr>
					<td>
						@if($itemlist->article!='ADD-COST')
							<img src="img/storage/icon/{{$itemlist->article}}-1.jpg">
						@endif
					</td>
					<td>
						{{$itemlist->article}}
					</td>
					<td>
						{{$itemlist->name}}
					</td>
					<td>
						Rp {{$itemlist->price}}
					</td>
					<td>
						{{$itemlist->size}}
					</td>
					<td>
						{{$itemlist->qty}}
					</td>
					<td>
						Rp {{$itemlist->price*$itemlist->qty}}
					</td>
				
				</tr>
				@endforeach
				<tr><th colspan="6">Total</th><td>Rp {{$_COOKIE['totalPayment']}}</td></tr>
			</tbody>
		</table>
		</br>
		<a style="text-decoration:underline; color:blue;"href="/confirmation/reset">Konfirmasi pembayaran lain?</a>
		</br>
		</br>
	@endif
	<h2>Data Payment</h2>
	@if(count($itemlists)==0)
		<p>Terimakasih atas konfirmasi pembayaran anda, kami akan memproses kiriman anda apabila konfirmasi tersebut valid. Kami akan segera menghubungi anda melalui email dalam waktu 1 x 24 jam</p></br>
		<a style="text-decoration:underline; color:blue;"href="/">Kembali berbelanja</a>
		
	@elseif(isset($_COOKIE['name']))
		<p>Halo, {{$_COOKIE['name']}} silahkan lakukan konfirmasi pembayaran anda, agar pesanan anda segera kami kirimkan :)</p>
	@else
		<p>Silahkan lakukan konfirmasi pembayaran anda, agar pesanan anda segera kami kirimkan :)</p>
		
	@endif
	{!!Form::open(['url' => '/confirmation'])!!}
	<table >
		@if(isset($_COOKIE['nomorTransaksi'])&&count($itemlists)>0)
			<thead>
				<tr><th>No Order</th><td><input type="number" name="transaction" value="{{$_COOKIE['nomorTransaksi']}}" readonly required></td></tr>
				<tr><th>Bank Tujuan</th><td>
					<select name="bankTo">
						<option value=8>BCA a/n Steven Daniel (7771510136)</option>
						<option value=1>MANDIRI a/n Steven Daniel (1300013155067)</option>
					</select>
				</td></tr>
				<tr><th>Bank Anda</th><td><input name="bankFrom" required></td></tr>
				<tr><th>Nama Rekening Anda</th><td><input name="bankNama" required></td></tr>
				<tr><th>Nominal</th><td><input type="number" name="nominal" value="{{$_COOKIE['totalPayment']}}" required></td></tr>
				<tr><th>Tanggal Transfer</th><td><input type="date" name="transferDate" value="{{date("Y-m-d")}}" required></td></tr>
			</thead>
			
		@elseif(count($itemlists)>0)
			<thead>
				<tr><th>No Order</th><td><input type="number"  name="transaction" required></td></tr>
				<tr><th>Bank Tujuan</th><td>
					<select name="bankTo">
						<option value=8>BCA a/n Steven Daniel</option>
						<option value=1>MANDIRI a/n Steven Daniel</option>
					</select>
				</td></tr>
				<tr><th>Bank Anda</th><td><input name="bankFrom" required></td></tr>
				<tr><th>Nama Rekening Anda</th><td><input name="bankNama" required></td></tr>
				<tr><th>Nominal</th><td><input type="number" name="nominal" required></td></tr>
				<tr><th>Tanggal Transfer</th><td><input type="date" name="transferDate" value="{{date("Y-m-d")}}" required></td></tr>
			</thead>
			
		@endif
	</table>
	</br>
	@if(count($itemlists)>0)
	<input id="konfirmasi" value="Konfirmasi" type="submit" name="konfirmasi">
	@endif
	{!!Form::close()!!}
</div>
@stop