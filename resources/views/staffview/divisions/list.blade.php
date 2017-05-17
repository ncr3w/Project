@extends('staffview.templates.staffview_main')
@extends('staffview.templates.datatable_template')

@section('content')
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Division <a href="{{route('divisions.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					
                    <table id="datatable" class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>Division Name</th>
								<th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Division Name</th>
								<th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($divisions))
							@foreach($divisions as $row)
                            <tr>
                                <td>{{ $row->division_name }}</td>
								<td><img src="{{asset('storage/images/divisions/'.$row->image.'')}}" width="100" height="100"></td>
                                <td>
                                    <a href="{{ route('divisions.edit', ['id' =>  $row->id ]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> Edit</a>
                                    <a href="{{ route('divisions.show', ['id' =>  $row->id  ]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
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