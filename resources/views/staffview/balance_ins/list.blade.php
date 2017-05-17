@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Balance In <a href="{{route('balance_ins.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>User</th>
								<th>Amount</th>
								<th>Type</th>
								<th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>User</th>
								<th>Amount</th>
								<th>Type</th>
								<th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($balance_ins))
							@foreach($balance_ins as $row)
                            <tr>
                                <td>
									<a href="{{ route('customers.edit', ['id' =>  $row->user->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Edit"></i> {{$row->user->email}}</a>
								</td>	
								<td>{{$row->amount}}</td>
								<td>{{$row->type}}</td>
								<td>----</td>
                                <td>
                                    <a href="{{ route('balance_ins.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('balance_ins.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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