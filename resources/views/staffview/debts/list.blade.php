@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Debt <a href="{{route('debts.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>Date</th>
								<th>Time</th>
								<th>Customer</th>
								<th>Amount</th>
								<th>User</th>
								<th>Type</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Date</th>
								<th>Time</th>
								<th>Customer</th>
								<th>Amount</th>
								<th>Proof</th>
								<th>Type</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($debts))
							@foreach($debts as $row)
                            <tr class="@if ($row->status == 1) warning @endif"> 
                                <td>{{ $row->created_at->format('D') }} {{ $row->created_at->format('d-m-Y') }}</td>
								<td>{{ $row->created_at->format('H:i:s') }}</td>
								<td><a href="{{ route('customers.edit', ['id' =>  $row->user->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Customer"></i> {{$row->balance_out->user->email}}</a></td>
								<td>Rp {{ number_format($row->amount,2) }}</td>															
									@if ($row->type == 0)
										Pencairan
									@else
										No Payment
									@endif
								</td>
								<td>{{ $row->status }}
									@if($row->status == "Waiting for Verification")
										<a href="{{ route('debts.accept', ['id' =>  $row->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-check" title="Accept"></i> Accept</a>
										<a href="{{ route('debts.reject', ['id' =>  $row->id ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-times" title="Reject"></i> Reject</a>
									@endif		
								</td>
                                <td>
                                    <a href="{{ route('debts.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('debts.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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