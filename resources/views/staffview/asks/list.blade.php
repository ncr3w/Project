@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Asks <a href="{{route('asks.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
				
					@if (!empty($success))
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
							</button><strong>{{$success}}</strong>
						</div>
					@endif
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
                               	<th>Customer</th>
								<th>Product</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Amount</th>
								<th>Ask Date</th>
								<th>Expired Date</th>
								<th>Weight</th>
								<th>Size</th> 
								<th>Status</th>
								<th>Type</th> 
								<th>Condition</th> 
								<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                               	<th>Customer</th>
								<th>Product</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Amount</th>
								<th>Ask Date</th>
								<th>Expired Date</th>
								<th>Weight</th>
								<th>Size</th> 
								<th>Status</th>
								<th>Type</th> 
								<th>Condition</th> 
								<th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($asks))
							@foreach($asks as $row)
                            <tr>
                                <td>
									<a href="{{ route('customers.edit', ['id' =>  $row->user->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Customer"></i> {{$row->user->email}}</a>
								</td>
								<td>{{ $row->product->product_name }}</td>
								<td>
									<a data-fancybox data-src="{{ route('address.show', ['id' =>  $row->address->id ]) }}" class="btn btn-success btn-xs" href="javascript:;"><i class="fa fa-search" title="Address"></i> {{ $row->address->address }}</a>	
								</td>
								<td>{{ $row->address->phone }}</td>
								<td>Rp {{ number_format($row->ask_amount,2) }}</td>
								<td>{{ $row->ask_date->format('D') }} {{ $row->ask_date->format('d-m-Y') }}</td>
								<td>{{ $row->expired_date->format('D') }} {{ $row->expired_date->format('d-m-Y') }}</td>
								<td>{{ number_format($row->weight,1) }}</td>
								<td>{{ number_format($row->size,1) }}</td>
								<td>{{ $row->status }}</td>
								<td>{{ $row->type }}</td>
								<td>@if($row->id_product_detail)
										{{ $row->product_details->product_condition }}
									@else
										Brand New
									@endif
								</td>
                                <td>
                                    <a href="{{ route('asks.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('asks.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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