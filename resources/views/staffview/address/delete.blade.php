@extends('staffview.templates.staffview_minimal')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $addresses->name }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
				
					@if (!empty($success))
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
							</button><strong>{{$success}}</strong>
						</div>
					@endif
					
					<table id="table" class="table table-striped table-borderless">
					<tr>
					<td>Address: </td><td>{{$addresses->address}}</td>
					</tr><tr>
					<td>Post Code: </td><td>{{$addresses->postal_code}}</td>
					</tr><tr>
					<td>Phone: </td><td>{{$addresses->phone}}</td>
					</tr><tr>
					<td>District: </td><td>{{$addresses->district->district_name }}</td>
					</tr><tr>
					<td>Regency: </td><td>{{$addresses->district->regency->regency_name }}</td>
					</tr><tr>
					<td>Province: </td><td>{{$addresses->district->regency->province->province_name }}</td>
					</tr>
					</table>
						<a href="{{ route('address.edit', ['id' =>  $addresses->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
						<a href="{{ route('address.destroy', ['id' =>  $addresses->id  ]) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are your sure?')"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
                </div>
            </div>
        </div>
@stop
