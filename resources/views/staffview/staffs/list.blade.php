@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Staff <a href="{{route('staffs.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add Staff </a></h2>
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
							<th>Nama</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Address</th>
							<th>Role</th>
							<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
							<th>Nama</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Address</th>
							<th>Role</th>
							<th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($staffs))
							@foreach($staffs as $row)
                            <tr>							
								<td>{{ $row->name }}</td>
								<td>{{ $row->phone }}</td>
								<td>{{ $row->email }}</td>								
								<td>
									@foreach($row->address as $row2)
										{{ $row2->address }}
									@endforeach	
								</td>
								<td>
									@foreach($row->roles as $row2)
										<span class="label label-info">{{ $row2->display_name }}</span>
									@endforeach 
								</td>
                                <td>
                                    <a href="{{ route('staffs.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
									<a href="javascript;;" data-fancybox data-src="{{ route('staffs.password', ['id' =>  $row->id ]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" title="Password"></i> Edit Password</a>
                                    <a href="{{ route('staffs.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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