@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product <a href="{{route('products.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table borderless">
                        <thead>
                            <tr>
                                <th>Foto</th>
								<th>Nama Produk</th>
								<th>Brand</th>
								<th>Divisi</th>
								<th>Artikel</th>
								<th>Harga Retail</th>
								<th>Jumlah Terjual</th>
								<th>Harga Pasar</th>
								<th>Harga Pasar(bekas)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
								<th>Nama Produk</th>
								<th>Brand</th>
								<th>Divisi</th>
								<th>Artikel</th>
								<th>Harga Retail</th>
								<th>Jumlah Terjual</th>
								<th>Harga Pasar</th>
								<th>Harga Pasar(bekas)</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($products))
							@foreach($products as $row)
                            <tr>
								
								<td><img src="{{asset('storage/images/products/'.$row->photo->photo_1.'')}}" width="100" height="50"></td>
								<td>{{ $row->product_name }}</td>
								<td>{{ $row->brand->brand_name }}</td>
								<td>{{ $row->division->division_name }}</td>
								<td>{{ $row->article }}</td>
								<td>{{ number_format($row->retail_price,2) }}</td>
								<td>{{ $row->number_sold }}</td>
								<td>{{ number_format($row->avg_price_new,2) }}</td>
								<td>{{ number_format($row->avg_price_used,2) }}</td>
                                <td>
                                    <a href="{{ route('products.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('products.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
                                </td>
                            </tr>  
							@endforeach
							@endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop