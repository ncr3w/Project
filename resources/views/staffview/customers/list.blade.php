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
							<th>Telepon</th>
							<th>Email</th>
							<th>Address</th>
							<th>Balance</th>
							<th>Transaction</th>
							<th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
							<th>Nama</th>
							<th>Telepon</th>
							<th>Email</th>
							<th>Address</th>
							<th>Balance</th>
							<th>Transaction</th>
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
								<td>
									@foreach($row->address as $row2)
										<a data-fancybox data-src="{{ route('address.show', ['id' =>  $row2->id ]) }}" class="btn btn-success btn-xs" href="javascript:;"><i class="fa fa-search" title="Address"></i> {{ $row2->name }}</a>						
									@endforeach 
									 <a href="{{ route('address.create') }}" class="btn btn-info btn-xs"><i class="fa fa-plus" title="Edit"></i> Add</a>
								</td>
								<td>
									<a href="{{ route('customers.balance', ['id' =>  $row->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Balance"></i> Balance</a>
								</td>
								<td>
									<a href="{{ route('invoices.index_user', ['id' =>  $row->id ]) }}" class="btn btn-success btn-xs"><i class="fa fa-search" title="Invoice"></i> Transaction</a>
								</td>
                                <td>
                                    <a href="{{ route('customers.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
									<a href="javascript;;" data-fancybox data-src="{{ route('staffs.password', ['id' =>  $row->id ]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" title="Password"></i> Edit Password</a>
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