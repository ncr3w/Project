@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
	<div class="row" >
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Brand <a href="{{route('brands.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					
					<table id="datatable" class="table table-striped table-borderless">
						<thead>
							<tr>
								<th>Nama Brand</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nama Brand</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							@if (count($brands))
							@foreach($brands as $row)
							<tr>
								<td>{{ $row->brand_name }}</td>
								<td>
									<a href="{{ route('brands.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
									<a href="{{ route('brands.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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
@stop