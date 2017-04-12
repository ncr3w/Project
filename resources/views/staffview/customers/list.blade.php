@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User <a href="{{route('customers.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
							<th>Nama</th>
							<th>Telepon</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Tanggal Lahir</th>
							<th>Role</th>
							<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
							<th>Nama</th>
							<th>Telepon</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Tanggal Lahir</th>
							<th>Role</th>
							<th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($customers))
							@foreach($customers as $row)
                            <tr>							
								<td>{{ $row->name }}</td>
								<td>{{ $row->phone }}</td>
								<td>{{ $row->email }}</td>
								<td>@if ( $row->gender == 0) Male @else Female @endif</td>
								<td>{{ $row->date_of_birth }}</td>
								<td>@foreach($row->roles as $row2) {{ $row2->display_name }} @endforeach </td>
                                <td>
                                    <a href="{{ route('customers.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('customers.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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