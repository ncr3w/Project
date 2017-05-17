@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Brand <a href="{{route('tickets.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
								<th>User</th>
                                <th>Detail</th>
                                <th>Solusi</th>
								<th>Status</th>
								<th>Staff</th>
								<th>Comment</th>
								<th>Chat</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
								<th>User</th>
                                <th>Detail</th>
                                <th>Solution</th>
								<th>Status</th>
								<th>Staff</th>
								<th>Comment</th>
								<th>Chat</th>
								<th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($tickets))
							@foreach($tickets as $row)
                            <tr>
                                <td>{{ $row->user->email }}</td>
								<td>{{ $row->ticket_detail->detail }}</td>
								<td>{{ $row->ticket_solution->solution }}</td>
								<td>
									@if($row->status == 0)
										Open
									@elseif ($row->status == 1)
										In-Progress
									@else
										Closed
									@endif	
								</td>
								<td>{{ $row->staff->name }}</td>
								<td>{{ $row->comment }}</td>
								<td><a href="{{ route('tickets.chat', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-comments" title="Edit"></i> Chat</a></td>
                                <td>
                                    <a href="{{ route('tickets.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('tickets.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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