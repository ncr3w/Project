@extends('staffview.templates.staffview_minimal')
@extends('staffview.templates.datatable_template')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Invoice No: {{ $invoices->id }} <a href="{{route('invoice_details.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add Item</a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
					<div class="x_panel">
						<table id="datatable" class="table table-striped table-borderless">
							<thead>
								<tr>
									<th>Name</th>
									<th>Article</th>
									<th>Size</th>
									<th>Seller</th>
									<th>Amount</th>															
									<th>Shipping</th>
									<th>Shipping Cost</th>
									<th>Receipt</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if (count($invoices->invoice_details))
								@foreach($invoices->invoice_details as $row2)
									<tr>
										<td>{{ $row2->ask->product->product_name }}</td>
										<td>{{ $row2->ask->product->article }}</td>
										<td>{{ $row2->ask->size }}</td>
										<td>
											<a href="{{ route('customers.edit', ['id' =>  $row2->ask->user->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Edit"></i> {{$row2->ask->user->email}}</a>
										</td>
										<td>Rp {{ number_format($row2->ask->ask_amount,2) }}</td>
										<td>{{ $row2->shipping->shipping_name }}</td>
										<td>Rp {{ number_format($row2->shipping_cost,2) }}</td>
										<td>
											@if($row2->receipt)
												<a data-fancybox href="{{asset('storage/images/receipts/'.$row2->receipt.'')}}" class="btn btn-info btn-xs"><i class="fa fa-search" title="Edit"></i> Proof</a>
											@else
												-
											@endif
										</td>
										<td>{{ $row2->status }}</td>
										<td>
											<a href="{{ route('invoices.edit', ['id' =>  $row2->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i></a>
											<a href="{{ route('invoices.show', ['id' =>  $row2->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></a>
										</td>
									</tr>
								@endforeach
									<td colspan=9 align="right">Total </td>
									<td align="right"><b>Rp {{ number_format($invoices->amount,2) }}</b></td>
								@endif
							</tbody>
						</table>										
					</div>
				</div> 
            </div>
        </div>
    </div>
@stop