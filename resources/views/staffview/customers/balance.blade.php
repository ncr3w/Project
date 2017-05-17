@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Balance <a href="{{route('payments.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>					
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
							<th>Date</th>
							<th>Amount</th>
							<th>Type</th>
							<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
							<th>Date</th>
							<th>Amount</th>
							<th>Type</th>
							<th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($balances))
							@foreach($balances as $row)
                            <tr>
								<td>{{ $row[0]->created_at->format('Y-m-d') }}</td>
								<td>@if ($row[1] == 'out') - @endif Rp {{ number_format($row[0]->amount,2) }}</td>
								<td>{{ $row[0]->type }}</td>
                                <td>
									@if ($row[1] == 'out')
										<a href="{{ route('balance_outs.edit', ['id' =>  $row[0]->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
										<a href="{{ route('balance_outs.show', ['id' =>  $row[0]->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
									@else
										<a href="{{ route('balance_ins.edit', ['id' =>  $row[0]->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
										<a href="{{ route('balance_ins.show', ['id' =>  $row[0]->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
									@endif	
                                </td>
                            </tr>  
							@endforeach
							@endif
                        </tbody>
                    </table>		
					<h2 align="right">Total Balance: Rp {{  number_format($total,2) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@stop