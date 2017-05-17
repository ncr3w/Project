@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>In Progress <a href="{{route('invoices.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
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
                                <th>No</th>
                                <th>Buyer</th>
								<th>Address</th>								
								<th>Amount</th>			
								<th>Commision</th>
								<th>Date</th>
								<th>Status</th>
								<th>Detail</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Buyer</th>
								<th>Address</th>							
								<th>Amount</th>								
								<th>Date</th>
								<th>Status</th>
								<th>Detail</th>
								<th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($invoices))
							@foreach($invoices as $row)
									<tr 
										{{-- DANGER --}}
										"@if ($row->created_at->diffInDays() >=2) class='danger' @endif"
										
										{{-- WARNING --}}
										"@foreach($row->invoice_details as $row2)
											 @if($row2->status == 'Waiting for Verification') class='warning'
											 @endif
										 @endforeach
										 @if ($row->status == 2 || $row->status == 1) class='warning' @endif"
									>
										<td>{{ $row->id }}</td>
										<td>
											<a href="{{ route('customers.edit', ['id' =>  $row->user->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Customer"></i> {{$row->user->email}}</a>
										</td>
										<td>
											<a data-fancybox data-src="{{ route('address.show', ['id' =>  $row->address->id ]) }}" class="btn btn-success btn-xs" href="javascript:;"><i class="fa fa-search" title="Address"></i> {{ $row->address->address }}</a>	
										</td>
										<td>Rp {{ number_format($row->amount,2) }}</td>
										<td>Rp {{ number_format($row->amount*10/100,2) }}</td>
										<td>{{ $row->created_at->format('D') }} {{ $row->created_at->format('d-m-Y') }}</td>
										<td>{{ $row->status }}</td>
										<td>
											<a data-fancybox data-src="{{ route('invoices.details', ['id' =>  $row->id ]) }}" class="btn btn-success btn-xs" href="javascript:;"><i class="fa fa-search" title="Show"></i> Detail</a>
										</td>										
										<td>
											<a href="{{ route('invoices.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
											<a href="{{ route('invoices.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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