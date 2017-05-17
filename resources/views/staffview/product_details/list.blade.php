@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bids <a href="{{route('asks.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
                               	<th>Customer</th>
								<th>Product</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Amount</th>
								<th>Bid Date</th>
								<th>Expired Date</th>
								<th>Weight</th>
								<th>Size</th> 
								<th>Status</th>
								<th>Type</th> 
								<th>Detail</th> 
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                               	<th>Customer</th>
								<th>Product</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Amount</th>
								<th>Bid Date</th>
								<th>Expired Date</th>
								<th>Weight</th>
								<th>Size</th> 
								<th>Status</th>
								<th>Type</th> 
								<th>Detail</th> 
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($asks))
							@foreach($asks as $row)
                            <tr>
                                <td>{{ $row->user->email }}</td>
								<td>{{ $row->product->product_name }}</td>
								<td>{{ $row->address->address }}</td>
								<td>{{ $row->address->phone }}</td>
								<td>{{ $row->ask_amount }}</td>
								<td>{{ $row->ask_date}}</td>
								<td>{{ $row->expired_date}}</td>
								<td>{{ $row->weight}}</td>
								<td>{{ $row->size}}</td>
								<td>@if($row->status == 0)
										Active
									@elseif ($row->status == 1)
										Waiting for DP
									@elseif ($row->status == 2)
										Waiting for Verification
									@elseif ($row->status == 3)
										In Cart
									@elseif ($row->status == 4)
										in Progress
									@elseif ($row->status == 5)
										Finished
									@endif
								</td>
								<td>@if( $row->type == 0)
										Ask - New
									@elseif ($row->type == 1)
										Sell Now - New
									@elseif ($row->type == 2)
										Ask - Used
									@else
										Sell Now - Used
									@endif
								</td>
								<td>@if($row->id_product_detail)
										<a href="{{ route('product_detail.edit', ['id' =>  $row->id_product_detail ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Edit"></i> Detail</a>
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